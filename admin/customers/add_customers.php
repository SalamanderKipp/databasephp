<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('customers-menu.php');
?>

<h1>customer toevoegen</h1>

<?php
if (isset($_POST['submit']) && $_POST['submit'] != "") {
    $gender = $con->real_escape_string($_POST['gender']);
    $first_name = $con->real_escape_string($_POST['first_name']);
    $middle_name = $con->real_escape_string($_POST['middle_name']);
    $last_name = $con->real_escape_string($_POST['last_name']);
    $street = $con->real_escape_string($_POST['street']);
    $house_number = $con->real_escape_string($_POST['house_number']);
    $house_number_addon = $con->real_escape_string($_POST['house_number_addon']);
    $zip_code = $con->real_escape_string($_POST['zip_code']);
    $city = $con->real_escape_string($_POST['city']);
    $phone = $con->real_escape_string($_POST['phone']);
    $emailadres = $con->real_escape_string($_POST['emailadres']);
    $newsletter_subscription = $con->real_escape_string($_POST['newsletter_subscription']);

    $liqry = $con->prepare("INSERT INTO customer (gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, `e-mailadres`, newsletter_subscription) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {

        $liqry->bind_param('sssssisssisi', $gender, $first_name, $middle_name, $last_name, $street, $house_number, $house_number_addon, $zip_code, $city, $phone, $emailadres, $newsletter_subscription);
        if ($liqry->execute()) {
            echo "Customer met de voornaam " . $first_name . " is toegevoegd.";
        }
    }
    $liqry->close();
}
?>

<form action="" method="POST">
gender: <input type="text" name="gender" value=""><br><br>
first_name: <input type="text" name="first_name" value=""><br><br>
middle_name: <input type="text" name="middle_name" value=""><br><br>
last_name: <input type="text" name="last_name" value=""><br><br>
street: <input type="text" name="street" value=""><br><br>
house_number: <input type="text" name="house_number" value=""><br><br>
house_number_addon: <input type="text" name="house_number_addon" value=""><br><br>
zip_code: <input type="text" name="zip_code" value=""><br><br>
city: <input type="text" name="city" value=""><br><br>
phone: <input type="text" name="phone" value=""><br><br>
emailadres: <input type="text" name="emailadres" value=""><br><br>
newsletter_subscription: <input type="text" name="newsletter_subscription" value=""><br><br>
    <input type="submit" name="submit" value="Toevoegen">
</form>



<?php
include('../core/footer.php');
?>