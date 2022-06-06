 <?php
    ob_start();
    session_start();
    include_once "../includes/config.php";
    $user  = !empty($_SESSION["user"]) ? $_SESSION["user"] : [];
    //Set to SESSION['user'] variable if it has been carried forward, else set to empty array. Navbar will show the user name if logged in; else will show general links.    

    ?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
     <div class="container" style="display: flex;
	align-items: center;">

         <h1 class="navbar-brand"><i class="fa fa-address-book"></i> Contact Book</h1>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
             <ul class="navbar-nav">

                 <?php
                    if (empty($_SESSION["user"])) {
                    ?>
                     <li class="nav-item" active>
                         <a class="nav-link" href="<?php echo SITE_URL . 'sign_up.php' ?>">Signup</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo SITE_URL . 'login.php' ?>">Login</a>
                     </li>
                 <?php } else { ?>
                     <li class="nav-item ">
                         <a class="nav-link" href="<?php echo SITE_URL . "index.php" ?>">Home <span class="sr-only">(current)</span></a>
                     </li>

                     <li class="nav-item" active>
                         <a class="nav-link" href="<?php echo SITE_URL . 'addContact.php' ?>">Add Contact</a>
                     </li>

                     <li class='nav-item dropdown'>
                         <a class='nav-link dropdown-toggle' id=' navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>

                             <?php
                                echo (!empty($user["first_name"]) ?
                                    $user["first_name"] : "Guest") ?>
                         </a>
                         <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                             <a class='dropdown-item' href='<?php echo SITE_URL . "profile.php" ?>'>Profile</a>
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