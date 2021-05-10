<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('user-menu.php');

?>

<h1>Gebruiker toevoegen</h1>

<?php
    if (isset($_POST['email']) && $_POST['email'] != "") {
        $email = $con->real_escape_string($_POST['email']);

        $liqry = $con->prepare("INSERT INTO admin_user (email) VALUES (?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('s',$email);
            if($liqry->execute()){
                echo "admin user met email " . $email . " toegevoegd.";
            }
        }
        $liqry->close();

    }
?>

<form action="" method="POST">
email: <input type="text" name="email" value=""><br><br>
<input type="submit" name="submit" value="Toevoegen">
</form>



<?php
    include('../core/footer.php');
?>
