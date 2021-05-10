<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customer-menu.php');

?>

<h1>Product toevoegen</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != "") {
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
        // $date_added = $con->real_escape_string($_POST['date_added']);

        $liqry = $con->prepare("INSERT INTO customer (gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, emailadres, password, newsletter_subscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('sssssssssssss',$gender,$first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadres,$password,$newsletter_subscription);
            if($liqry->execute()){
                echo '<div style="border: 2px solid red">Klant toegevoegd</div>';
            }
        }
        $liqry->close();

    }
?>

<form action="" method="POST">
gender: <input type="text" name="gender" value=""><br>
first_name: <input type="text" name="first_name" value=""><br>
middle_name: <input type="text" name="middle_name" value=""><br>
last_name: <input type="text" name="last_name" value=""><br>
street: <input type="text" name="street" value=""><br>
house_number: <input type="number" name="house_number" value=""><br>
house_number_addon: <input type="text" name="house_number_addon" value=""><br>
zip_code: <input type="text" name="zip_code" value=""><br>
city: <input type="text" name="city" value=""><br>
phone: <input type="number" name="phone" value=""><br>
emailadres: <input type="email" name="emailadres" value=""><br>
password: <input type="text" name="password" value=""><br>
newsletter_subscription: <input type="number" name="newsletter_subscription" value=""><br>
<!-- date_added: <input type="text" name="date_added" value=""><br><br> -->
<input type="submit" name="submit" value="Toevoegen">
</form>



<?php
    include('../core/footer.php');
?>
