<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('products-menu.php');
?>

<h1>Product toevoegen</h1>

<?php
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $con->real_escape_string($_POST['email']);

    $liqry = $con->prepare("INSERT INTO product (name, description, category, price, color, weight, active) VALUES (?)");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_param('sssisii', $name, $description, $category, $price, $color, $weight, $active);
        if ($liqry->execute()) {
            echo "Het product " . $name . " is toegevoegd.";
        }
    }
    $liqry->close();
}
?>

<form action="" method="POST">
    <?php
    
        $columns = array('name', 'description', 'category', 'price', 'color', 'weight', 'active');
        foreach ($columns as $key) {
            echo '<b>' . $key . '</b> :<input type="text" name="' . $key . '" value="' . $$key . '" ''><br>';
        }
    
    ?>
    <input type="submit" name="submit" value="Toevoegen">
</form>



<?php
include('../core/footer.php');
?>