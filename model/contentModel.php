<?php
    require_once __DIR__ . '/db.php';

    function getContentItem($contentID)
    {
        $db = new DB();
        $db->bind('ContentID', $contentID);
        $result = $db->query('SELECT * FROM content WHERE ContentID = :ContentID');
        return $result[0];  //single item
    }
    
    function updateContent($contentID, $title, $content, $userID)
    {
        $db = new DB();
        $db->bind('ContentID', $contentID);
        $db->bind('Title', $title);
        $db->bind('Content', $content);
        $db->bind('User', $userID);
        $result = $db->query('UPDATE content SET Title = :Title, Content = :Content, LastEditedBy = :User WHERE ContentID = :ContentID');
        
        return $result;
    }

