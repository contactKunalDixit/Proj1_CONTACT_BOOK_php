<?php
ob_start();
session_start();
include_once "common/header.php";
include_once "./includes/db.php";

// Checking if the user is loggedIn:

$error_msg = '';

if (!empty($_SESSION["user"])) {
    $userId = $_SESSION["user"]["id"];
} else {
    $userId = 0;
    header("location:" . SITE_URL . "login.php");
    exit();
}

$userId = (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) ? $_SESSION["user"]["id"] : 0;
$contactId = $_GET["id"];

if (!empty($contactId) && is_numeric($contactId)) {
    $conn = db_connect();
    $contact_Id = mysqli_real_escape_string($conn, $contactId);
    $sqlQuery = "SELECT * FROM `contacts` WHERE `id` = {$contact_Id} AND `owner_id`={$userId}";
    //Selects results
    $sqlResult = mysqli_query($conn, $sqlQuery);
    $rows = mysqli_num_rows($sqlResult);
    if ($rows > 0) {
        $contactResult = mysqli_fetch_assoc($sqlResult);
    } else {
        $error_msg = "Record doesnt Exists.";
    }
    db_close($conn);
} else {
    $error_msg = "Invalid contact ID";
}


?>

<body>
    <?php include_once "common/navigation.php" ?>

    <main role="main" class="container">

        <?php
        if (!empty($error_msg)) {
            echo '<div class = "alert alert-danger text-center mt-2">' . $error_msg . '</div>';
        } else {
        ?>

        <div class="row justify-content-center wrapper">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Contact</h4>
                    </header>
                    <article class="card-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="https://via.placeholder.com/50.png/09f/666" width="150"
                                        class="img-thumbnail" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 class="text-primary">
                                        <?php
                                            echo $contactResult['first_name'] . " " . $contactResult['last_name'];
                                            ?>
                                    </h4>
                                    <p class="text-secondary">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <?php
                                            echo $contactResult["email"];
                                            ?>
                                        <br />
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <?php
                                            echo $contactResult["phone"]
                                            ?>
                                        <br />
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <?php
                                            echo $contactResult["address"];
                                            ?>
                                    </p>
                                    <!-- Split button -->
                                </div>
                            </div>

                        </div>
                    </article>

                </div>
            </div>

        </div>
        <?php } ?>

    </main>
    <?php include_once "common/footer.php"; ?>
</body>

</html>