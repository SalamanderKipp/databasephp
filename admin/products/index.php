<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Productenoverzicht</h1>

<?php
        $liqry = $con->prepare("SELECT product_id, name, description, category_id, price, color, weight, active FROM product");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($product_id, $name, $description, $category_id, $price, $color, $weight, $active);
            if($liqry->execute()){
                $liqry->store_result();
                while($liqry->fetch()) {
                    // echo 'product id :' . $product_id . " - ";
                    // echo 'name :' . $name . " - ";
                    // echo 'description :' . $description . " - ";
                    $columns = array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active');
                    foreach ($columns as $key) {
                        echo '<b>' . $key .'</b> :' . $$key . " - ";
                    }

                    echo '<a href="edit_product.php?id='.$product_id.'">edit</a><br>';
                }

                // table>tr*1>td*4
/*
                echo '<table border=1>
                        <tr>
                            <td>admin uid</td>
                            <td>email</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($liqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $product_id; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><a href="edit_user.php?uid=<?php echo $product_id; ?>">edit</a></td>
                        <td><a href="delete_user.php?uid=<?php echo $product_id; ?>">delete</a></td>
                    </tr>
                    <?php 
                }
                echo '</table>';
*/
            }

            $liqry->close();
        }

?>

<?php
    include('../core/footer.php');
?>
