<?php
// core configuration
include_once "config/core.php";

// set page title
$page_title = "Forgot Password";

// include login checker
include_once "login_checker.php";

// include classes
include_once "config/connection.php";
include_once 'objects/users.php';
include_once "common/php/utils.php";

// get database connection
$database = new Connection();
$db = $database->getConnection();

// initialize objects
$user = new Users($db);
$utils = new Utils();

// include page header HTML
include_once "header.php";

// if the login form was submitted
if($_POST){

    echo "<div class='col-sm-12'>";

    // check if username and password are in the database
    $user->email=$_POST['email'];

    if($user->emailExists()){

        // update access code for user
        $access_code=$utils->getToken();

        $user->access_code=$access_code;
        if($user->updateAccessCode()){

            // send reset link
            $body="Hi there.<br /><br />";
            $body.="Please click the following link to reset your password: {$home_url}reset_password/?access_code={$access_code}";
            $subject="Reset Password";
            $send_to_email=$_POST['email'];

            if($utils->sendEmailViaPhpMail($send_to_email, $subject, $body)){
                echo "<div class='alert alert-info margin-top-40'>
							Password reset link was sent to your email.
							Click that link to reset your password.
						</div>";
            }

            // message if unable to send email for password reset link
            else{ echo "<div class='alert alert-danger margin-top-40'>ERROR: Unable to send reset link.</div>"; }
        }

        // message if unable to update access code
        else{ echo "<div class='alert alert-danger margin-top-40'>ERROR: Unable to update access code.</div>"; }

    }

    // message if email does not exist
    else{ echo "<div class='alert alert-danger margin-top-40'>Your email cannot be found.</div>"; }

    echo "</div>";
}


// show reset password HTML form
echo "<div class='col-md-4'></div>";
echo "<div class='col-md-4'>";

echo "<div class='account-wall'>
        <div class='tab-pane active' id='login'>
            <img class='profile-img' src='common/img/place_holder.jpg'>
            <form class='form-signin' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>
                <input type='email' name='email' class='form-control' placeholder='Your email' required autofocus>
                <input type='submit' class='btn btn-lg btn-primary btn-block' value='Send Reset Link' style='margin-top:1em;' />
            </form>
        </div>
	</div>";

echo "</div>";
echo "<div class='col-md-4'></div>";

// footer HTML and JavaScript codes
include_once "footer.php";
?>
