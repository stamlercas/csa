<?php
    
    function deleteNewsItem($newsID)
    {
        $db = getDBConnection();
        
        $query = "DELETE from `news` WHERE NewsID = :NewsID";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':NewsID', $newsID);
        
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
    
    function getDBConnection()
    {
        $dsn = 'mysql:host=localhost;dbname=csa';
        $username = 's_castamler';
        $password = 'Andrew94';
        
        try
        {
            $db = new PDO($dsn, $username, $password);
        } catch (PDOException $e)
        {
            $errorMsg = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
        return $db;
    }
    
    function getNewsEditUserID($newsID)
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT users.UserName FROM news JOIN users ON news.EditUserID = users.UserID "
                    . "WHERE NewsID = :NewsID";
            $statement = $db->prepare($query);
            $statement->bindValue(':NewsID', $newsID);
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
    
    function getNewsItem($newsSlug)
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT * FROM news join users on news.userID = users.userID WHERE Slug = :Slug";
            $statement = $db->prepare($query);
            $statement->bindValue(':Slug', $newsSlug);
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
    
    function getNewsItemById($newsID)
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT * FROM news join users on news.userID = users.userID WHERE NewsID = :NewsID";
            $statement = $db->prepare($query);
            $statement->bindValue(':NewsID', $newsID);
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
    
    function getNewsList($page = -1, $numberOfItemsPerPage)
    {
        //where to start grabbing items
        $startFrom = ($page - 1) * $numberOfItemsPerPage;
        try
        {
            $db = getDBConnection();
            $query = "select * from `news` join users on news.userID = users.userID order by DateSubmitted ";
            if ($page != -1)
            {
                $query .= "DESC LIMIT $startFrom, $numberOfItemsPerPage";
            }
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
    
    function getNewsListCount()
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT COUNT(NewsID) FROM news";
            $statement = $db->prepare($query);
            //$statement->bindValue(':page', $page);
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
    
    //insert the news item into the db
    //THIS IS DONE AFTER CHECKING IF SLUG ALREADY EXISTS
    function insertNewsItem($headline, $content, $slug, $userID, $image)
    {
        $db = getDBConnection();
        
        $query = 'INSERT INTO `news` (Headline, Content, UserID, DateEdited, Slug, Image)
                VALUES (:Headline, :Content, :UserID, :DateEdited, :Slug, :Image)';
        $statement = $db->prepare($query);
        
        $statement->bindValue(':Headline', $headline);
        $statement->bindValue(':Content', $content);
        $statement->bindValue(':UserID', $userID);
        //Hasn't been edited yet
        $statement->bindValue(':DateEdited', null, PDO::PARAM_NULL);
        $statement->bindValue(':Slug', $slug);
        $statement->bindValue(':Image', $image);
        
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
    
    function logSQLError($errorInfo)
    {
        $errorMsg = $errorInfo[2];
        include '../view/errorPage.php';
    }
    
    //the slug needs to be unique, if slug is added that already exists, it will link back to that original
    //slug and doesn't add any new info
    function SlugExists($slug) 
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT COUNT(Slug) FROM news WHERE Slug = :Slug";
            $statement = $db->prepare($query);
            $statement->bindValue(':Slug', $slug);
            $statement->execute();
            $results = $statement->fetch();
            $statement->closeCursor();
            
            if ($results[0] != 0)
            {
                return true;
            }
        } 
        catch (PDOException $e) 
        {
            $errorMsg = $e->getMessage();
            include "../view/errorPage.php";
            die;
        }
    }
    
    function updateNewsItem($newsID, $headline, $content, $userID)
    {
        $db = getDBConnection();
        $query = 'UPDATE news SET Headline = :Headline, Content = :Content, EditUserID = :EditUserID,
             DateEdited = NOW() ' .
            'WHERE NewsID = :NewsID';
        $statement = $db->prepare($query);
        $statement->bindValue(':Headline', $headline);
        $statement->bindValue(':Content', $content);
        $statement->bindValue(':EditUserID', $userID);
        $statement->bindValue(':NewsID', $newsID);
        //$statement->bindValue(':YouTubeLink', $youTube);
        
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

