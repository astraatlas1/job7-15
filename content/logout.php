<h1>Logout</h1>
<form action="index.php" method="post" name="maint" id="maint">
    <fieldset class="maintform">
        <legend>Logout</legend>
        <p>Are you sure you want to logout, <?php echo $_SESSION['first_name'];
        ?>?
        </p>
        <?php
        // create token 
        $salt = 'SomeSalt';
        $token = sha1(mt_rand(1,1000000) . $salt);
        $_SESSION['token'] = $token;
        ?>
        <input type="hidden" name="task" id="task" value="logout" />
        <input type="hidden" name="token" value='<?php echo $token; ?>'/>
        <input type="submit" name="logout" value="Logout" />
        <a class="cancel" href="index.php">Cancel, return to Home Page</a>
    </fieldset>
</form>