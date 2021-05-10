<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('category-menu.php');

?>

<h1>Product bewerken</h1>

<?php
// prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $id = $con->real_escape_string($_POST['category_id']);
        $name = $con->real_escape_string($_POST['name']);
        $description = $con->real_escape_string($_POST['description']);
        $active = $con->real_escape_string($_POST['active']);
        $query1 = $con->prepare("UPDATE category SET name = ?, description = ?, active = ? WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('sssi',$name,$description,$active,$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Categorie aangepast</div>';
        }
        $query1->close();
                    
    }
?>



<form action="" method="POST">
<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT category_id, name, description, active FROM category WHERE category_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$id);
            $liqry->bind_result($category_id, $name, $description, $active );
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    // echo 'product_id: <input type="text" name="product_id" value="' . $product_id . '" ><br>';
                    // echo 'name: <input type="text" name="name" value="' . $name . '"><br>';
                    // echo 'description: <input type="text" name="description" value="' . $description . '"><br>';

                    $columns = array('category_id', 'name', 'description', 'active');
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
