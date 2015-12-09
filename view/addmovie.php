<?php
    $title = 'Add Movie';
    include '../view/headerInclude.php';
?>

<section>
    <h1>
        Add Movie
    </h1>
    
    <div style='text-align:center;'>
        <div class="searchForm" style="margin-top:19px;margin-right:20px;">
                <input type="text" class="search rounded" style='text-align:center;' placeholder="Search Movie..." id="criteria" 
                       onkeydown="if (event.keyCode == 13) searchMovie();" />
        </div>
    </div>
    <form id='movieForm' method='post' action='../controller/index.php?action=processAddMovie'>
        <h3 style='text-align:center;'>Results</h3>
        
        <br />
        
        <div>
            <div id="movieSelect"></div>
            <select name='id' id='movieResults' size='5'>
            </select>
        </div>
        
        <br />
        
        <div style='text-align:center'>
            <input type='submit' name='SubmitButton' value='Add Movie' />
        </div>
        
    </form>
    
</section>

<script>
    function searchMovie()
    {
        $('#movieSelect').html("<img width='100' class='loadingImage' src='../img/spinner.gif' alt='loading' />");
        
        //getting search criteria from search input
        var criteria = encodeURIComponent($('#criteria').val());
        
        $.ajax({
            type: 'POST',
            url: '../lib/tmdbAPIfuncs.php',
            data: 'func=SearchMovie&query=' + criteria,
            cache: false, 
            success: function(result) {
              if(result){
                resultObj = eval(result);
                
                //clear the select box of irrelevant stuff
                $('#movieSelect').empty();
                $('#movieResults').empty();                
                
                for (var i = 0; i < resultObj.length; i++)
                {
                    $("#movieResults").append("<option class='movieItem' value='" + JSON.stringify(resultObj[i].id) +"'>" + 
                            JSON.stringify(resultObj[i].original_title).substring(1, JSON.stringify(resultObj[i].original_title).length - 1) +
                            " | " + JSON.stringify(resultObj[i].release_date).substring(1, JSON.stringify(resultObj[i].release_date).length - 1) +"</option>");
                }
                
                
              }else{
                alert("error");
              }
            }
        });
    }
</script>

<?php include '../view/footerInclude.php'; ?>

