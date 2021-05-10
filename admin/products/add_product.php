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
        $active = $con->real_escape_string($_POST['active']);

        $liqry = $con->prepare("INSERT INTO product (name, description, category_id, price, color, weight, active) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('sssssss',$name,$description,$category_id,$price,$color,$weight,$active);
            if($liqry->execute()){
                echo '<div style="border: 2px solid red">Product toegevoegd</div>';
            }
        }
        $liqry->close();

    }
?>

<form action="" method="POST">
name: <input type="text" name="name" value=""><br>
description: <input type="text" name="description" value=""><br>
category_id: <input type="number" name="category_id" value=""><br>
price: <input type="text" name="price" value=""><br>
color: <input type="text" name="color" value=""><br>
weight: <input type="text" name="weight" value=""><br>
active: <input type="text" name="active" value=""><br><br>
<input type="submit" name="submit" value="Toevoegen">
</form>



<?php
    include('../core/footer.php');
?>
