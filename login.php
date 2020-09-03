<?php
// core configuration
include_once "config/core.php";
// include classes
include_once "config/connection.php";
include_once "objects/users.php";

// get database connection
$database = new Connection();
$db = $database->getConnection();

// initialize objects
$user = new Users($db);

// set page title
$page_title = "Login";

// include login checker
$require_login=false;
include_once "login_checker.php";

// default to false
$access_denied=false;

if($_POST){

// check if email and password are in the database
    $user->email=$_POST['email'];

// check if email exists, also get user details using this emailExists() method
    $email_exists = $user->emailExists();

// validate login
    if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){

        // if it is, set the session value to true
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['first_name'] = htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ;
        $_SESSION['last_name'] = $user->last_name;

        // if access level is 'Admin', redirect to admin section
        if($user->access_level=='Admin'){
            header("Location: {$home_url}admin/index.php?action=login_success");
        }

        // else, redirect only to 'Customer' section
        else{
            header("Location: {$home_url}index.php?action=login_success");
        }
    }

// if username does not exist or password is wrong
    else{
        $access_denied=true;
    }


}


// include page header HTML
include_once "header.php";

echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";

// alert messages will be here
// get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){
    echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
}

// tell the user to login
else if($action=='please_login'){
    echo "<div class='alert alert-info'>
		<strong>Please login to access that page.</strong>
	</div>";
}
// tell the user email is verified
else if($action=='email_verified'){
    echo "<div class='alert alert-success'>
		<strong>Your email address have been validated.</strong>
	</div>";
}

// tell the user if access denied
if($access_denied){
    echo "<div class='alert alert-danger margin-top-40' role='alert'>
		Access Denied.<br /><br />
		Your username or password maybe incorrect
	</div>";
}

?>
    <div class='account-wall'>
    <div id='my-tab-content' class='tab-content'>
        <div class='tab-pane active' id='login'>
            <img class='profile-img' src='common/img/place_holder.jpg'>
            <form class='form-signin' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                <input type='text' name='email' class='form-control' placeholder='Email' required autofocus />
                <input type='password' name='password' class='form-control' placeholder='Password' required />
                <input type='submit' class='btn btn-lg btn-primary btn-block' value='Log In' />
                <?php echo "<div class='margin-1em-zero text-align-center'>
                    <a href='{$home_url}forgot_password'>Forgot password?</a>
                </div>";
                    ?>
            </form>
            </div>
        </div>
    </div>

</div>
<?php
// footer HTML and JavaScript codes
include_once "footer.php";

?>