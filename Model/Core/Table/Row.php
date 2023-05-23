<?php

class Model_Core_Table_Row
{
    protected $table = null;
    protected $tableClass = "Model_Core_Table";
    protected $data = [];

    public function setTableClass($tableClass)
    {
        $this->tableClass = $tableClass;
        return $this;
    }

    public function getTableClass()
    {
        if($this->tableClass)
        {
            return $this->tableClass;
        }

        $tableClass = new $tableClass();
        $this->setTableClass($tableClass);
        return $tableClass;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function getTable()
    {
        if($this->table)
        {
            return $this->table;
        }

        $table = new $this->tableClass();
        $table = $this->setTable($table);
        return $table;
    }

    public function getTableName()
    {
        return $this->getTable()->getTableName();
    }
    
    public function getPrimaryKey()
    {
        return $this->getTable()->getPrimaryKey();
    }

    public function setId($id)
    {
        $this->data[$this->getTable()->getPrimaryKey()] = (int)$id;
        return $this;
    }

    public function getId()
    {
        $primaryKey = $this->getTable()->getPrimaryKey();
        return (int)$this->$primaryKey;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData($key=null)
    {
        if(array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function removeData($key=null)
    {
        if($key == null)
        {
            $this->data = [];
        }

        if(array_key_exists($key, $this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function fetchRow($query)
    {
        $result = $this->getTable()->fetchRow($query);
        if($result)
        {
            $this->data = $result;
            return $this;
        }
        return false;
    }

    public function fetchAll($query)
    {
        $result = $this->getTable()->fetchAll($query);

        if(!$result)
        {
            return false;
        }

        return $result;
    }

    public function load($id, $column=null)
    {
        if(!$column)
        {
            $column = $this->getPrimaryKey();
        }

        $sql = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}` = {$id} ";
        $result = $this->getTable()->fetchRow($sql);

        if($result)
        {
            return $this->data= $result;
        }
        return $this;
    }

    public function save()
    {
        if(!array_key_exists($this->getPrimaryKey(), $this->data))
        {
            $id = $this->getTable()->insert($this->data);
            if($id)
            {
                return $this->load($id);
            }
            return false;
        }
        else
        {
            $id = $this->getData($this->getPrimaryKey());
            $condition[$this->getPrimaryKey()] = $id;

            $result = $this->getTable()->update($this->data, $condition);
            if($result)
            {
                return $this->load($id);
            }
            return false;
        }
    }

    public function delete()
    {
        $id = $this->getData($this->getPrimaryKey());
        if(!$id){
            return false;
        }

        $condition[$this->getPrimaryKey()] = $id;
        $result = $this->getTable()->delete($condition);

        if($result)
        {
            return true;
        }
        return false;

    }
}

?>