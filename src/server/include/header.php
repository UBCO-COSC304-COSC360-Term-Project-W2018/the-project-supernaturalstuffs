<header>
    <h1 id="title"><a href="/index.php"><img src="/src/client/images/logo.png">Super(natural) Store</a></h1>
    <div id="search-cart">
        <form action="/src/server/PHP/products.php" method="get">
            <input type="text" name="filter" class="searchHome" placeholder="Search...">
            <img src="/src/client/images/search.png" alt="search" id="search">
			<a href="/src/server/PHP/cart.php"><img src="/src/client/images/cart.png" alt="shopping cart" id="cart"></a>
	   </form>
    </div>
    <nav>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="/src/server/PHP/contact-FAQ.php">Contact</a></li>
            <?php
              $custE = null;
              if(isset($_SESSION['email'])){
                $custE = $_SESSION['email'];
                //get user id
                $sql3 = "SELECT userID,email FROM User WHERE email = :email";
                $statement = $pdo->prepare($sql3);
                $statement->bindParam(':email', $custE, PDO::PARAM_STR);
                $statement->execute();
                $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows2 as $row2) {}
                $userID = $row2['userID'];
                //check if user is admin
                $sql = "SELECT * FROM Admin WHERE userID = :userID" ;
                $statement = $pdo->prepare($sql);
                $statement->bindParam(':userID',$userID, PDO::PARAM_STR);
                $statement->execute();
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                $numRows = 0;
                foreach ($rows as $row) {
                  $numRows = $numRows + 1;
                }
                if($numRows > 0){
                  echo "<li><a href='/src/server/PHP/admin.php'>Admin</a></li>";
                }
              }
             ?>
        </ul>
        <ul id="login-signup">
            <?php
              if(!isset($_SESSION['email'])){
                echo "<li><a href='/src/server/PHP/login.php' class='login-signup'>Login</a></li>";
                echo "<li><a href='/src/server/PHP/createAccount.php' class='login-signup'>Signup</a></li>";
              }else{
                echo "<li><a href='/src/server/PHP/logout.php' class='login-signup'>Logout</a></li>";
                echo "<li><a href='/src/server/PHP/accountDetails.php' class='login-signup'>Account</a></li>";
              }
            ?>
        </ul>
    </nav>
</header>
