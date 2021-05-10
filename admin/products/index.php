<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Productenoverzicht</h1>

<?php
        $liqry = $con->prepare("SELECT product_id, product.name, product.description, category.name, price, color, weight, product.active FROM product INNER JOIN category ON product.category_id = category.category_id");
        
        // met join
        // echo '<div class="warning">met join</div>';
        // $liqry = $con->prepare("SELECT product_id, product.name, product.description, category.name, price, color, weight, product.active FROM product
        // INNER JOIN category ON product.category_id = category.category_id 
        //");
        
        $columns = array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active');

        // $columns = array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active');
        // $liqry = $con->prepare("SELECT " . implode(", ", $columns) ." FROM product");


        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result( $product_id, $name, $description, $category_id, $price, $color, $weight, $active);
            if($liqry->execute()){
                $liqry->store_result();
                // while($liqry->fetch()) {
                //     echo 'admin id :' . $adminId . " - ";
                //     echo 'email :' . $email . " - ";
                //     echo '<a href="edit_user.php?uid='.$adminId.'">edit</a><br>';
                // }

                // table>tr*1>td*4

                echo '<table border=1>
                        <tr>';
                            // <td>admin uid</td>
                            // <td>email</td>
                            //foreach (array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active') as $column) {
                            foreach ($columns as $column) { 
                            ?>
                                <td><?php echo $column; ?></td>
                            <?php
                            }
                echo '
                            <td>edit</td>
                            <td>delete</td>

                        </tr>';

                while ($liqry->fetch() ) { 
/*
                    ?>
                        <tr>
                        <td><?php echo $product_id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $category_id; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $color; ?></td>
                        <td><?php echo $weight; ?></td>
                        <td><?php echo $active; ?></td>
                        <td><a href="edit_user.php?uid=<?php echo $product_id; ?>">edit</a></td>
                        <td><a href="delete_user.php?uid=<?php echo $product_id; ?>">delete</a></td>
                    </tr>
                    <?php 
*/

                    foreach ($columns as $column) { ?>
                        <td><?php echo ${$column}; ?></td>
                    <?php

}
                    ?>
                        <td><a href="edit_product.php?id=<?php echo $product_id; ?>">edit</a></td>
                        <td><a href="delete_product.php?id=<?php echo $product_id; ?>">delete</a></td>
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
