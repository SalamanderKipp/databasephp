<?php
// include 'core/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='assets/css/style.css' rel='stylesheet'>
</head>

<body>
    <?php
    include 'core/header.php';
    ?>
    <div class="container">
        <div class="card-group">
            <div class='row'>
                <?php
                $liqry = $con->prepare("SELECT product_id, `p`.`name`, `p`.`description`, c.`name`, `price`, `color`, `weight` FROM `product` as `p`, `category` as `c` WHERE p.category_id = c.category_id and p.active = 1 ORDER BY RAND()");
                if ($liqry === false) {
                    echo mysqli_error($con);
                } else {
                    $liqry->bind_result($id, $name, $description, $category, $price, $color, $weight);
                    if ($liqry->execute()) {
                        $liqry->store_result();
                        while ($liqry->fetch()) { ?>

                            <?php
                            $locationonclick = "' onclick='location.href=\"detail.php?id=" . $id . "\"'";
                            ?>
                            <div class='col-md-3 '>
                                <div class='mr-2'>
                                    <div class='card' <?php echo $locationonclick  ?>>
                                        <img class='card-img-top' src='assets/img/product.png' alt='Card image cap'>
                                        <div class='card-body'>
                                            <h5 class='text-center'><?php echo $name ?></h5>
                                            <p class='card-text'><i class='fas fa-map-marker-alt'>Category: <?php echo $category?></i></p>
                                            <p class='card-text'><i class='fas fa-map-marker-alt'>Prijs: <?php echo $price?>&euro;</i></p>
                                        </div>
                                        <div class='read-more-place'>
                                            <button class='btn btn-outline-success mb-2 mr-4 float-right'><b>Go to details</b></button>
                                        </div>
                                        <div class='card-footer'>
                                            <small class='text-muted float-right'>dit zijn producten xD</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                <?php
                        }
                    }

                    $liqry->close();
                }

                ?>
            </div>
        </div>
    </div>


    <?php
    include 'core/footer.php';
    ?>

    <script src="https://kit.fontawesome.com/41c29a8a8f.js" crossorigin="anonymous"></script>
</body>

</html>