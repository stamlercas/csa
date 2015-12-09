<?php 
    $title = 'Error';
    include '../view/headerInclude.php';
?>

<section>
    <h1>Error</h1>
    <div>
        <?php echo $errorMsg ?>
    </div>
</section>

<?php include '../view/footerInclude.php'; die; ?>

