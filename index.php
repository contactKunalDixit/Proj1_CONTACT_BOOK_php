<?php
ob_start();
session_start();
include_once "common/header.php";
include_once "./includes/db.php";

//checking if the user is logged in

if ((!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"]))) {
    $userId = $_SESSION["user"]["id"];
} else {
    $userId = 0;
    header("location:" . SITE_URL . "login.php");
    exit();
}
?>


<body>
    <?php include_once "common/navigation.php" ?>


    <main role="main" class="container">

        <!-- Get User's contacts from database: -->
        <?php
        if (!empty($userId)) {
            $contactsSql = "SELECT * FROM `contacts` WHERE `owner_id`=$userId ORDER BY id ASC LIMIT 0,10";
            $conn = db_connect();
            $contactsResult = mysqli_query($conn, $contactsSql);
            $contactsRows = mysqli_num_rows($contactsResult);
            if ($contactsRows > 0) {
        ?>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rows = mysqli_fetch_assoc($contactsResult)) {
                        ?>

                <tr>
                    <td class="align-middle"><img src="https://via.placeholder.com/50.png/09f/666"
                            class="img-thumbnail img-list" />
                    </td>
                    <td class="align-middle"><?php echo $rows["first_name"] . " " . $rows["last_name"] ?></td>
                    <td class="align-middle">
                        <a href="<?php echo SITE_URL . 'view.php?id=' . $rows["id"]; ?> "
                            class="btn btn-success">View</a>
                        <a href="/contactbook/addcontact.php?id=9" class="btn btn-primary">Edit</a>
                        <a href="/contactbook/delete.php?id=9" class="btn btn-danger"
                            onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
        <?php
                include_once "./includes/config.php";
                getPagination($contactsRows);
                ?>
        <?php
            }
        }
        ?>


    </main>
    <?php include_once "common/footer.php"; ?>
</body>

</html>