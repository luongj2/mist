<?php $title = 'Log In' ?>
<?php include(dirname(__DIR__).'/includes/php/header.php')?>

    <link rel="stylesheet" href="login.css">    

    <div class="title">
        Log In
    </div>

    <form action="login.php" method="post"> 
        <div class="form">
            <input type="email" name="userEmail" placeholder="Email" required="required">
            <input type="password" name="userPassword" placeholder="Password" required="required">
        </div>

        <div class="submit">
            <button>Log In</button>
        </div>
    </form>
    
<?php include(dirname(__DIR__).'/includes/php/footer.php')?>