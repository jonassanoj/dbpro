


<?php foreach ($questions as $q): ?>
    <p>
    <?php echo $q['body']?> 
    <i>
    [
   	<?php echo anchor("index.php/maincontroller/viewAnswer/{$q['questionID']}",'Show answers')?>
    ]
    </i>
    </p>
<?php endforeach ?>

<?php 
	
	echo "<center>" .$this->pagination->create_links() ."</center>";
	
?>

