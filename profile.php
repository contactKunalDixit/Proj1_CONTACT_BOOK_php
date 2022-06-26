<?php
ob_start();
session_start();
include_once "common/header.php";
require_once "includes/db.php";
if (empty($_SESSION["user"])) // Profile can only be viewed after being logged in. If not,then REDIRECT to Login page
{
    $currentPage = !empty($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "";
    $_SESSION["request_url"] = $currentpage;

    header("location:" . SITE_URL . "login.php");
    exit();
}

$userID = $_SESSION["user"]["id"];
$conn = db_connect();
$sql = "SELECT * FROM `users` WHERE `id` = $userID";
$sqlResult = mysqli_query($conn, $sql);
if (mysqli_num_rows($sqlResult) > 0) {
    $userInfo = mysqli_fetch_assoc($sqlResult);
} else {
    echo "User not found";
    exit();
}

?>

<body>
    <?php require_once "common/navigation.php" ?>
    <main role="main" class="container">
        <div class="row justify-content-center wrapper">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Profile</h4>
                    </header>
                    <article class="card-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="http://placehold.it/100x100" alt="" class="rounded-circle" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 class="text-primary">
                                        <?php echo  $userInfo['first_name'] . " "  . $userInfo['last_name'] ?></h4>
                                    <p class="text-secondary">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <?php echo  $userInfo['email'] ?> <br />
                                    </p>
                                    <!-- Split button -->
                                </div>
                            </div>

                        </div>
                    </article>

                </div>
            </div>

        </div> <!-- row.//-->
        <?php
        if (!empty($_SESSION["success"])) {
            echo "<div class = 'alert alert-success text-center mt-5'>";
            echo "<h5>" . $_SESSION["success"] . "</h5>";
            echo "</div>";
        }
        unset($_SESSION["success"]);
        ?>
    </main>

    <?php include_once "common/footer.php" ?>
</body>

</html>