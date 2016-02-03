<?php

    require_once __DIR__ . '/db.php';
    
    function deleteFormItemById($formID)
    {
        $db = new DB();
        $db->bind('FormID', $formID);
        $result = $db->query('DELETE FROM forms WHERE FormID = :FormID');
        return $result;
    }
    
    function getFormItemById($formID)
    {
        $db = new DB();
        $db->bind('FormID', $formID);
        $result = $db->query('SELECT * FROM forms WHERE FormID = :FormID');
        return $result[0];  //single item
    }
    
    function getForms()
    {
        $db = new DB();
        $results = $db->query('SELECT FormID, Name, Disclaimer, LastUpdated, Url FROM forms ORDER BY Name');
        return $results;
    }
    
    function insertForm($name, $disclaimer, $uploadFile)
    {
        $db = new DB();
        $db->bind('Name', $name);
        if (empty($disclaimer))
        {
            $db->bind('Disclaimer', null);
        }
        else
        {
            $db->bind('Disclaimer', $disclaimer);
        }
        $db->bind('Url', $uploadFile);
        
        $result = $db->query('INSERT INTO forms (Name, Disclaimer, Url) VALUES (:Name, :Disclaimer, :Url)');
        
        return $db->lastInsertId();
    }
    
    function updateForm($formID, $name, $disclaimer, $uploadFile)
    {
        $db = new DB();
        $db->bind('FormID', $formID);
        $db->bind('Name', $name);
        if (empty($disclaimer))
        {
            $db->bind('Disclaimer', null);
        }
        else
        {
            $db->bind('Disclaimer', $disclaimer);
        }
        
        if ($uploadFile == null)
        {
            $result = $db->query('UPDATE forms SET Name = :Name, Disclaimer = :Disclaimer WHERE FormID = :FormID');
        }
        else
        {
            $db->bind('Url', $uploadFile);
            $result = $db->query('UPDATE forms SET Name = :Name, Disclaimer = :Disclaimer, Url = :Url WHERE FormID = :FormID');
        }
        
        return $result;
    }
    
    ?>