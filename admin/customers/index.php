<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('customers-menu.php');
?>

<h1>Gebruikersoverzicht</h1>

<?php
$liqry = $con->prepare("SELECT customer_id, gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, `e-mailadres`, newsletter_subscription FROM customer");
if ($liqry === false) {
    echo mysqli_error($con);
} else {
    $liqry->bind_result($customer_id, $gender, $first_name, $middle_name, $last_name, $street, $house_number, $house_number_addon, $zip_code, $city, $phone, $emailadres, $newsletter_subscription);
    if ($liqry->execute()) {
        $liqry->store_result();


        echo '<table border=1>
                        <tr>
                            <td>customer_id</td>
                            <td>gender</td>
                            <td>first_name</td>
                            <td>middle_name</td>
                            <td>last_name</td>
                            <td>street</td>
                            <td>house_number</td>
                            <td>house_number_addon</td>
                            <td>zip_code</td>
                            <td>city</td>
                            <td>phone</td>
                            <td>emailadres</td>
                            <td>newsletter_subscription</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
        while ($liqry->fetch()) { ?>
            <tr>
                <td><?php echo $customer_id; ?></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $first_name; ?></td>
                <td><?php echo $middle_name; ?></td>
                <td><?php echo $last_name; ?></td>
                <td><?php echo $street; ?></td>
                <td><?php echo $house_number; ?></td>
                <td><?php echo $house_number_addon; ?></td>
                <td><?php echo $zip_code; ?></td>
                <td><?php echo $city; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $emailadres; ?></td>
                <td><?php echo $newsletter_subscription; ?></td>
                <td><a href="edit_customers.php?uid=<?php echo $customer_id; ?>">edit</a></td>
                <td><a href="delete_customers.php?uid=<?php echo $customer_id; ?>">delete</a></td>
            </tr>
<?php
        }
        echo '</table>';
    }

    $liqry->close();
}

?>

<?php
include('../core/footer.php');
?>