<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('user-menu.php');
?>

<h1>Gebruikersoverzicht</h1>

<?php
        $liqry = $con->prepare("SELECT admin_user_id,email FROM admin_user");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($adminId,$email);
            if($liqry->execute()){
                $liqry->store_result();
                // while($liqry->fetch()) {
                //     echo 'admin id :' . $adminId . " - ";
                //     echo 'email :' . $email . " - ";
                //     echo '<a href="edit_user.php?uid='.$adminId.'">edit</a><br>';
                // }

                // table>tr*1>td*4
                echo '<table border=1>
                        <tr>
                            <td>admin uid</td>
                            <td>email</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($liqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $adminId; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><a href="edit_user.php?uid=<?php echo $adminId; ?>">edit</a></td>
                        <td><a href="delete_user.php?uid=<?php echo $adminId; ?>">delete</a></td>
                    </tr>
                    <?php 
                }
                echo '</table>';
            }

            $liqry->close();
        }

?>

<?php
    include('../core/footer.php');
?>
