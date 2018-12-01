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


    //comment stuff
    $sql = "SELECT userID FROM User WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $custE, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {}

    $userID = $row['userID'];

    //make sure they are admin
    $sql = "SELECT userID FROM Admin WHERE userID = :userID";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $numAdmin = "0";
    foreach ($rows as $row) {
      $numAdmin = $numAdmin + "1";
    }

    if($numAdmin > "0"){
      $message = "Please login to a valid admin account or check with administration you still have your admin privileges";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='/index.php'</script>";
      die();
    }

    //make sure they havent commented before
    $sql = "SELECT userID FROM CommentsOn WHERE userID = :userID AND pID = :pID";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
    $statement->bindParam(':pID', $id, PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $numRows = 0;
    foreach ($rows as $row) {
      $numRows = $numRows + "1";
    }

    if($numRows <= "0"){
      $sql2 = "INSERT INTO CommentsOn VALUES (?, ?, ?)";
      $statement = $pdo->prepare($sql2);
      $statement->execute(array($userID, $id, $comment));
      echo '<script type="text/javascript">window.location.href="individualProducts.php?pID='.$id.'"</script>';
    }else{
      $message = "To Keep comments diverse you can only comment on a product once. Sorry!";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='individualProducts.php?pID=" . $id . "'</script>";
    }

} else {
    $message = "You must be signed in to write a review";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href='individualProducts.php?pID=" . $id . "'</script>";

}

    //window.location.href='/index.php'</script>";
?>
