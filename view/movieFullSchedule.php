<?php
    $title = 'Full Schedule';
    include '../view/headerInclude.php';
?>
    <link rel='stylesheet' href='../fullcalendar/fullcalendar.css' />
    <!-- <script src='../fullcalendar/lib/jquery.min.js'></script> -->
    <script src='../fullcalendar/lib/moment.min.js'></script>
    <script src='../fullcalendar/fullcalendar.js'></script>
    <script src='../js/jquery.ui.touch.js'></script>

    <section>
        <div id='calendar'></div>
    </section>
    
    <script>
        $('#calendar').fullCalendar({
            events: [
                <?php foreach ($results as $row) { ?>
                        {
                            title: '<?php echo $row['Title'] ?>',
                            start: '<?php echo $row['Date'] ?>',
                            id: '<?php echo $row['MovieID'] ?>'
                        },
                <?php } ?>
            ],
            eventClick: function(calEvent, jsEvent, view) {
                document.location = '../movies/' + calEvent.id;

            },
            eventRender: function(event, element) {
                $(element).addTouch();
            }
        });
    </script>
<?php include '../view/footerInclude.php' ?>