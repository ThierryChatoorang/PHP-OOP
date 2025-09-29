<!DOCTYPE html>
<html>
<body>
 
<h2>Forms</h2> 
 
<form method="post">
<label for="fname">First name:</label><br>
<input type="text" id="fname" name="fname" value="John"><br>
<label for="lname">Last name:</label><br>
<input type="text" id="lname" name="lname" value="Doe"><br><br>

<label for="WP">WoonPlaats:</label><br>
<input type="text" id="WP" name="Plaats" value="Amsterdam"><br><br>

<input type="submit" value="Submit" name = "send">
</form>
 
<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>
 
<?php
//controleer of de submit knop is ingedrukt 
if ( isset($_POST['send'])) {
# 


echo "Goed Gedaan.<br>";
//var_dump($_POST);


echo  "Achternaam:"  . $_POST['lname'] . "<br>";
echo  "WoonPlaats:"  . $_POST['Plaats'] . "<br>";
} else {
    echo "Geen Submit ingedrukt.<br>";
}
//print de invul velden
?>

</body>
</html>