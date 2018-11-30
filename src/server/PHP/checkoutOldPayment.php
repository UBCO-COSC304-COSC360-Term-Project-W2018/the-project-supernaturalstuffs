<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
  </head>
  <body>
    <?php
    session_start();

    include '../include/db_credentials.php';

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    //get userID from session
    $sql = "SELECT userID FROM User WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $userE, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {}

    $userID = $row['userID'];

    $_SESSION['payInfo']['uID'] = $userID;

    echo "<script type='text/javascript'>window.location.href='order.php'</script>";
    die();




    ?>
  </body>
</html>
