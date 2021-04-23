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
<!-- where begindatum >= SYSDATE() order by begindatum asc -->
    <?php
    $webshopdetail = "SELECT * FROM product";
    $result = $con->query($webshopdetail);
    ?>
    
    <div class="container">
        <div class="card-group">
            <div class='row'>
                <?php

                while ($row = mysqli_fetch_array($result)) {
                    // Code checks if the event has an end date or not,
                    // and puts it on the card in the right format
                    // if ($result->num_rows > 0) {
                    //     $dateStart = date_format(date_create($row['begindatum']), "d M H:i");
                    //     $dateEnd = date_format(date_create($row['einddatum']), "d M H:i");
                    //     $datum = "";
                    //     if ($row['einddatum'] == '0000-00-00 00:00:00') {
                    //         $datum = $dateStart;
                    //     } else {
                    //         $datum = $dateStart . " - " . $dateEnd;
                    //     }

                        // The code here checks for how many days there are left until the events begins
                        // and locks the card if there ar 2 days or less till the event
                        // $begin = date_create($row['begindatum']);
                        // $datelocal = new DateTime();
                        // $dateclose = date_diff($begin, $datelocal);
                        // $difftime = $dateclose->format('%d');

                        // Code changes the border color depending on the amount of tickets or time left
                        // $tickets = $row['tickets'];
                        // $totaltickets = $row['totaltickets'];
                        // $carddanger = "cardgroen";
                        // $locationonclick = "' onclick='location.href=\"detail.php?id=" . $row['id'] . "\"'";
                        // $readmore = '';
                        // $buttonColor = "success";
                        // if ($tickets == 0 || $difftime <= 2) {
                        //     $carddanger = "carddanger";
                        //     $locationonclick = "";
                        //     $buttonColor = "danger";
                        //     $readmore = "readmore";
                        // } else if ($tickets <= ($totaltickets * 0.1)) {
                        //     $carddanger = "cardwarning";
                        //     $buttonColor = "warning";
                        // }
                        // Maakt de tickets aan met de verschillende variablen wat in de database opgeslagen is
                        echo
                        "
                        <div class='col-md-6 '>
                            <div class='mr-2'>
                                <div class='card " . $name . " ' " . $name . ">
                                    <img class='card-img-top' src=" . $row['imgevent'] . " alt='Card image cap'>
                                    <div class='card-body'>
                                        <h5 class='text-center'>" . $row['name'] . "</h5>
                                        <p class='card-text'><i class='fas fa-map-marker-alt'></i> " . $row['name'] . ' ' . $row['name'] . "<br><i class='fas fa-user'></i> " . $row['name'] . "<br> <i class='fas fa-calendar-alt'></i> " . $name . "</p>
                                    </div>
                                    <div class='read-more-place'>
                                        <button class='btn btn-outline-warning mb-2 mr-4 float-right'><b>Read More</b></button>
                                    </div>
                                    <div class='card-footer'>
                                        <small class='text-muted float-right'>Tickets available " . $row['name'] . "</small>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    
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
