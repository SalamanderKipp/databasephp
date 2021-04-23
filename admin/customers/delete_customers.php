<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customers-menu.php');
?>

<h1>Customer verwijderen</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $uid = $con->real_escape_string($_POST['uid']);
        $query1 = $con->prepare("DELETE FROM customer WHERE customer_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i',$uid);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Gebruiker met customer_id '.$uid.' verwijderd!</div>';
        }
        $query1->close();
                    
    }
?>


<?php
    if (isset($_GET['uid']) && $_GET['uid'] != '') {

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">weet je zeker dat je deze gebruiker wilt verwijderen?</h2><?php

        $uid = $con->real_escape_string($_GET['uid']);

        $liqry = $con->prepare("SELECT customer_id, gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, `e-mailadres`, newsletter_subscription FROM customer WHERE customer_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$uid);
            $liqry->bind_result($customer_id, $gender, $first_name, $middle_name, $last_name, $street, $house_number, $house_number_addon, $zip_code, $city, $phone, $emailadres, $newsletter_subscription);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo 'customer_id: ' . $customer_id . '<br>';
                    echo '<input type="hidden" name="uid" value="' . $customer_id . '" />';
                    echo 'gender: ' . $gender . '<br>';
                    echo 'first_name: ' . $first_name . '<br>';
                    echo 'middle_name: ' . $middle_name . '<br>';
                    echo 'last_name: ' . $last_name . '<br>';
                    echo 'street: ' . $street . '<br>';
                    echo 'house_number: ' . $house_number . '<br>';
                    echo 'house_number_addon: ' . $house_number_addon . '<br>';
                    echo 'zip_code: ' . $zip_code . '<br>';
                    echo 'city: ' . $city . '<br>';
                    echo 'phone: ' . $phone . '<br>';
                    echo 'emailadres: ' . $emailadres . '<br>';
                    echo 'newsletter_subscription: ' . $newsletter_subscription . '<br>';
                }
            }
        }
        $liqry->close();

        ?>
        <br>
        <input type="submit" name="submit" value="Ja, verwijderen!">
        </form>
        <?php

    }
?>

<?php
    include('../core/footer.php');
?>