<!-- navbar -->
<nav class="navtop navbar navbar-expand-md fixed-top navbar-light">
    <div class="container-fluid">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <a class="navbar-brand" href="<?php echo $home_url; ?>">SMS</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon "></span>
            </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li <?php echo $page_title=="Index" ? "class='nav-item active'" : ""; ?>>
                    <a class="nav-link left-margin" href="<?php echo $home_url; ?>">Home</a>
                </li>

            <?php
            // check if users / customer was logged in
            // if user was logged in, show "Edit Profile", "Orders" and "Logout" options
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Student'){
                ?>
                    <li <?php echo $page_title=="Index" ? "class='active nav-item '" : ""; ?>>
                        <a class="nav-link left-margin" href="<?php echo $home_url; ?>">View Courses</a>
                    </li>
                    <li <?php echo $page_title== "Edit Profile" ? "class='active nav-item dropdown'" : ""; ?>>
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" id="navbarDropdown" aria-expanded="false" aria-haspopup="true" >
                            <span class="fa fa-user" aria-hidden="true"></span>
                            <?php echo $_SESSION['first_name'];?>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $home_url; ?>logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
                <?php
            }
            else if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['access_level'] == 'Teacher'){ ?>
                    <li <?php echo $page_title=="Grade" ? "class='nav-item active'" : ""; ?>>
                        <a class="nav-link left-margin" href="<?php echo $home_url; ?>create_grade.php">Add Grade</a>
                    </li>
                    <li <?php echo $page_title== "Edit Profile" ? "class='active nav-item dropdown'" : ""; ?>>
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" id="navbarDropdown" aria-expanded="false" aria-haspopup="true">
                            <span class="fa fa-user" aria-hidden="true"></span>
                            <?php echo $_SESSION['first_name'];?>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $home_url; ?>logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
               <?php
            }

            // if user was not logged in, show the "login"
            else{
                ?>
                    <li <?php echo $page_title=="Login" ? "class='nav-item active'" : ""; ?>>
                        <a class="nav-link left-margin" href="<?php echo $home_url; ?>login">
                            <span class="fa fa-sign-in-alt"></span> Log In
                        </a>
                    </li>
                </ul>
                <?php
            }

            ?>

        </div><!--/.nav-collapse -->

    </div>
</nav>
<!-- /navbar -->
