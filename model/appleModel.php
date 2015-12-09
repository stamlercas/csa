<?php
    
    require_once '../model/model.php';
    
    function deleteAppleItem($appleID)
    {
        $db = getDBConnection();
        
        $query = "DELETE from `apple` WHERE AppleID = :AppleID";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':AppleID', $appleID);
        
        $success = $statement->execute();
        $statement->closeCursor();
        
        if ($success)
        {
            return $statement->rowCount();
        }
        else
        {
            logSQLError($statement->errorInfo());
        }
    }
    
    function getLatestAppleItem()
    {
        try
        {
            $db = getDBConnection();
            $query = "select * from `apple` ORDER BY Date DESC LIMIT 1";
            //$query = "SELECT * FROM `email` order by EmailID";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetch();
            $statement->closeCursor();
            return $results;
        } 
        catch (PDOException $e) 
        {
            $errorMsg = $e->getMessage();
            include "../view/errorPage.php";
            die;
        }
    }
    
    function getAppleItem($appleID)
    {
        try
        {
            $db = getDBConnection();
            $query = "select * from `apple` WHERE AppleID = :AppleID";
            //$query = "SELECT * FROM `email` order by EmailID";
            $statement = $db->prepare($query);
            $statement->bindValue(':AppleID', $appleID);
            $statement->execute();
            $results = $statement->fetch();
            $statement->closeCursor();
            return $results;
        } 
        catch (PDOException $e) 
        {
            $errorMsg = $e->getMessage();
            include "../view/errorPage.php";
            die;
        }
    }
    
    function getAppleItems()
    {
        try
        {
            $db = getDBConnection();
            $query = "select * from `apple` order by Date DESC";
            //$query = "SELECT * FROM `email` order by EmailID";
            $statement = $db->prepare($query);
            //$statement->bindValue(':page', $page);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } 
        catch (PDOException $e) 
        {
            $errorMsg = $e->getMessage();
            include "../view/errorPage.php";
            die;
        }
    }
    
    function insertAppleItem($image, $title)
    {
        $db = getDBConnection();
        
        $query = 'INSERT INTO `apple` (ImagePath, Title) VALUES (:ImagePath, :Title)';
        $statement = $db->prepare($query);
        
        $statement->bindValue(':ImagePath', $image);
        if (empty($title))
        {
            $statement->bindValue(':Title', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':Title', $title);
        }
        
        $success = $statement->execute();
        $statement->closeCursor();

        if ($success) 
        {
            return $db->lastInsertId(); //get id for show
        } 
        else 
        {
            logSQLError($statement->errorInfo());   //log error
        }
    }
    
    function updateAppleItem($appleID, $title)
    {
        $db = getDBConnection();
        $query = 'UPDATE apple SET Title = :Title '.
            'WHERE AppleID = :AppleID';
        $statement = $db->prepare($query);
        $statement->bindValue(':AppleID', $appleID);
        $statement->bindValue(':Title', $title);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success)
        {
            return $statement->rowCount(); // Number of rows affected
        } 
        else
        {
        logSQLError($statement->errorInfo()); // Log error to debug
        }
    }


?>

