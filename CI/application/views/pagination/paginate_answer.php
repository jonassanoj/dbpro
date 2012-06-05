<?php foreach ($answers as $a): ?>
    <p>
    <?php echo $a['body']?> 
    <i>
    [
    <?php 
        echo anchor("index.php/maincontroller/viewComment/{$a['answerID']}",'Show comments')
    ?>
    ]
    </i>
    </p>
<?php endforeach ?>

<?php 
    echo "<center>" .$this->pagination->create_links() ."</center>";
?>

