<?php
    
    //tmdb api key
    define('TMDB_URI', 'https://api.themoviedb.org/3/');
    define('API_KEY', '166547236c6c7c2a230787e413461366');

    //gets the function call from func and the rest of the query string are dependent on
    //the api request
    if (isset($_POST['func']))
    {
        $func = $_POST['func'];
        
        //all the functions
        switch($func)
        {
            case 'SearchMovie':
                searchMovie();
                break;
            case 'GetMovie':
                $id = $_POST['id'];
                getMovie($id);
                break;
        }
    }
    
    
    //when adding a movie it searches and returns the list
    function searchMovie()
    {
        //multiple words
        $query = urlencode($_POST['query']);
        
        //the json link
        $jsonMovieList = TMDB_URI . 'search/movie?query='. $query . '&api_key=' . API_KEY;
        $json = file_get_contents($jsonMovieList);
        
        //the movie list object
        $movieList = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
        
        //bring the json object back to page
        echo json_encode($movieList['results']);
    }
    
    //return json object of specified movie
    function getMovie($id)
    {
        $url = TMDB_URI . "movie/$id". '?api_key=' . API_KEY;
        
        $json = file_get_contents($url);
        $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
        
        //return the json obj
        return $obj;
    }



?>

