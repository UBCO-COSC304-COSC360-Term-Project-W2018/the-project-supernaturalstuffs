<?php
session_start();
if(isset($_SESSION['email'])) {
    $id = $_GET["pID"];
    $sql = "SELECT userID FROM User";
    $sql = "INSERT INTO Reviews(comment) VALUES ('" . $_POST['comment'] . "')";

    $result = mysql_query($sql);


} else {
    $message = "You must be signed in to write a review";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href='/individualProducts.php?pID='.$id.'</script>";
}

?>

//reviews table - userID, pID, comment
