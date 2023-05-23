<?php

class Model_Core_Table_Resouce
{

    protected $resourceName = null;
    protected $adapter = null;
    protected $primaryKey = null;

    public function __construct()
    {

    }

    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
        return $this;
    }

    public function getResourceName()
    {
        return $this->resourceName;
    }

    public function setAdapter($adapter)
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
        $this->setAdapter($adapter);
        return $adapter;
    }

    public function setPrimaryKey()
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function fetchAll($query)
    {
        $result = $this->getAdapter()->fetchAll($query);
        if(!$result)
        {
            return false;
        }
        return $result;
    }

    public function fetchRow($query)
    {
        $result = $this->getAdapter()->fetchRow($query);
        if($result)
        {
            return $reesult;
        }
        throw new Exception("Error Processing Request", 1);
    }

    public function insert($data)
    {
        $keys = array_keys($data);
        $values = array_values($data);

        $keyString = "`" . implode("`,`", $keys)."`";
        $valueString = "'" .implode("','", $values)."'";

        $sql = "INSERT INTO `{$this->getResourceName()}` ({$keyString}) VALUES ({$valueString})";
        return $this->getAdapter()->insert($sql);
    }

    public function update($data, $conditions)
    {
        foreach($data as $key => $value)
        {
            $keys[] = "`$key` = '$value'";
        }
        $keyString = impload(',',$keys);

        foreach($conditions as $key => $value)
        {
            $conditionArray[] = "`$key` = '$value'";
        }
        $valueString = implode('AND',$conditionArray);

        $sql = "UPDATE `{$this->getResourceName()}` SET {$keyString} WHERE {$valueString}";
        return $this->getAdapter()->update($sql);
    }

    public function delete($conditions)
    {
        foreach($conditions as $key => $value)
        {
            $conditionArray[] = "`$key` = '$value'";
        }

        $keyString = implode('AND',$conditionArray);

        $sql = "DELETE FROM `{$this->getResourceName()}` WHERE {$keyString}";
        return $this->getAdapter()->delete($sql);
    }

    public function load($value,$column = null)
    {
        $column = (!$column) ? $this->getPrimaryKey() : $column;
        $sql = "SELECT * FROM `{$this->getResourceName()}` WHERE `{$column}` = {$value} ";
        $row = $this->getAdapter()->fetchRow($sql);
        return $row;
    }

}


?>