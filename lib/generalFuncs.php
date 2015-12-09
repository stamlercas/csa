<?php
    function dispDate($date)
    {     
        if ($phpDate = strtotime($date)) 
        {
            return date('m/d/Y', strtotime($date));
        } else 
        {
            return "";
        }
    }
    
    function dispTime($time)
    {     
        if ($phpDate = strtotime($time)) 
        {
            return date('g:i a', strtotime($time));
        } else 
        {
            return "";
        }
    }
    
    function slugify($text)
    { 
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
    
    function TinyMCESubStr($string) 
    {
        //tinymce sub-string in grid view list
        $str = strip_tags(html_entity_decode($string));
        $lim = 100;
        if (mb_strlen($str,'UTF-8')>$lim)
        {
           $str = mb_substr($str, 0, $lim-3, 'UTF-8').'..';
        }
        return $str;
}
    
    function toMySQLDate($date) 
    {
        if ($phpDate = strtotime($date)) 
        {
            return date('Y/m/d', $phpDate);
        } 
        else 
        {
            return "";
        }
    }
    
    function toMySQLTime($time) 
    {
        if ($phpDate = strtotime($time)) 
        {
            return date('H:i:s', $phpDate);
        } 
        else 
        {
            return "";
        }
    }
    
    function unQuote()
    {
        if (get_magic_quotes_gpc()) 
        {
            function stripslashes_gpc(&$value) {
            $value = stripslashes($value);
        }
            array_walk_recursive($_GET, 'stripslashes_gpc');
            array_walk_recursive($_POST, 'stripslashes_gpc');
            array_walk_recursive($_COOKIE, 'stripslashes_gpc');
            array_walk_recursive($_REQUEST, 'stripslashes_gpc');
        }
    }
?>