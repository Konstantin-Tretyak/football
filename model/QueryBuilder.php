<?php

class QueryBuilder
{
    protected $conn;
    protected $query;
    protected $bindings = array();

    public function __construct($conn, $columnsToSelect, $resultClass = null)
    {
        $this->conn = $conn;

        $_columns = [];
        foreach ($columnsToSelect as $table => $columns)
        {
            if ($columns == '*')
            {
                $_columns[] = "$table.*";
            }
            else
            {
                foreach ($columns as $column)
                {
                    $_columns[] = "$table.$column";
                }
            }
        }
            $this->query = "select ".join(',', $_columns)." from ".join(',',array_keys($columnsToSelect));
            ///???Что значит stdClass
            $this->resultClass = empty($resultClass) ? 'stdClass' : $resultClass;
    }

    public function all()
    {
        $statement = $this->conn->prepare($this->query);
        $statement->execute($this->bindings);

        return $statement->fetchAll(PDO::FETCH_CLASS, $this->resultClass);
    }

    public function first()
    {
        $results = $this->limit(1)->all();
        return $results ? $results[0] : null;
    }

    public function limit($limit)
    {
        $this->query .= " LIMIT $limit";
        return $this;
    }

    /* TODO: allow multiple WHERE's */
    public function where($condition, $bindings)
    {
        ///???? Тут ищет первый попавшийся WHERE с учетом регитсра.
        ///???? Можна ли таблицу называть WHERE, что бы не было совпадений.
        if (strpos($this->query, "WHERE") )
        {
            $this->query .= " AND $condition";
            echo $this->query;
        }
        else
        {
        $this->query .= " WHERE $condition";
        }

        $this->bindings = $bindings;
        return $this;
    }

    /*public function conditionRow($condition, $bindings)
    {
        if ( strpos($condition, "WHERE") >= 0)
        {
            if( strripos($this->query, "select") === false )
                return $this;
            if( strripos($this->query, "WHERE") !== false)
                str_replace("WHERE", "AND", $condition);
        }
        else if ( strpos($condition, "AND") === false or
                  strpos($condition, "OR") === false )
        {
            $this->query .= " AND $condition";
        }
        else
        {
            $this->query .= " $condition";
        }

        echo $this->query;
        $this->bindings = $bindings;
        return $this;
    }*/

    public function order_by($order)
    {
        $this->query .= " ORDER BY $order";
        return $this;
    }
}