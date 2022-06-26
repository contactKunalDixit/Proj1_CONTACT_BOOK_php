 <?php
    ob_start();
    if (!isset($_SESSION)) {
        session_start();
    };
    // include_once "../includes/config.php";
    include_once "/opt/lampp/htdocs/Proj1_Contact_Book/includes/config.php";

    // include_once(__DIR__ . "config.php");
    $user  = !empty($_SESSION["user"]) ? $_SESSION["user"] : [];
    //Set to SESSION['user'] variable if it has been carried forward from Login_Inputs.php page, else set to empty array. Navbar will show the user name if logged in; else will show general links.   

    // To Highlight the Nav option for the Current Page
    $currentPage = !empty($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "";

    ?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
     <div class="container" style="display: flex;
	align-items: center;">
         <h1 class="navbar-brand"><i class="fa fa-address-book"></i> Contact Book</h1>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
             aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
             <ul class="navbar-nav">

                 <?php
                    if (empty($_SESSION["user"])) {
                    ?>
                 <li class="nav-item <?php if ($currentPage == SITE_URL . 'sign_up.php') {
                                                echo "active";
                                            } ?>">
                     <a class="nav-link" href="<?php echo SITE_URL . 'sign_up.php' ?>">Signup</a>
                 </li>
                 <li class="nav-item <?php if ($currentPage == SITE_URL . 'login.php') {
                                                echo "active";
                                            } ?>">
                     <a class=" nav-link" href="<?php echo SITE_URL . 'login.php' ?>">Login</a>
                 </li>
                 <?php } else { ?>
                 <li class="nav-item <?php if ($currentPage == SITE_URL) {
                                                echo "active";
                                            } ?>">
                     <a class=" nav-link" href="<?php echo SITE_URL  ?>">Home <span class="sr-only">(current)</span></a>
                 </li>

                 <li class="nav-item <?php if ($currentPage == SITE_URL . 'addContact.php') {
                                                echo "active";
                                            } ?>" active>
                     <a class=" nav-link" href="<?php echo SITE_URL . 'addContact.php' ?>">Add Contact</a>
                 </li>

                 <li class='nav-item dropdown'>
                     <a class='nav-link dropdown-toggle' id=' navbarDropdownMenuLink' role='button'
                         data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>

                         <?php
                                echo (!empty($user["first_name"]) ?
                                    $user["first_name"] : "Guest") ?>
                     </a>
                     <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                         <a class='dropdown-item <?php if ($currentPage == SITE_URL . 'profile.php') {
                                                            echo "active";
                                                        } ?>' href='<?php echo SITE_URL . "profile.php" ?>'>Profile</a>
                         <a class='dropdown-item <?php if ($currentPage == SITE_URL . 'edit_profile.php') {
                                                            echo "active";
                                                        } ?>' href='<?php echo SITE_URL . "edit_profile.php" ?>'>Edit
                             Profile</a>
                         <a class='dropdown-item <?php if ($currentPage == SITE_URL . 'change_password.php') {
                                                            echo "active";
                                                        } ?>'
                             href='<?php echo SITE_URL . "change_password.php" ?>'>Change
                             Password</a>
                         <a class='dropdown-item' href='<?php echo SITE_URL . "logOut.php" ?>'>Logout</a>
                     </div>
                 </li>
                 <?php
                    }
                    ?>

             </ul>
         </div>
     </div>
 </nav>