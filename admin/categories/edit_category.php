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
    $active = $con->real_escape_string($_POST['active']);
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
                    $columns = array('id', 'name', 'description', 'active');
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

                        echo '<b>catgory</b> :<select name="category_id" value="' . $category_id . '">';
                        while ($categoryqry->fetch()) {
                            $selected = "";
                            if ($category_id == $category_id) {
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