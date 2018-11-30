<?php
if(isset($_SESSION['email'])) {
    $sql = "INSERT INTO Reviews(comment) VALUES ('" . $_POST['comment'] . "')";

    $result = mysql_query($sql);


} else {
    $message = "You must be signed in to write a review";
    echo "<script type='text/javascript'>alert('$message')</script>";
}

?>
