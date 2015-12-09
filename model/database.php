<?php
    require('../lib/log.php');
    class Database
    {
        private $host;
        private $db;
        private $dbname;
        private $username;
        private $password;
        
        private $log;
        
        public function __construct($host, $dbname, $username, $password)
        {
            $this->host = $host;
            $this->dbname = $dbname;
            $this->username = $username;
            $this->password = $password;
            
            $this->log = new Log();
            
            $this->db = getDBConnection();
        }
        
        private function ExceptionLog($message , $sql = "")
	{
		$exception  = 'Unhandled Exception. <br />';
		$exception .= $message;
		$exception .= "<br /> You can find the error back in the log.";
		if(!empty($sql)) {
			# Add the Raw SQL to the Log
			$message .= "\r\nRaw SQL : "  . $sql;
		}
			# Write into log
			$this->log->write($message);
		return $exception;
        }
        
        function defaultQuery($query, array $fields = null, array $values = null)
        {
            $statement = $db->prepare($query);
            for ($i = 0; $i < count($values); $i++)
            {
                //if empty, then place null instead of the empty string
                if (empty($values[$i]))
                    $statement->bindValue(":$fields[$i]", null, PDO::PARAM_NULL);
                else
                    $statement->bindValue(":$fields[i]", $values[i]);
            }
            $success = $statement->execute();
            $statement->closeCursor();
            if ($success)
            {
                return ;
            }
        }
        
        function deleteQuery($table, $field, $value)
        {
            $query = "DELETE FROM `$table` WHERE $field = :$field";
            $statement = $db->prepare($query);
            $statement->bindValue(":$field", $value);
            $success = $statement->execute();
            $statement->closeCursor();
            if ($success)
            {
                return $statement->rowCount();
            }
            else
            {
                $this->ExceptionLog($statement->errorInfo());
            }
        }
        
        //connects db
        private function getDBConnection()
        {
            $dsn = "mysql:host=$host;dbname=$dbname";

            try
            {
                $db = new PDO($dsn, $this->username, $this->password);
            } catch (PDOException $e)
            {
                //write into log
                echo $this->ExceptionLog($e->getMessage());
                die;
            }
            return $db;
        }
        
        function getRow()
        {
            
        }
        
        function insertQuery($table, array $fields, array $values)
        {
            
            $query = "INSERT INTO `$table` (";
            foreach ($fields as $field)
            {
                $query .= $field;
                if ($i != count($fields))       //not the last element
                    $query .= ", ";
                else
                    $query .= ") ";
            }
            $query .= "VALUES (";
            //now for values
            for ($i = 0; $i < count($fields); $i++)
            {
                $query .= ":$field";
                if ($i != count($fields))
                    $query .= ", ";
                else
                    $query .= ")";
            }
            $statement = $db->prepare($query);
            //binding values, for protection against sql injection
            for ($i = 0; $i < count($values); $i++)
            {
                //if empty, then place null instead of the empty string
                if (empty($values[$i]))
                    $statement->bindValue(":$fields[$i]", null, PDO::PARAM_NULL);
                else
                    $statement->bindValue(":$fields[i]", $values[i]);
            }

            $success = $statement->execute();
            $statement->closeCursor();

            if ($success) 
            {
                return $db->lastInsertId(); //get id
            } 
            else 
            {
                $this->ExceptionLog($statement->errorInfo());   //log error
            }	
        }
        
        function updateQuery($table, array $fields, array $values, $idField, $idValue)
        {
            $query = "UPDATE `$table` SET ";
            foreach ($fields as $field)
            {
                $query .= "$field = :$field";
                if ($i != count($fields))       //not the last element
                    $query .= ", ";
            }
            $query .= " WHERE $idField = :$idField";
            $statement = $db->prepare($query);
            //binding values, for protection against sql injection
            for ($i = 0; $i < count($values); $i++)
            {
                //if empty, then place null instead of the empty string
                if (empty($values))
                    $statement->bindValue(":$fields[$i]", null, PDO::PARAM_NULL);
                else
                    $statement->bindValue(":$fields[i]", $values[i]);
            }
            $statement->bindValue(":$idField", $idValue);
            $success = $statement->execute();
            $statement->closeCursor();

            if ($success) 
            {
                return $db->lastInsertId(); //get id
            } 
            else 
            {
                $this->ExceptionLog($statement->errorInfo());   //log error
            }	
        }
    }

?>

