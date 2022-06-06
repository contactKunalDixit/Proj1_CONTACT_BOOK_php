<?php
ob_start();
session_start();
include_once "common/header.php";
include_once "./includes/db.php";
//checking if the user is logged in
$userId = (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) ? $_SESSION["user"]["id"] : 0;
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
                                <td class="align-middle"><img src="https://via.placeholder.com/50.png/09f/666" class="img-thumbnail img-list" /></td>
                                <td class="align-middle"><?php echo $rows["first_name"] . " " . $rows["last_name"] ?></td>
                                <td class="align-middle">
                                    <a href="/contactbook/view.php?id=9" class="btn btn-success">View</a>
                                    <a href="/contactbook/addcontact.php?id=9" class="btn btn-primary">Edit</a>
                                    <a href="/contactbook/delete.php?id=9" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
        <?php
            }
        }
        ?>

        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item  disabled">
                    <a class="page-link" href="">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="
                <!-- /contactbook/index.php?page=1 -->
                ">1</a></li>
                <li class="page-item"><a class="page-link" href="
                <!-- /contactbook/index.php?page=2 -->
                ">2</a></li>

                <li class="page-item">
                    <a class="page-link" href="
                    <!-- /contactbook/index.php?page=2 -->
                    ">Next</a>
                </li>
            </ul>
        </nav>
    </main>
    <?php include_once "common/footer.php"; ?>
</body>

</html>