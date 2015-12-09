<?php
    session_start();
    require_once( "../security/model.php");

    require_once '../model/model.php';
    require_once '../model/newsModel.php';
    require_once '../lib/generalFuncs.php';
    
    unQuote();              //magic quotes checking
    
    //whether or not is POST or GET
    if (isset($_POST['action']))
    {
        $action = $_POST['action'];
    }
    else if (isset($_GET['action']))
    {
        $action = $_GET['action'];
    }
    else
    {
        newsHome();
        exit();
    }

    if ($action != 'SecurityLogin' && $action != 'SecurityProcessLogin' && !userIsAuthorized($action)) {
        if(!loggedIn()) {
            header("Location:../security/index.php?action=SecurityLogin&RequestedPage=" . urlencode($_SERVER['REQUEST_URI']));
        } else {
            include ( '../security/not_authorized.html');
        }
    } else {
        switch($action)
        {
            case 'addNews':
                addNews();
                break;
            case 'index':
                newsHome();
                break;
            case 'newsDisp':
                newsDisp();
                break;
            default:
                newsHome();
                break;
        }
    }
    
    function addNews()
    {
        $mode = 'Add';
        $newsID = '';
        $headline = '';
        $content = '';
        
        include '../view/editNews.php';
    }
    
    function newsDisp()
    {
        if (isset($_GET['Slug']))
        {
            $newsSlug = $_GET['Slug'];
        }
        else 
        {
            $errorMsg = 'You must provide a valid url.';
            include '../view/errorPage.php';
        }
        
        $row = getNewsItem($newsSlug);
        if ($row == false)
        {
            $errorMsg = 'This item was not found.';
            include '../view/errorPage.php';
        }
        else 
        {
            include '../view/newsDisp.php';
        }
    }
    
    //get the news homepage
    function newsHome()
    {
        if (isset($_GET['Page']))
        {
            $page = $_GET['Page'];
        }
        else
        {
            $page = 1;
        }
        
        if (isset($_GET['NewsType']))
        {
            $listType = $_GET['NewsType'];
            
            if ($listType == "Search")
            {
                $criteria = $_GET['criteria'];
                $results = getGeneralNewsSearch( $criteria, $page );
                $emailCountTemp = getNewsListCountSearch($criteria);

                //url for moving to different pages
                $queryUrl = "NewsType=Search&criteria=$criteria";
            }
        }
        else
        {
            //get the news items for the proper page, and display
            $results = getNewsList($page);
            $newsCountTemp = getNewsListCount();
        }
        
        
        if (count($results) == 0)
        {
            //no news items are found, returns nothing
            $errorMsg = "No Items were found.";
            include '../view/errorPage.php';
        }
        //for searches containing a single item
        else if (count($results) == 1)
        {
            $row = $results[0];
            include '../view/newsDisp.php';
        }
        else
        {
            //$emailCountTemp is part of an array, only index
            $newsCount = ceil($newsCountTemp[0] / 50);
            include '../view/news.php';
        }
    }
    
    
?>