<?php

class DataBase
{
    private $conn;
    private $query;
    private $statement;
    public $table;
    public $id;

    private $where_expression = '';

    public function __construct($table)
    {
        $config = array('username' => 'root',
                        'password' => '');

        $this->conn = new PDO('mysql:host=localhost;dbname=foot',
                        $config['username'],
                        $config['password']);

        $this->table = $table;

        ///Для того, что бы добавить в объект данные из таблицы
            $this->all();
            $this->query();
            $data_to_extract = $this->statement->fetch();

            foreach ($data_to_extract as $key => $value)
            {
                $this->$key = "";
            }
        ///
    }

    public function find($number)
    {
        $this->id = $number;

        $this->all();
        $this->where("id","=","$this->id");

        return $this;
    }

    private function query()
    {
        $this->statement = $this->conn->query($this->query);
    }


    ///Condition methods
    public function where($operand_1, $operator, $operand_2)
    {
        $this->where_expression = "WHERE $operand_1 $operator".$this->conn->quote($operand_2)." ";
        $this->query.= $this->where_expression;

        return $this;
    }

    public function whereString($string)
    {
        $this->where_expression = "WHERE ".$string." ";
        $this->query.=$this->where_expression;

        return $this;
    }

    public function whereExpression($type, $operand_1, $operator, $operand_2)
    {
        ///как взять из строки первые 5 букв, ну или же, я так понимаю, нужно задать выражение
        if ($this->where_expression[0] == "W")
        {
            $where_expression = "$type $operand_1 $operator".$this->conn->quote($operand_2)." ";

            $this->query.= $where_expression;
            $this->where_expression.= $where_expression;

            return $this;
        }

        return null;
    }

    //public function append_condition()

    ///End Condition methods

    public function get()
    {
        $this->query();

        foreach ($this->statement as $row)
        {
            var_dump($row);
        }
    }

    public function innerJoin($other_table, $operand_this, $operator, $operand_other_table)
    {
        $table_name = $other_table->table;
        $this->table.= " INNER JOIN $table_name 
                        ON $this->table.$operand_this $operator $table_name.$operand_other_table";

        return $this;
    }

    public function order($table, $by)
    {
        $this->query.=" ORDER BY $table->table.$by";

        return $this;
    }

    public function all()
    {
        $this->query = "SELECT * FROM ($this->table) ";

        return $this;
    }
}