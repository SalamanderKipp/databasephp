<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='assets/css/style.css' rel='stylesheet'>
</head>

<body>
    <?php
    include 'core/header.php';
    ?>
    <!-- navbar -->

    <?php
    $id = $_GET['id'];
    $liqry = $con->prepare("SELECT `p`.`name`, `p`.`description`, c.`name`, `price`, `color`, `weight` FROM `product` as `p`, `category` as `c` WHERE p.category_id = c.category_id and product_id = $id");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_result($name, $description, $category, $price, $color, $weight);
        if ($liqry->execute()) {
            $liqry->store_result();
            while ($liqry->fetch()) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="project-info-box">
                                <p><b>Product naam:</b> <?php echo $name ?></p>
                                <p><b>Category:</b> <?php echo $category ?></p>
                                <p><b>Color:</b> <?php echo $color ?></p>
                                <p><b>Weight</b> <a><?php echo $weight ?>kg</a></p>

                            </div>
                            <div class="project-info-box mt-0">
                                <p><b>Description:</b></p>
                                <p class="mb-0"><?php echo $description ?></p>
                            </div>

                            <div class='form-group'>
                                <input type='submit' value='Koop nu' class='btn btn-warning mb-2 mr-4 float-left mt-2 bestelbutton '></input>
                            </div>

                        </div>
                        <div class="col-md-7">
                            <img src="assets/img/product.png" style="width:300px" alt="project-image" class="rounded">
                            <div class="form-group mt-2">
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


    <script>
        function gotoBestelFormulier() {
            window.location.href = "bestelformulier.php?id=".$Detailid;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script>
        $('#exampleModalCenter').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</body>

</html>