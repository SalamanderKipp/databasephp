<?php

// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');
include('category-menu.php');
?>

<h1>Productenoverzicht</h1>

<?php
$liqry = $con->prepare("SELECT `category_id`, `name`, `description`, `active` FROM `category`");
if ($liqry === false) {
    echo mysqli_error($con);
} else {
    $liqry->bind_result($category_id, $name, $description, $active);
    if ($liqry->execute()) {
        $liqry->store_result();
        echo '<table border=1>
                        <tr>
                            <td>Category id</td>
                            <td>Category naam</td>
                            <td>Category description</td>
                            <td>Active</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
        while ($liqry->fetch()) { ?>
            <tr>
                <td><?php echo $category_id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $description; ?></td>
                <?php $check = "checked";
                if($active == 0) {
                    $check = "";
                }
                ?>
                <td><input disabled="disabled" type="checkbox" <?php echo $check?> ><?php echo $active; ?></td>
                <td><a href="edit_category.php?uid=<?php echo $category_id; ?>">edit</a></td>
                <td><a href="delete_category.php?uid=<?php echo $category_id; ?>">delete</a></td>
            </tr>
            <?php
        }
        
        echo '</table>';
    }

    $liqry->close();
}
include('../core/footer.php');
?>