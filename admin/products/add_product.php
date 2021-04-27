<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('products-menu.php');
?>

<h1>Product toevoegen</h1>

<?php
if (isset($_POST['submit']) && $_POST['submit'] != "") {
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
    $category_id = $con->real_escape_string($_POST['category_id']);
    $price = $con->real_escape_string($_POST['price']);
    $color = $con->real_escape_string($_POST['color']);
    $weight = $con->real_escape_string($_POST['weight']);

    if (isset($_POST['active'])) {
        $active = $con->real_escape_string($_POST['active']);
    } else {
        $active = 0; 
    }

    $liqry = $con->prepare("INSERT INTO product (name, description, category_id, price, color, weight, active) VALUE (?, ?, ?, ?, ?, ?, ?)");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_param('ssiisii', $name, $description, $category_id, $price, $color, $weight, $active);
        if ($liqry->execute()) {
            echo "Het product " . $name . " is toegevoegd.";
        }
    }
    $liqry->close();
}
?>

<form action="" method="POST">
    <?php

    $liqry = $con->prepare("SELECT c.`name`, c.`category_id`, `p`.`active` FROM `product` as `p`, `category` as `c` WHERE `c`.`category_id`=`p`.`category_id` LIMIT 1;");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_result($category, $product_category_id, $active);

        if ($liqry->execute()) {
            $liqry->store_result();
            $liqry->fetch();

            if ($liqry->num_rows == '1') {
                $columns = array('name', 'description', 'price', 'color', 'weight');
                foreach ($columns as $key) {
                    echo '<b>' . $key . '</b>: <input type="text" name="' . $key . '"><br>';
                }
                $categoryqry = $con->prepare("SELECT `category_id`, `name` FROM `category`;");
                $categoryqry->bind_result($category_id, $name);

                if ($categoryqry->execute()) {
                    $categoryqry->store_result();

                    echo '<b>catgory</b> :<select name="category_id" value="' . $product_category_id . '" required>';
                    while ($categoryqry->fetch()) {
                        // $selected = "";
                        // if ($category_id == $product_category_id) {
                        //     $selected = "selected";
                        // }

    ?>
                        <option value="<?php echo $category_id; ?>"><?php echo $name; ?></option>
    <?php
                    }
                    echo '</select> <br>';
                    echo 'Active <input type="checkbox" name="active" value="1">';
                }
            }
        }
    }
    $liqry->close();
    ?>
    <br>
    <input type="submit" name="submit" value="Toevoegen">
</form>

<?php
include('../core/footer.php');
?>