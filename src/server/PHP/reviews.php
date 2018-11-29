<?php
if(isset($_SESSION['email'])) {
    $sql = "INSERT INTO Reviews(comment) VALUES ('" . $_POST['comment'] . "')";
} else {
    echo 'You must be signed in to write a review';

    $result = mysql_query($sql);

}

?>
