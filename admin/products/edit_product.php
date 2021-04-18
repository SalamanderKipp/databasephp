<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('products-menu.php');
?>

<h1>Product bewerken</h1>

<?php
//prettyDump($_POST);
if (isset($_POST['submit']) && $_POST['submit'] != '') {
    //default user: test@test.nl
    //default password: test123
    $id = $con->real_escape_string($_POST['product_id']);
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
    $category_id = $con->real_escape_string($_POST['category_id']);
    $price = $con->real_escape_string($_POST['price']);
    $color = $con->real_escape_string($_POST['color']);
    $weight = $con->real_escape_string($_POST['weight']);
    $active = $con->real_escape_string($_POST['active']);
    $query1 = $con->prepare("UPDATE product SET name = ?, description = ?, price = ?, category_id = ?, color = ?, weight = ?, active = ? WHERE product_id = ? LIMIT 1;");
    if ($query1 === false) {
        echo mysqli_error($con);
    }

    $query1->bind_param('ssiisiii', $name, $description, $category_id, $price, $color, $weight, $active, $id);
    if ($query1->execute() === false) {
        echo mysqli_error($con);
    } else {
        echo '<div style="border: 2px solid Green">Product aangepast</div>';
    }
    $query1->close();
}
?>



<form action="" method="POST">
    <?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT `product_id`, `p`.`name`, `p`.`description`, `price`, `color`, `weight`, `p`.`active`, c.`name` FROM `product` as `p`,`category` as `c` WHERE `c`.`category_id`=`p`.`category_id`");
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_param('i', $uid);
            $liqry->bind_result($product_id, $name, $description, $price, $color, $weight, $active, $category );
            if ($liqry->execute()) {
                $liqry->store_result();
                $liqry->fetch();
                if ($liqry->num_rows == '1') {
                    echo '$product_id: <input type="text" name="uid" value="' . $product_id . '" readonly><br>';
                    echo '$name: <input type="text" name="text" value="' . $name . '"><br>';

                    // $columns = array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active');
                    // foreach ($columns as $key) {
                    //     $dit_veld_moet_alleen_lezen_zijn = "";
                    //     if ($key == 'product_id') {
                    //         $dit_veld_moet_alleen_lezen_zijn = "readonly";
                    //     }
                    //     echo '<b>' . $key . '</b> :<input type="text" name="' . $key . '" value="' . $$key . '" ' . $dit_veld_moet_alleen_lezen_zijn . '><br>';
                    // }
                }
            }
        }
        $liqry->close();
    }
    ?>
    <br>
    <input type="submit" name="submit" value="Opslaan">
</form>

<?php
include('../core/footer.php');
?>