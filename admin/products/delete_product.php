<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');

?>

<h1>Product verwijderen</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $id = $con->real_escape_string($_POST['id']);
        $query1 = $con->prepare("DELETE FROM product WHERE product_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i',$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Product met product_id '.$id.' verwijderd!</div>';
        }
        $query1->close();
                    
    }
?>


<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">weet je zeker dat je dit product wilt verwijderen?</h2><?php

        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT product_id, product.name, product.description, category.name, price, color, weight, product.active FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product_id = ? LIMIT 1;");

        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$id);
            $liqry->bind_result($product_id, $name, $description, $category_id, $price, $color, $weight, $active );
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$product_id: ' . $product_id . '<br>';
                    echo '<input type="hidden" name="id" value="' . $id . '" />';
                    echo '$name: ' . $name . '<br>';
                    echo '$description: ' . $description . '<br>';
                    echo '$category_id: ' . $category_id . '<br>';
                    echo '$price: ' . $price . '<br>';
                    echo '$color: ' . $color . '<br>';
                    echo '$weight: ' . $weight . '<br>';
                    echo '$active: ' . $active . '<br>';
                }
            }
        }
        $liqry->close();

        ?>
        <br>
        <input type="submit" name="submit" value="Ja, verwijderen!">
        </form>
        <?php

    }
?>

<?php
    include('../core/footer.php');
?>
