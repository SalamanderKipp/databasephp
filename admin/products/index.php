<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('products-menu.php');
?>

<h1>Productenoverzicht</h1>

<?php
$liqry = $con->prepare("SELECT `product_id`, `p`.`name`, `p`.`description`, c.`name`, `price`, `color`, `weight`, `p`.`active` FROM `product` as `p`, `category` as `c` WHERE p.category_id = c.category_id");
if ($liqry === false) {
    echo mysqli_error($con);
} else {
    $liqry->bind_result($product_id, $name, $description, $category, $price, $color, $weight, $active);
    if ($liqry->execute()) {
        $liqry->store_result();
        echo '<table border=1>
                        <tr>
                            <td>Product id</td>
                            <td>Product naam</td>
                            <td>Product description</td>
                            <td>Category</td>
                            <td>Price</td>
                            <td>Color</td>
                            <td>Weight</td>
                            <td>Active</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
        while ($liqry->fetch()) { ?>
            <tr>
                <td><?php echo $product_id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $color; ?></td>
                <td><?php echo $weight; ?></td>
                <?php $check = "checked";
                if ($active == 0) {
                    $check = "";
                }
                ?>
                <td><input disabled="disabled" type="checkbox" <?php echo $check ?>><?php echo $active; ?></td>
                <td><a href="edit_product.php?uid=<?php echo $product_id; ?>">edit</a></td>
                <td><a href="delete_product.php?uid=<?php echo $product_id; ?>">delete</a></td>
            </tr>
<?php
        }

        echo '</table>';
    }

    $liqry->close();
}
include('../core/footer.php');
?>