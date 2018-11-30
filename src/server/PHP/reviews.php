<?php
session_start();
$id = $_GET['id'];
if(isset($_SESSION['email'])) {
    $custE = $_SESSION['email'];

    $comment = null;
    if(!isset($_POST['comment'])) {
      $message = "Please write a comment!";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='/individualProducts.php?pID='.$id.'</script>";
    }else{
      $comment = $_POST['comment'];
    }

    include '../include/db_credentials.php';

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    $sql = "SELECT userID FROM User WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $custE, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {}

    $userID = $row['userID'];

    $sql2 = "INSERT INTO CommentsOn VALUES (?, ?, ?)";
    $statement = $pdo->prepare($sql2);
    $statement->execute(array($userID, $id, $comment));

    echo '<script type="text/javascript">window.location.href="individualProducts.php?pID="'.$id.'"</script>';
} else {
    $message = "You must be signed in to write a review";

    echo '<script type="text/javascript">alert("$message");
    window.location.href="individualProducts.php?pID="' . $id . '"</script>';

}

?>
