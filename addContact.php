<?php
include_once "common/header.php";
include_once "./includes/db.php";

if (empty($_SESSION["user"])) {
    header("location:" . SITE_URL . "login.php");
    exit();
}
$userId = (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) ? $_SESSION["user"]["id"] : 0;

$contactId = !empty($_GET["id"]) ? $_GET["id"] : ""; //1st time It'll be blkank but next time onwards it can be used for identifying while editing a contact

if (!empty($contactId) && is_numeric($contactId)) {
    $conn = db_connect();
    $contact_Id = mysqli_escape_string($conn, $contactId);
    $sqlQuery = "SELECT * FROM `contacts` WHERE `id` = {$contact_Id} AND `owner_id` = {$userId}";
    //Select results
    $sqlResult = mysqli_query($conn, $sqlQuery);
    $rows = mysqli_num_rows($sqlResult);
    if ($rows > 0) {
        $contactResult = mysqli_fetch_assoc($sqlResult);
    } else {
        $error_msg = "Error retrieving the contact details";
    }
    db_close($conn);
} else {
    $error_msg = "Invalid contact ID specified";
}
// print_arr($contactResult);

// Checking below that if the value is being fetched from DB, then that value will appear, else, it'll be blank so that new value can be entrered by user when he's adding a new contact in the records.

$first_name = (!empty($contactResult) && !empty($contactResult["first_name"])) ? $contactResult["first_name"] : "";
$last_name = (!empty($contactResult) && !empty($contactResult["last_name"])) ? $contactResult["last_name"] : "";
$email = (!empty($contactResult) && !empty($contactResult["email"])) ? $contactResult["email"] : "";
$phone = (!empty($contactResult) && !empty($contactResult["phone"])) ? $contactResult["phone"] : "";
$address = (!empty($contactResult) && !empty($contactResult["address"])) ? $contactResult["address"] : "";


?>

<body>
    <?php require_once "common/navigation.php" ?>
    <main role="main" class="container">
        <div class="row justify-content-center wrapper">
            <div class="col-md-6">


                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Add/Edit Contact</h4>
                    </header>
                    <article class="card-body">
                        <form method="post" action="<?php echo SITE_URL . 'user_Actions/addContact_Inputs.php' ?>"
                            enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>First Name </label>
                                    <input type="text" name="fname" value="<?php echo $first_name ?>"
                                        class="form-control" placeholder="First Name">
                                </div>
                                <div class="col form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" value="<?php echo $last_name ?>"
                                        class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" value="  <?php echo $email ?>" class="form-control"
                                    placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Phone No.</label>
                                <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control"
                                    placeholder="Contact">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="<?php echo $address ?>" class="form-control"
                                    placeholder="Address">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="photo">Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="photo" class="custom-file-input" id="contact_photo">
                                    <label class="custom-file-label" for="contact_photo">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="contactid" value="<?php echo $contactId ?>" />
                                <!-- 1st time It'll be blkank but next time onwards it can be used for identifying while editing a contact. It'll not be visible since Its hidden -->
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </article>
                </div>
                <?php
                if (!empty($_SESSION["errors"])) { ?>
                <div class="alert alert-danger">
                    <p>There were following errors:</p>
                    <ul>
                        <?php
                            foreach ($_SESSION["errors"] as $errorItem) {
                                echo "<li>" . $errorItem . "</li>";
                            }
                            ?>
                    </ul>
                </div>
                <?php
                    unset($_SESSION["errors"]);
                } ?>
            </div>

        </div>

    </main>
    <?php include_once "common/footer.php" ?>
</body>

</html>