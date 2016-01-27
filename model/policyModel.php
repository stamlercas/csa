<?php

    require_once __DIR__ . '/db.php';
    
    function getPolicyItemById($policyID)
    {
        $db = new DB();
        $db->bind('PolicyID', $policyID);
        $result = $db->query('SELECT * FROM policies WHERE PolicyID = :PolicyID');
        return $result[0];  //single item
    }
    
    function getPolicies()
    {
        $db = new DB();
        $results = $db->query('SELECT PolicyID, Name, Disclaimer, Url FROM policies ORDER BY Name');
        return $results;
    }
    
    function insertPolicy($name, $disclaimer, $uploadFile)
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
        
        $result = $db->query('INSERT INTO policies (Name, Disclaimer, Url) VALUES (:Name, :Disclaimer, :Url)');
        
        return $db->lastInsertId();
    }
    
    function updatePolicy($policyID, $name, $disclaimer, $uploadFile)
    {
        $db = new DB();
        $db->bind('PolicyID', $policyID);
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
        
        if ($uploadFile == null)
        {
            $result = $db->query('UPDATE policies SET Name = :Name, Disclaimer = :Disclaimer WHERE PolicyID = :PolicyID');
        }
        else
        {
            $result = $db->query('UPDATE policies SET Name = :Name, Disclaimer = :Disclaimer, Url = :Url WHERE PolicyID = :PolicyID');
        }
        
        return $result;
    }

