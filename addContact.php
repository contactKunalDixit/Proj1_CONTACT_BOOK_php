<?php
include_once "common/header.php";
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
                        <form method="post" action="<?php echo SITE_URL . 'user_Actions/addContact_Inputs.php' ?>" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>First Name </label>
                                    <input type="text" name="fname" value="" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" value="" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" value="" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Phone No.</label>
                                <input type="text" name="phone" value="" class="form-control" placeholder="Contact">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="" class="form-control" placeholder="Address">
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
                                <input type="hidden" name="contactid" value="" />
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