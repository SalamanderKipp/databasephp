<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('products-menu.php');
?>

<h1>Product bewerken</h1>

<?php
if (isset($_POST['submit']) && $_POST['submit'] != '') {
    $id = $con->real_escape_string($_GET['uid']);
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

    $query1 = $con->prepare("UPDATE product SET name = ?, description = ?, category_id = ?, price = ?, color = ?, weight = ?, active = ? WHERE product_id = ? LIMIT 1;");
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

    if (isset($_GET['uid']) && $_GET['uid'] != '') {
        $id = $con->real_escape_string($_GET['uid']);

        $liqry = $con->prepare("SELECT `product_id`, `p`.`name`, `p`.`description`, c.`name`, c.`category_id`, `price`, `color`, `weight`, `p`.`active` FROM `product` as `p`,`category` as `c` WHERE `c`.`category_id`=`p`.`category_id` and p.`product_id` = ? LIMIT 1;");
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_param('i', $id);
            $liqry->bind_result($id, $name, $description, $category, $product_category_id, $price, $color, $weight, $active);

            if ($liqry->execute()) {
                $liqry->store_result();
                $liqry->fetch();

                if ($liqry->num_rows == '1') {
                    $columns = array('id', 'name', 'description', 'price', 'color', 'weight', 'active');
                    foreach ($columns as $key) {
                        $dit_veld_moet_alleen_lezen_zijn = "";
                        if ($key == 'id') {
                            $dit_veld_moet_alleen_lezen_zijn = "disabled";
                        }
                        echo '<b>' . $key . '</b> :<input type="text" name="' . $key . '" value="' . $$key . '" ' . $dit_veld_moet_alleen_lezen_zijn . '><br>';
                    }
                    $categoryqry = $con->prepare("SELECT `category_id`, `name` FROM `category`;");
                    $categoryqry->bind_result($category_id, $name);

                    if ($categoryqry->execute()) {
                        $categoryqry->store_result();

                        echo '<b>catgory</b> :<select name="category_id" value="' . $product_category_id . '">';
                        while ($categoryqry->fetch()) {
                            $selected = "";
                            if ($category_id == $product_category_id) {
                                $selected = "selected";
                            }

    ?>
                            <option value="<?php echo $category_id; ?>" <?php echo $selected ?>><?php echo $name; ?></option>
    <?php
                        }
                        echo '</select>';
                    }
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