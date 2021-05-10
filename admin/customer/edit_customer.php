<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customer-menu.php');

?>

<h1>Customer bewerken</h1>

<?php
// prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $id = $con->real_escape_string($_POST['customer_id']);
        $gender = $con->real_escape_string($_POST['gender']);
        $first_name = $con->real_escape_string($_POST['first_name']);
        $middle_name = $con->real_escape_string($_POST['middle_name']);
        $last_name = $con->real_escape_string($_POST['last_name']);
        $street = $con->real_escape_string($_POST['street']);
        $house_number = $con->real_escape_string($_POST['house_number']);
        $house_number_addon = $con->real_escape_string($_POST['house_number_addon']);
        $zip_code = $con->real_escape_string($_POST['zip_code']);
        $city = $con->real_escape_string($_POST['city']);
        $phone = $con->real_escape_string($_POST['phone']);
        $emailadres = $con->real_escape_string($_POST['emailadres']);
        $password = $con->real_escape_string($_POST['password']);
        $newsletter_subscription = $con->real_escape_string($_POST['newsletter_subscription']);
        $query1 = $con->prepare("UPDATE customer SET gender = ?, first_name = ?, middle_name = ?, last_name = ?, street = ?, house_number = ?, house_number_addon = ?, zip_code = ?, city = ?, phone = ?, emailadres = ?, password = ?, newsletter_subscription = ? WHERE customer_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('sssssssssssssi',$gender,$first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadres,$password,$newsletter_subscription,$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Customer aangepast</div>';
        }
        $query1->close();
                    
    }
?>



<form action="" method="POST">
<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
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
                    // echo 'product_id: <input type="text" name="product_id" value="' . $product_id . '" ><br>';
                    // echo 'name: <input type="text" name="name" value="' . $name . '"><br>';
                    // echo 'description: <input type="text" name="description" value="' . $description . '"><br>';

                    $columns = array('customer_id', 'gender', 'first_name', 'middle_name', 'last_name', 'street', 'house_number', 'house_number_addon', 'zip_code', 'city', 'phone', 'emailadres', 'password', 'newsletter_subscription');
                    foreach ($columns as $key) {
                        $dit_veld_moet_alleen_lezen_zijn = "";
                        if ($key == 'customer_id') {
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
