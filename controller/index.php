<?php
    session_start();
    require_once( "../security/model.php");

    require_once '../model/model.php';
    require_once '../model/appleModel.php';
    require_once '../model/movieModel.php';
    require_once '../lib/generalFuncs.php';
    require_once '../lib/tmdbAPIfuncs.php';
    
    unQuote();              //magic quotes checking
    
    //tmdb api key
    $tmdbapi = 'https://api.themoviedb.org/3/';
    $apikey = '166547236c6c7c2a230787e413461366';
    
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
        //homePage();
        home();
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
            //alphabetical order
            case 'about':
                include '../view/about.php';
                break;
            case 'addApple':
                addApple();
                break;
            case 'addMovie':
                include '../view/addMovie.php';
                break;
            case 'addMovieListing';
                addMovieListing();
                break;
            case 'addNews':
                addNews();
                break;
            case 'admin':
                include '../view/admin.php';
                break;
            case 'apple':
                apple();
                break;
            case 'ata':
                include '../view/ata.php';
                break;
            case 'bus':
                include '../view/bus.php';
                break;
            case 'busBreak':
                include '../view/busSchedule.php';
                break;
            case 'deleteApple':
                deleteApple();
                break;
            case 'deleteDate':
                deleteDate();
                break;
            case 'deleteMovie':
                deleteMovie();
                break;
            case 'deleteNews':
                deleteNews();
                break;
            case 'editApple':
                editApple();
                break;
            case 'editNews':
                editNews();
                break;
            case 'fundraising':
                include '../view/fundraising.php';
                break;
            case 'home':
                home();
                break;
            case 'movieDisp':
                movieDisp();
                break;
            case 'movieList':
                movieList();
                break;
            case 'movies':
                include '../view/moviesHome.php';
                break;
            case 'movieSchedule':
                movieSchedule();
                break;
            case 'movieWeeklySchedule':
                movieWeeklySchedule();
                break;
            case 'news':
                newsHome();
                break;
            case 'newsDisp':
                newsDisp();
                break;
            case 'processAddMovie':
                processAddMovie();
                break;
            case 'processAddMovieListing':
                processAddMovieListing();
                break;
            case 'processAddEditNews':
                processAddEditNews();
                break;
            case 'processAddEditApple':
                processAddEditApple();
                break;
            case 'processSlideshowFileDelete':
                processSlideshowFileDelete();
                break;
            case 'processSlideshowFileUpload':
                processSlideshowFileUpload();
                break;
            case 'slideshowFileUpload':
                $msg = '';
                include '../view/slideShowFileUpload.php';
                break;
            default:
                home();
                break;
        }
    }
    
    function addApple()
    {
        $mode = 'Add';
        $appleID = '';
        $image = '';
        $appleTitle = '';
        
        include '../view/editApple.php';
    }
    
    function addMovieListing()
    {
        $movieList = getMovieList();
        include '../view/addMovieListing.php';
    }
    
    function addNews()
    {
        $mode = 'Add';
        $newsID = '';
        $headline = '';
        $content = '';
        
        //whenever you add you can't have any previous errors
        $errors = '';
        
        include '../view/editNews.php';
    }
    
    function apple()
    {
        $results = getAppleItems();
        include '../view/apple.php';
    }
    
    function deleteApple()
    {
        $appleID = $_GET['AppleID'];
        $imagePath = $_GET['ImagePath'];
        if (!isset($appleID))
        {
            $errorMsg = 'You must provide a proper AppleID.';
            include '../view/errorPage.php';
        }
        else if (!isset($imagePath))
        {
            $errorMsg = 'You must provide a proper image path.';
            include '../view/errorPage.php';
        }
        else
        {
            $rowCount = deleteAppleItem($appleID);
            if ($rowCount != 1)
            {
                $errorMsg = "The delete affected $rowCount rows.";
                include '../view/errorPage.php';
            }
            else
            {
                //need to delete image from server
                unlink($imagePath);
                header("Location:../apple/");
            }
        }
    }
    
    function deleteDate()
    {
        $date = urldecode($_GET['Date']);
        if (!isset($date))
        {
            $errorMsg = 'No movie date found.';
            include '../view/errorPage.php';
        }
        else
        {
            $rowCount = deleteMovieDate($date);
            if ($rowCount != 1)
            {
                $errorMsg = "The delete affected $rowCount rows.";
                include '../view/errorPage.php';
            }
            else
            {
                header("Location:../movies/schedule");
            }
        }
    }
    
    function deleteMovie()
    {
        $movieID = urldecode($_GET['MovieID']);
        if (!isset($movieID))
        {
            $errorMsg = 'No movie found.';
            include '../view/errorPage.php';
        }
        else
        {
            $rowCount = deleteMovieItem($movieID);
            if ($rowCount != 1)
            {
                $errorMsg = "The delete affected $rowCount rows.";
                include '../view/errorPage.php';
            }
            else
            {
                header("Location:../movies/list");
            }
        }
    }
    
    function deleteNews()
    {
        $newsID = $_GET['NewsID'];
        if (!isset($newsID))
        {
            $errorMsg = 'You must provide a proper NewsID.';
            include '../view/errorPage.php';
        }
        else
        {
            $rowCount = deleteNewsItem($newsID);
            if ($rowCount != 1)
            {
                $errorMsg = "The delete affected $rowCount rows.";
                include '../view/errorPage.php';
            }
            else
            {
                header("Location:../news/");
            }
        }
    }
    
    function editApple()
    {
        $appleID = $_GET['AppleID'];
        if (!isset($appleID))
        {
            $errorMsg = 'You must provide an AppleID to display.';
            include '../view/errorPage.php';
        }
        else 
        {
            $row = getAppleItem($appleID);
            if ($row == FALSE) 
            {
                $errorMsg = 'That apple item was not found.';
                include '../view/errorPage.php';
            } 
            else 
            {
                $mode = 'Edit';
                $appleID = $row['AppleID'];
                $image = $row['ImagePath'];
                $appleTitle = $row['Title'];
                
                include '../view/editApple.php';
            }
        }
    }
    
    function editNews()
    {
        $newsID = $_GET['NewsID'];
        if (!isset($newsID))
        {
            $errorMsg = 'You must provide a NewsID to display.';
            include '../view/errorPage.php';
        }
        else
        {
            $row = getNewsItemById($newsID);
            if ($row == false)
            {
                $errorMsg = 'That NewsID was not found.';
                include '../view/errorPage.php';
            }
            else
            {
                $mode = 'Edit';
                $newsID = $row['NewsID'];
                $headline = $row['Headline'];
                $content = $row['Content'];
                
                $errors = '';
                
                include '../view/editNews.php';
            }
        }
    }
    
    function home()
    {
        //first page will get most recent news, and number of items will get
        //the number of items you want to display on the homepage
        $newsResults = getNewsList(1, 3);
        
        $movieItems = getMovieScheduleIDs();        //for movie listings
        
        $appleItem = getLatestAppleItem();
        
        include '../view/home.php';
    }
    
    function movieDisp()
    {
        if (isset($_GET['MovieID']))
        {
            $movieID = $_GET['MovieID'];
        }
        else 
        {
            $errorMsg = 'You must provide a valid url.';
            include '../view/errorPage.php';
        }
        
        $row = getMovieItem($movieID);
        $movieSchedule = getMovieScheduleSingleItem($movieID);
        if ($row == false)
        {
            $errorMsg = 'This item was not found.';
            include '../view/errorPage.php';
        }
        else 
        {
            include '../view/movieDisp.php';
        }
    }
    
    function movieWeeklySchedule()
    {
        $results = getMovieSchedule();          //get all the movies for the week
        $movieItems = getMovieScheduleIDs();    //get all the movie ids for the week to match with the schedule
        include '../view/movieTheater.php';
    }
    
    function movieList()
    {
        $results = getCompleteMovieList();
        
        if(count($results) == 0)
        {
            $errorMsg = 'Could not find movies.';
            include '../view/errorPage.php';
        }
        else
        {
            include '../view/movieList.php';
        }
    }
    
    function movieSchedule()
    {
        $results = getCompleteMovieSchedule();
        
        if(count($results) == 0)
        {
            $errorMsg = 'Could not find movie schedule.';
            include '../view/errorPage.php';
        }
        else
        {
            include '../view/movieSchedule.php';
        }
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
            if ($row['EditUserID'] != null)
            {
                $temp = getNewsEditUserID($row['NewsID']);
                $editUserName = $temp[0];
            }
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
        
        //the number of news items listed per page is stored here
        $numberOfItemsPerPage = 10;
        
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
            $results = getNewsList($page, $numberOfItemsPerPage);
            $newsCountTemp = getNewsListCount();
        }
        
        
        if (count($results) == 0)
        {
            //no news items are found, returns nothing
            $errorMsg = "No Items were found.";
            include '../view/errorPage.php';
        }
        //for searches containing a single item
        else if (count($results) == 1 && !isset($_GET['Page']))
        {
            $row = $results[0];
            include '../view/newsDisp.php';
        }
        else
        {
            //$emailCountTemp is part of an array, only index
            $newsCount = ceil($newsCountTemp[0] / $numberOfItemsPerPage);
            include '../view/news.php';
        }
    }
    
    function processAddMovie()
    {
        $id = $_POST['id'];
        $obj = getMovie($id);
        
        $title = $obj['original_title'];
        $description = $obj['overview'];
        
        $poster_path = 'http://image.tmdb.org/t/p/w500' . $obj['poster_path'];
        $poster_destination = '/img/movie/poster' . $obj['poster_path'];
        
        //returns false if function fails
        $falseOnFailure = copy($poster_path, __DIR__ . '/../' . $poster_destination);
        if ($falseOnFailure == false)
        {
            $poster_destination = null;
        }
        
        $tagline = $obj['tagline'];
        $date = $obj['release_date'];
        
        $backdrop_path = 'http://image.tmdb.org/t/p/w1920' . $obj['backdrop_path'];
        $backdrop_destination = '/img/movie/backdrop' . $obj['backdrop_path'];
        
        //no poster_destination
        $falseOnFailure = copy($backdrop_path, __DIR__ . '/../' . $backdrop_destination);
        if ($falseOnFailure == false)
        {
            $backdrop_destination = null;
        }
        
        $movieID = addMovie($id, $title, $description, $poster_destination, $tagline, $date, $backdrop_destination);
        if (is_numeric($movieID))
        {
            header("Location:../movies/$movieID");
        }
        else
        {
            $errorMsg = $movieID;
            include '../view/errorPage.php';
        }
    }
    
    function processAddMovieListing()
    {
        $movieID = $_POST['MovieID'];
        $date = $_POST['Date'];
        $time = $_POST['Time'];
        
        //combine the two because its a datetime type in table
        $dateTime = $date . ' ' . $time;
        
        //to return to page, will say a success message if everything goes through,
        //will return an error if something happens
        $results = '';
        
        //although required, someone could edit html, so make sure on back-end
        if (empty($movieID) )
        {
            $results = 'A movie must be selected.';
            echo results;
        }
        else if (empty($date))
        {
            $results = 'A date must be selected';
            echo results;
        }
        else if (empty($time))
        {
            $results = 'A time must be selected';
            echo results;
        }
        
        $success = insertMovieDate($movieID, $dateTime);
        
        //TODO:
        //   bug:  Always returns false, no matter what
        //         Try to make it so that it can properly identify when a duplicate key has
        //         been entered.
        if ($success)
        {
            echo 'Showing successfully for ' . date( 'D m/j g:i a', strtotime($dateTime))
                . ".  Make sure that the date hasn't already been added.";
        }
        else
        {
            //echo 'An error occurred.  Check that the date and time entered is unique and try again.';
            echo 'Note:  Always make sure that the date being entered is unique.';
        }
        
    }
    
    function processAddEditApple()
    {
        $appleID = $_POST['AppleID'];
        $mode = $_POST['Mode'];
        $appleTitle = $_POST['Title'];
        
        $errors = '';
        
        if (!empty($appleTitle) && strlen($appleTitle) > 100)
        {
            $errors .= "\\n*If a title is entered, it must be less than 100 characters.";
        }
        
        //an image is required obviously
        if (isset($_FILES['userfile']))
        {
                $image_info =
                getimagesize($_FILES['userfile']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $image_type = $image_info[2];

                $uploadfile = "../img/apple/" . $_FILES['userfile']['name'];

                if ($image_type != IMAGETYPE_JPEG && $image_type !=
                IMAGETYPE_GIF && $image_type != IMAGETYPE_PNG)
                {
                    $errors .= "\\n* Only jpeg, gif, or png file types are allowed.";
                }
        }
        //if you're editing, then an image has already been added
        else if ($mode == "Add")
        {
            $errors .= "\\n*An image is the most important part.";
        }
        
        if ($errors != "")
        {
            include '../view/editApple.php';
        }
        else
        {
            //uploading the file
            if ( !($_FILES['userfile']['size'] == 0 && $_FILES['userfile']['error'] == 0) )
            {
                move_uploaded_file($_FILES['userfile']['tmp_name'],
                                                $uploadfile);
            }
            
            if ($mode == 'Add')
            {
                $appleID = insertAppleItem($uploadfile, $appleTitle);
                header('Location:../apple/');
            }
            else
            {
                $rowsAffected = updateAppleItem($appleID, $appleTitle);
                header('Location:../apple/');
            }
        }
    }
    
    function processAddEditNews()
    {
        $newsID = $_POST['NewsID'];
        $mode = $_POST['Mode'];
        $headline = $_POST['Headline'];
        $content = $_POST['Content'];
        
        $errors = '';
        
        if ( empty($headline) || strlen($headline) > 100)
        {
            $errors .= '<br />* Provide a headline that is less than 100 characters';
        }
        if (empty($content) || strlen($content) > 3000)
        {
            $errors .= '<br />* Provide content that is less than 3,000 characters';
        }
        
        if ($mode == 'Add')
        {
            $slug = slugify($headline);
            if (SlugExists($slug))
            {
                $errors .= '<br />* Headline already exists.  Provide a unique headline';
            }
        }
        
        $userID = $_SESSION['UserID'];
        
        if ($errors != '')
        {
            include '../view/editNews.php';
        }
        else
        {
            if ($mode == 'Add')
            {
                insertNewsItem($headline, $content, $slug, $userID);
                header("Location:../news/$slug");
            }
            else
            {
                //slug should never change or else it would break links
                updateNewsItem($newsID, $headline, $content, $userID);
                header("Location:../news/$slug");
            }
        }
    }
    
    function processAppleGalleryFileUpload()
    {
        $image_info =
        getimagesize($_FILES['userfile']['tmp_name']);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $image_type = $image_info[2];

        $uploadfile = "../img/apple/" . $_FILES['userfile']['name'];

        if (file_exists($uploadfile))
        {
            $uploadfile = "../img/apple" . $_FILES['userfile']['name'] 
                    . date("Ymd-His");
            $msg = 'The file was successfully uploaded.';
        }
        else 
        {
            $msg = 'The file was successfully uploaded.';
        }

        if ($image_type != IMAGETYPE_JPEG && $image_type !=
        IMAGETYPE_GIF && $image_type != IMAGETYPE_PNG)
        {
            $errorMsg = "<p>Only jpeg, gif, or png file types are allowed.</p>";
            include '../view/errorPage.php';
        }
        else if ($_FILES['userfile']['size'] > 2000000)
        {
            $errorMsg = "<p>File too big. Choose file under 2MB.</p>";
            include '../view/errorPage.php';
        }
        //AFTER IMAGE HAS BEEN CHECKED FOR TYPE AND SIZE
        //resizing it, so move won't work
        else if (move_uploaded_file($_FILES['userfile']['tmp_name'],
                                            $uploadfile))
        {
            include '../view/appleGalleryFileUpload.php';
        }
        else if ($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE)
        {
            $errorMsg = "<p>No file found. Try again.</p>";
            include '../view/errorPage.php';
        }
        else
        {
            $errorMsg = "File Upload Error";
            include '../view/errorPage.php';
        }
    }
    
    function processSlideshowFileDelete()
    {
        $file = $_POST['img'];
        
        //if file is properly deleted, return to page
        if (unlink($file))
        {
            $msg = 'File was deleted properly.';
            include '../view/slideshowFileUpload.php';
        }
        else
        {
            $errorMsg = "An error has occurred.  Please try again.";
            include '../view/errorPage.php';
        }
    }
    
    function processSlideshowFileUpload()
    {
        $image_info =
        getimagesize($_FILES['userfile']['tmp_name']);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $image_type = $image_info[2];

        $uploadfile = "../img/slideshow/" . $_FILES['userfile']['name'];

        if (file_exists($uploadfile))
        {
            $msg = 'The file was replaced successfully.';
        }
        else 
        {
            $msg = 'The file was successfully uploaded.';
        }

        if ($image_type != IMAGETYPE_JPEG && $image_type !=
        IMAGETYPE_GIF && $image_type != IMAGETYPE_PNG)
        {
            $errorMsg = "<p>Only jpeg, gif, or png file types are allowed.</p>";
            include '../view/errorPage.php';
        }
        /*
        else if ($_FILES['userfile']['size'] > 2000000)
        {
            $errorMsg = "<p>File too big. Choose file under 2MB.</p>";
            include '../view/errorPage.php';
        }
         */
        //AFTER IMAGE HAS BEEN CHECKED FOR TYPE AND SIZE
        //resizing it, so move won't work
        else if (move_uploaded_file($_FILES['userfile']['tmp_name'],
                                            $uploadfile))
        {
            include '../view/slideshowFileUpload.php';
        }
        else if ($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE)
        {
            $errorMsg = "<p>No file found. Try again.</p>";
            include '../view/errorPage.php';
        }
        else
        {
            $errorMsg = "File Upload Error";
            include '../view/errorPage.php';
        }
    }
    
    
?>