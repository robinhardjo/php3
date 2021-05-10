<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customer-menu.php');

?>

<h1>Customer verwijderen</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $id = $con->real_escape_string($_POST['id']);
        $query1 = $con->prepare("DELETE FROM customer WHERE customer_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i',$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Customer met customer_id '.$id.' verwijderd!</div>';
        }
        $query1->close();
                    
    }
?>


<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">weet je zeker dat je deze gebruiker wilt verwijderen?</h2><?php

        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT customer_id, gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, emailadres, password, newsletter_subscription FROM customer WHERE customer_id = ? LIMIT 1;");

        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$id);
            $liqry->bind_result($customer_id, $gender, $first_name, $middle_name, $last_name, $street, $house_number, $house_number_addon, $zip_code, $city, $phone, $emailadres, $password, $newsletter_subscription );
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$customer_id: ' . $customer_id . '<br>';
                    echo '<input type="hidden" name="id" value="' . $id . '" />';
                    echo '$gender: ' . $gender . '<br>';
                    echo '$first_name: ' . $first_name . '<br>';
                    echo '$middle_name: ' . $middle_name . '<br>';
                    echo '$last_name: ' . $last_name . '<br>';
                    echo '$street: ' . $street . '<br>';
                    echo '$house_number: ' . $house_number . '<br>';
                    echo '$house_number_addon: ' . $house_number_addon . '<br>';
                    echo '$zip_code: ' . $zip_code . '<br>';
                    echo '$city: ' . $city . '<br>';
                    echo '$phone: ' . $phone . '<br>';
                    echo '$emailadres: ' . $emailadres . '<br>';
                    echo '$password: ' . $password . '<br>';
                    echo '$newsletter_subscription: ' . $newsletter_subscription . '<br>';
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
