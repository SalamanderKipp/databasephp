<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('category-menu.php');
?>

<h1>Category bewerken</h1>

<?php
//prettyDump($_POST);
if (isset($_POST['submit']) && $_POST['submit'] != '') {
    //default user: test@test.nl
    //default password: test123
    // echo $_POST['id'];
    $id = $con->real_escape_string($_GET['uid']);
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
   
    if (isset($_POST['active'])) {
        $active = $con->real_escape_string($_POST['active']);
    } else {
        $active = 0; 
    }
    
    $query1 = $con->prepare("UPDATE category SET name = ?, description = ?, active = ? WHERE category_id = ? LIMIT 1;");
    if ($query1 === false) {
        echo mysqli_error($con);
    }

    $query1->bind_param('ssii', $name, $description, $active, $id);
    if ($query1->execute() === false) {
        echo mysqli_error($con);
    } else {
        echo '<div style="border: 2px solid Green">Category aangepast</div>';
    }
    $query1->close();
}
?>


<form action="" method="POST">
    <?php
    
    if (isset($_GET['uid']) && $_GET['uid'] != '') {
        $id = $con->real_escape_string($_GET['uid']);
        
        $liqry = $con->prepare("SELECT `category_id`, `name`, `description`, `active` FROM `category` WHERE `category_id` = ? LIMIT 1;");
        if ($liqry === false) {
            echo mysqli_error($con);
           
        } else {
            $liqry->bind_param('i', $id);
            $liqry->bind_result($id, $name, $description, $active);
            
            if ($liqry->execute()) {
                $liqry->store_result();
                $liqry->fetch();
                
                if ($liqry->num_rows == '1') {
                    $columns = array('id', 'name', 'description');
                    foreach ($columns as $key) {
                        $dit_veld_moet_alleen_lezen_zijn = "";
                        if ($key == 'id') {
                            $dit_veld_moet_alleen_lezen_zijn = "disabled";
                        }
                        echo '<b>' . $key . '</b> :<input type="text" name="' . $key . '" value="' . $$key . '" ' . $dit_veld_moet_alleen_lezen_zijn . '><br>';
                    }             

                    $checked = "";
                    if ($active == '1') {
                        $checked = "checked";
                    }
                    echo 'Active <input type="checkbox" name="active" value="1" ' . $checked . '>';       
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