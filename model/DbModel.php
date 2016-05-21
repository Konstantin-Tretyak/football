<?php

//require "QueryBuilder.php";

abstract class DbModel
{
    protected static $table;
    protected static $conn;
    protected static $primaryKey = 'id';

    public static function setConnection(PDO $conn)
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$conn = $conn;        
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $attribute => $value)
        {
            $this->$attribute = $value;
        }

        return $this;
    }

    public function __construct(Array $attributes = [])
    {
        $this->fill($attributes);
    }

    public static function query($value='')
    {
        ///???Что значит static::class
        return new QueryBuilder(self::$conn, [self::getTableName() => '*'], static::class);
    }

    public static function getDbName()
    {
        ///???fetchColumn - для чего
        return self::$conn->query('select database()')->fetchColumn();
    }

    public static function getTableName()
    {
        $currentClass = get_called_class();
        return $currentClass::$table;
    }

    public static function getPrimaryKeyName()
    {
        $currentClass = get_called_class();
        return $currentClass::$primaryKey;
    }

    public function getIdName()
    {
        return isset($this->{self::getPrimaryKeyName()}) ? $this->{self::getPrimaryKeyName()} : null;
    }

    public function getColumnNames()
    {
        $sql = 'select column_name from information_schema.columns where table_schema="'.self::getDbName().'" and table_name="'.self::getTableName().'"';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function toArray()
    {
        $columns = self::getColumnNames();
        $result = [];
        foreach ($columns as $column)
        {
            $result[$column] = isset($this->$column) ? $this->$column : null;
        }

        return $result;
    }

    public static function create(Array $attributes)
    {
        $currentClass = get_called_class();
        $new_object = new $currentClass;
        $new_object->fill($attributes)->save();
        return $new_object;
    }

    public function update(Array $attributes)
    {
        $this->fill($attributes)->save();
        return $this;
    }

    public function delete()
    {
        $sql = sprintf("DELETE FROM '%s' WHERE '%s' = ?",
                        self::getTableName(),
                        self::getPrimaryKeyName());
        self::$conn->prepare($sql)->execute([$this->id]);
        $this->{self::getPrimaryKeyName()} = null;
    }

    public function save()
    {
        if ($this->isNew())
        {
            $this->insertQuery();
        }
        else
        {
            $this->updateQuery();
        }
        return $this;
    }

    public function isNew()
    {
        return empty($this->getIdName());
    }

    protected function insertQuery()
    {
        $attributes = $this->toArray();
        ///Зачем unset
        unset($attributes[self::getPrimaryKeyName()]);

        $columns = [];
        $bindings = [];
        $values = [];
        foreach ($attributes as $column => $value)
        {
            if ($column == "update_date" or $column == "create_date")
            {
                $value = date('Y-m-d h:i:s');
                echo $value;
            }
            $columns[] = sprintf('`%s`', $column);
            ///Может быть $bindings - лишний
            $bindings[] = "?";
            $values[] = $value;
        }

        $sql = sprintf("INSERT INTO `%s` (%s) VALUES (%s)", self::getTableName(), join(', ', $columns), join(', ', $bindings));
        self::$conn->prepare($sql)->execute($values);
        $this->{self::getPrimaryKeyName()} = self::$conn->lastInsertId();
    }

    protected function updateQuery()
    {
        $attributes = $this->toArray();
        ///Зачем unset
        unset($attributes[self::getPrimaryKeyName()]);

        $updates = [];
        $values = [];

        foreach ($attributes as $column => $value)
        {
            if ($column == "update_date")
            {
                $value = date('Y-m-d h:i:s');
                echo $value;
            }
            $updates[] = sprintf('%s = ?', $column);
            $values[] = $value;
        }

        $values[] = $this->getIdName();

        $sql = sprintf("UPDATE %s SET %s WHERE %s = ?", self::getTableName(), join(',', $updates), self::getPrimaryKeyName());
        echo $sql;
        self::$conn->prepare($sql)->execute($values);
    }

    public function hasMany($slaveClass, $slaveForeignKey, $localKey)
    {
        $localTable = self::getTableName();
        $slaveTable = $slaveClass::getTableName();
        $query = new QueryBuilder(self::$conn, [$localTable => '*',$slaveTable => '*'], get_class($this));
        return $query->where("$slaveTable.$slaveForeignKey = $localTable.$localKey", array()); //???Здесь не понятно
    }

    public function belongsTo($masterClass, $localKey, $masterForeignKey)
    {
        // TODO: automatically guess $masterForeignKey and $localKey (guess standard column names)
        $localTable = self::getTableName();
        $masterTable = $masterClass::getTableName();
        $query = new QueryBuilder(self::$conn, [$masterTable => '*'], $masterClass);
        return $query->where("`$localTable`.`$localKey` = `$masterTable`.`$masterForeignKey` AND `$localTable`.`$localKey` = ?", [$this->{$localKey}]);
    }
}