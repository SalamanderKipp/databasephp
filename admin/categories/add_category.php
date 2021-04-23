<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('category-menu.php');
?>

<h1>Category toevoegen</h1>

<?php
if (isset($_POST['submit']) && $_POST['submit'] != "") {
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
    $active = $con->real_escape_string($_POST['active']);

    $liqry = $con->prepare("INSERT INTO category (name, description, active) VALUE (?, ?, ?)");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_param('ssi', $name, $description, $active);
        if ($liqry->execute()) {
            echo "Het product " . $name . " is toegevoegd.";
        }
    }
    $liqry->close();
}
?>

<form action="" method="POST">
    name: <input type="text" name="name" value=""><br><br>
    description: <input type="text" name="description" value=""><br><br>
    active: <input type="text" name="active" value=""><br><br>
    <input type="submit" name="submit" value="Toevoegen">
</form>



<?php
include('../core/footer.php');
?>