<?php $title = 'Sign Up' ?>
<?php include(dirname(__DIR__).'/includes/php/header.php')?>

    <link rel="stylesheet" href="signup.css">    

    <div class="title">
        Sign Up
    </div>

    <form action="signup.php" method="post"> 
        <div class="form">
            <input type="text" name="userFirstName" placeholder="First Name" required="required">
            <input type="text" name="userLastName" placeholder="Last Name" required="required">
            <input type="email" name="userEmail" placeholder="Email" required="required">
            <input type="email" name="userEmailVerify" placeholder="Verify Email" required="required">
            <input type="password" name="userPassword" placeholder="Password" required="required">
            <input type="password" name="userPasswordVerify" placeholder="Verify Password" required="required">
        </div>

        <div class="submit">
            <button>Sign Up</button>
        </div>
    </form>
    
<?php include(dirname(__DIR__).'/includes/php/footer.php')?>