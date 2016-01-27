<?php
    
    require_once '../model/model.php';

    function addMovie($id, $title, $description, $poster_destination, $tagline, $date, $backdrop)
    {
        $db = getDBConnection();
        
        $query = 'INSERT INTO `movie` (MovieID, Title, Description, Poster, Tagline, ReleaseDate, Backdrop)
                VALUES (:MovieID, :Title, :Description, :Poster, :Tagline, :Date, :Backdrop)';
        $statement = $db->prepare($query);
        
        $statement->bindValue(':MovieID', $id);
        $statement->bindValue(':Title', $title);
        $statement->bindValue(':Description', $description);
        if ($poster_destination == null)
        {
            $statement->bindValue(':Poster', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':Poster', $poster_destination);
        }
        $statement->bindValue(':Tagline', $tagline);
        $statement->bindValue(':Date', $date);
        if ($backdrop == null)
        {
            $statement->bindValue(':Backdrop', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':Backdrop', $backdrop);
        }
        
        $success = $statement->execute();
        $statement->closeCursor();

        if ($success) 
        {
            return $id;         //movie's id from tmdb
        } 
        else 
        {
            logSQLError($statement->errorInfo());   //log error
        }
    }
    
    function deleteMovieItem($movieID)
    {
        $db = getDBConnection();
        //date is always unique
        $query = "DELETE from `movie` WHERE MovieID = :MovieID";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':MovieID', $movieID);
        
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
    
    function deleteMovieDate($date)
    {
        $db = getDBConnection();
        //date is always unique
        $query = "DELETE from `moviedates` WHERE Date = :Date";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':Date', $date);
        
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
    
    function getCompleteMovieList()
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT * FROM movie ORDER BY Title ASC";
            $statement = $db->prepare($query);
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
    
    //return the entire movie schedule starting from today
    function getCompleteMovieSchedule()
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT * FROM moviedates JOIN movie on moviedates.MovieID = movie.MovieID "
                    . "WHERE moviedates.Date >= CURDATE() "
                    . "ORDER BY moviedates.MovieID ASC";
            $statement = $db->prepare($query);
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
    
    //returns all the movies for the week to insert into table
    function getMovieSchedule()
    {
        try
        {
            $db = getDBConnection();
            $query = "select moviedates.Date, moviedates.MovieID, movie.Title from moviedates "
                    . "join movie on moviedates.MovieID = movie.MovieID "
                    . "WHERE moviedates.Date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)"
                    . "ORDER BY moviedates.Date ASC";
            $statement = $db->prepare($query);
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
    
    //returns all the movies for the week to insert into table
    function getMovieScheduleFull()
    {
        try
        {
            $db = getDBConnection();
            $query = "select moviedates.Date, moviedates.MovieID, movie.Title from moviedates "
                    . "join movie on moviedates.MovieID = movie.MovieID "
                    . "WHERE moviedates.Date > DATE_ADD(NOW(), INTERVAL -180 DAY)"
                    . "ORDER BY moviedates.Date ASC";
            $statement = $db->prepare($query);
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
    
    //returns all the movies for the week to insert into table
    function getMovieScheduleSingleItem($movieID)
    {
        try
        {
            $db = getDBConnection();
            $query = "select moviedates.Date, moviedates.MovieID, movie.Title from moviedates "
                    . "join movie on moviedates.MovieID = movie.MovieID "
                    . "WHERE moviedates.Date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) "
                    . "AND moviedates.MovieID = :MovieID "
                    . "ORDER BY moviedates.Date ASC";
            $statement = $db->prepare($query);
            $statement->bindValue(':MovieID', $movieID);
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
    
    function getMovieScheduleIDs()
    {
        try
        {
            $db = getDBConnection();
            $query = "select DISTINCT movie.Title, movie.MovieID, movie.Poster from moviedates "
                    . "join movie on moviedates.MovieID = movie.MovieID "
                    . "WHERE moviedates.Date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)";
            $statement = $db->prepare($query);
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
    
    function getMovieScheduleIDsFull()
    {
        try
        {
            $db = getDBConnection();
            $query = "select DISTINCT movie.Title, movie.MovieID, movie.Poster from moviedates "
                    . "join movie on moviedates.MovieID = movie.MovieID "
                    . "WHERE moviedates.Date > DATE_ADD(NOW(), INTERVAL -180 DAY)";
            $statement = $db->prepare($query);
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
    
    function getMovieItem($movieID)
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT * FROM movie WHERE MovieID = :MovieID";
            $statement = $db->prepare($query);
            $statement->bindValue(':MovieID', $movieID);
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
    
    function getMovieList()
    {
        try
        {
            $db = getDBConnection();
            $query = "SELECT * FROM movie ORDER BY Title ASC";
            $statement = $db->prepare($query);
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
    
    function insertMovieDate ($movieID, $dateTime)
    {
        $db = getDBConnection();
        
        $query = 'INSERT INTO `moviedates` (Date, MovieID)
                VALUES (:Date, :MovieID)';
        $statement = $db->prepare($query);
        
        $statement->bindValue(':Date', $dateTime);
        $statement->bindValue(':MovieID', $movieID);
        
        $success = $statement->execute();
        $statement->closeCursor();
        
            //if success is an array, then something actually went wrong
            //most likely duplicate entry
            if ( $success )
            {
                return false;
            }
            else
            {
                return true;        //movie went through
            }
    }

?>
