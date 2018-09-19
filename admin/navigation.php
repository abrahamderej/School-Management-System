<!-- navbar -->
<nav  class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <!-- to enable navigation dropdown when viewed in mobile device -->
        <a class="navbar-brand" href="<?php echo $home_url; ?>admin/index.php">SMS</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li <?php echo $page_title=="Index" ? "class='nav-item active'" : ""; ?>>
                    <a class="nav-link left-margin" href="<?php echo $home_url; ?>admin/index.php">Home</a>
                </li>

                <li <?php
                echo $page_title=="Users" ? "class='nav-item active'" : ""; ?> >
                    <a class="nav-link left-margin" href="<?php echo $home_url; ?>user/user_list.php">Users</a>
                </li>

                <li <?php echo $page_title=="Register" ? "class='nav-item active'" : ""; ?> >
                    <a class="nav-link left-margin" href="<?php echo $home_url; ?>admin/register.php">
                        <span class="fa fa-check"></span> Register
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" id="navbarDropdown" aria-expanded="false" aria-haspopup="true">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <?php echo $_SESSION['first_name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div><!--/.nav-collapse -->

    </div>
</nav>
<!-- /navbar -->
