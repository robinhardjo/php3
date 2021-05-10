<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('category-menu.php');

?>

<h1>Category verwijderen</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $id = $con->real_escape_string($_POST['id']);
        $query1 = $con->prepare("DELETE FROM category WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i',$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Category met category_id '.$id.' verwijderd!</div>';
        }
        $query1->close();
                    
    }
?>


<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">weet je zeker dat je deze category wilt verwijderen?</h2><?php

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
                    echo '$category_id: ' . $category_id . '<br>';
                    echo '<input type="hidden" name="id" value="' . $id . '" />';
                    echo '$name: ' . $name . '<br>';
                    echo '$description: ' . $description . '<br>';
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
