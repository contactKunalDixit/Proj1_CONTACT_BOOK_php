<?php

include_once "common/header.php";

?>

<body>
    <?php require_once "common/navigation.php" ?>

    <main role="main" class="container">
        <style>
            .wrapper {
                padding-top: 30px;
            }
        </style>

        <div class="row justify-content-center wrapper">
            <div class="col-md-6">



                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Sign up</h4>
                    </header>
                    <article class="card-body">
                        <form method="post" action="<?php echo (SITE_URL . 'user_Actions/sign_up_Inputs.php') ?>">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>First name </label>
                                    <input type="text" name="fname" class="form-control" placeholder="First Name"><span class="error"> <?php echo $fNameErr; ?></span>
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Last name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last Name">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" name="email" class="form-control" placeholder="">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="cpassword">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="InputBtn" class="btn btn-primary btn-block" value="Register" />
                            </div>

                        </form>
                    </article>
                    <div class="border-top card-body text-center">Have an account?
                        <a href="<?php echo SITE_URL . 'login.php' ?>">Log In
                        </a>
                    </div>
                </div>
                <?php
                if (!empty($_SESSION["success"])) {

                    echo "<div class='alert alert-success text-center'>";
                    echo "<h4>" . $_SESSION["success"] . "</h4>";
                    echo "</div>";
                }
                ?>
                <?php unset($_SESSION["success"]); ?>
                <!-- To clear the session variables for the next time. On UI, this'll clear the previous success/error messages -->
                <?php
                if (!empty($_SESSION["errors"])) {

                    echo "<div class='alert alert-danger'>";
                    echo "<p>There were following error(s) found: </p>";
                    echo "<ul>";

                    foreach ($_SESSION["errors"] as $errorItem) {
                        print("<li>" . $errorItem . "</li>");
                    }
                    echo "</ul>";
                    echo "</div>";
                }
                ?>
                <?php unset($_SESSION["errors"]); ?>
                <!-- To clear the session variables for the next time. On UI, this'll clear the previous error messages -->

            </div>

        </div>

    </main>

    <?php
    include_once "common/footer.php";
    ?>
</body>

</html>