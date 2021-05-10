<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $id = $con->real_escape_string($_POST['product_id']);
        $name = $con->real_escape_string($_POST['name']);
        $description = $con->real_escape_string($_POST['description']);
        $query1 = $con->prepare("UPDATE product SET name = ?, description = ? WHERE product_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('ssi',$name,$description,$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Product aangepast</div>';
        }
        $query1->close();
                    
    }
?>

<h1>product bewerken</h1>


<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
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
                    // echo 'product_id: <input type="text" name="product_id" value="' . $product_id . '" ><br>';
                    // echo 'name: <input type="text" name="name" value="' . $name . '"><br>';
                    // echo 'description: <input type="text" name="description" value="' . $description . '"><br>';

                    $columns = array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active');
                    foreach ($columns as $key) {
                        $dit_veld_moet_alleen_lezen_zijn = "";
                        if ($key == 'product_id') {
                            $dit_veld_moet_alleen_lezen_zijn = "readonly";
                        }
                        echo '<b>' . $key .'</b> :<input type="text" name="'.$key.'" value="' . $$key . '" '.$dit_veld_moet_alleen_lezen_zijn.'><br>';
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
