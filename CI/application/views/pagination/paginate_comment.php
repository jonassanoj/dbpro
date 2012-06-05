<?php 
foreach ($comments as $c){
    echo $c['commentBody']."<br>";
}
?> 
<?php 
    echo "<center>" .$this->pagination->create_links() ."</center>";
?>

