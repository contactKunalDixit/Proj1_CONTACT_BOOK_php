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

if (!empty($userId) && is_numeric($userId)) {
    $conn = db_connect();
    $userId = mysqli_escape_string($conn, $userId);
    $sqlQuery = "SELECT * FROM `users` WHERE `id` = {$userId}";
    $sqlRes = mysqli_query($conn, $sqlQuery);
    $rows = mysqli_num_rows($sqlRes);
    if ($rows > 0) {
        $userInfo = mysqli_fetch_assoc($sqlRes);
    } else {
        $error_msg = "Error retrieving your details";
        exit();
    }
    db_close($conn);
}

$first_name = (!empty($userInfo) && !empty($userInfo["first_name"])) ? $userInfo["first_name"] : "";
$last_name = (!empty($userInfo) && !empty($userInfo["last_name"])) ? $userInfo["last_name"] : "";
$email = (!empty($userInfo) && !empty($userInfo["email"])) ? $userInfo["email"] : "";
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
                        <h4 class="card-title mt-2">Edit your profile</h4>
                    </header>
                    <article class="card-body">
                        <form method="post"
                            action="<?php echo (SITE_URL . 'user_Actions/update_profile_Inputs.php') ?>">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>First name </label>
                                    <input type="text" name="fname" class="form-control" placeholder="First Name"
                                        value="<?php echo $first_name ?>">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Last name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last Name"
                                        value="<?php echo $last_name ?>">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" name="email" class="form-control" placeholder=""
                                    value="<?php echo $email ?>">

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