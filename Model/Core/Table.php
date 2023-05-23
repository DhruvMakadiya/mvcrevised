<?php

class Model_Core_Table
{
    protected $tableName = null;
    protected $primaryKey = null;
    protected $adapter = null;

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if($this->adapter)
        {
            return $this->adapter;
        }

        $adapter = Ccc::getModel('Core_Adapter');
        $adapter->setAdapter($adapter);
        return $adapter;
    }

    public function fetchAll()
    {
        return $this->getAdapter()->fetchAll();
    }

    public function fetchRow()
    {
        return $this->getAdapter()->fetchRow();
    }

    public function insert($data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        
        $columns = "`" . implode("`,`", $keys). "`";
        $values = "'" . implode("','", $values) . "'";

        $sql = "INSERT INTO `{$this->getTableName}` ({$columns}) VALUES ({$values}) ";
        return $this->getAdapter()->insert($sql);
    }

    public function update($data, $conditions)
    {
        foreach($data as $key => $value)
        {
            $keys[] = "`$key`='$value'";
        }
        $keyValueString = implode(',', $keys);

        foreach($conditions as $key => $value)
        {
            $conditionArray[] = "`$key`='$values'";
        }
        $primaryKeyString = implode('AND', $conditionArray);

        $sql = "UPDATE `{$this->getTableName()}' SET {$keyValueString} WHERE {$primaryKeyString}";
        return $this->getAdapter()->update($sql);
    }

    public function delete($condition)
    {
        foreach($condition as $key => $value)
        {
            $conditionArray[] = "`$key`='$value'";
        }
        $keyString = implode('AND', $conditionArray);

        $sql = "DELETE FROM `{$this->getTableName}' WHERE {$keyString}";
        return $this->getAdapter()->delete($sql);
    }

    public function load($value, $column = null)
    {
        $column = (!$column) ? $this->getPrimaryKey() : $column;
        $sql = "SELECT * FROM `{$this->getTableName}` WHERE `{$column}` = {$value}";
        return $this->getAdapter()->fetchRow($sql);
    }



}
?>