<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('products-menu.php');
?>

<h1>Gebruiker verwijderen</h1>

<?php
//prettyDump($_POST);
if (isset($_POST['submit']) && $_POST['submit'] != '') {
    //default user: test@test.nl
    //default password: test123
    $uid = $con->real_escape_string($_POST['uid']);
    $query1 = $con->prepare("DELETE FROM product WHERE product_id = ? LIMIT 1;");
    if ($query1 === false) {
        echo mysqli_error($con);
    }

    $query1->bind_param('i', $uid);
    if ($query1->execute() === false) {
        echo mysqli_error($con);
    } else {
        echo '<div style="border: 2px solid red">Gebruiker met product_id ' . $uid . ' verwijderd!</div>';
    }
    $query1->close();
}
?>


<?php
if (isset($_GET['uid']) && $_GET['uid'] != '') {

?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <h2 style="color: red">weet je zeker dat je dit product wilt verwijderen?</h2>
        <?php

        $uid = $con->real_escape_string($_GET['uid']);

        $liqry = $con->prepare("SELECT `product_id`, `p`.`name`, `p`.`description`, c.`name`, c.`category_id`, `price`, `color`, `weight`, `p`.`active` FROM `product` as `p`,`category` as `c` WHERE `c`.`category_id`=`p`.`category_id` and p.`product_id` = ? LIMIT 1;");
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_param('i', $uid);
            $liqry->bind_result($id, $name, $description, $category, $product_category_id, $price, $color, $weight, $active);
            if ($liqry->execute()) {
                $liqry->store_result();
                $liqry->fetch();
                if ($liqry->num_rows == '1') {
                    echo 'product_id: ' . $id . '<br>';
                    echo '<input type="hidden" name="uid" value="' . $id . '" />';
                    echo 'name: ' . $name . '<br>';
                    echo 'description: ' . $description . '<br>';
                    echo 'category name: ' . $product_category_id . '<br>';
                    echo 'category_id: ' . $category . '<br>';
                    echo 'price: ' . $price . '<br>';
                    echo 'color: ' . $color . '<br>';
                    echo 'weight: ' . $weight . '<br>';
                    echo 'active: ' . $active . '<br>';
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