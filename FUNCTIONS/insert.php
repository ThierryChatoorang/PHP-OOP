<?php

var_dump($_POST);

echo "<h1>Insert Bier</h1>";

require_once('functions.php');

//test of er op de insert knop iets gedrukt is
if (isset($_POST) && isset($_POST['btn_ins'])){
 InsertBier($_POST);
    echo '<script>alert("Biernaam: ' . $_POST['naam'] . ' is toegevoegd")</script>';
    //echo "<script> location.replace ('crud_bieren.php'); </script>";
}

?>

<html>
    <body>
        <form method="post">
            <br>
            Naam:<input type="" name="naam"><br>
            Soort:<input type="text" name="soort"><br>
            Stijl:<input type="text" name="stijl"><br>
            Alcohol:<input type="text" name="alcohol"><br>
            brouwcode:<input type="text" name="brouwcode"><br>

            <?php
          //  dropDownBrouwer('brouwcode', -1);
            ?>
            <br>
            <input type="submit" name="btn_ins" value="Insert"><br> 
            </form>
            <a href="http://localhost/FUNCTIONS/crudbieren.php">Home</a>
</body>
</html>
