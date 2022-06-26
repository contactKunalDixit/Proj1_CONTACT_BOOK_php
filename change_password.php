<?php

include_once "common/header.php";
include_once "includes/db.php";
if (empty($_SESSION["user"])) {
    $currentPage = !empty($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "";
    $_SESSION["request_url"] = $currentpage;
    header("location:" . SITE_URL . "login.php");
    exit();
}
$userId = (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) ? $_SESSION["user"]["id"] : 0;

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
                        <h4 class="card-title mt-2">Change Password</h4>
                    </header>
                    <article class="card-body">
                        <form method="post"
                            action="<?php echo (SITE_URL . 'user_Actions/update_password_Inputs.php') ?>">

                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" name=" old_password" class="form-control"
                                    placeholder="Old password">

                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name=" new_password" class="form-control"
                                    placeholder="New password">

                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" name=" confirm_password" class="form-control"
                                    placeholder="confirm password">

                            </div>
                            <div class="form-group">
                                <input type="submit" name="InputBtn" class="btn btn-success btn-block" value="Update" />
                            </div>

                        </form>
                    </article>

                </div>
                <?php
                if (!empty($_SESSION["success"])) {

                    echo "<div class='alert alert-success text-center'>";
                    echo "<h5>" . $_SESSION["success"] . "</h5>";
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