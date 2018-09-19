<?php
// core configuration
include_once "../config/core.php";
// set page title
$page_title = "Register";

// include login checker
include_once "login_checker.php";

// include classes
include_once '../config/connection.php';
include_once '../objects/users.php';
require_once '../objects/staffs.php';
include_once "../common/php/utils.php";

// include page header HTML
include_once "header.php";

echo "<div class='col-md-12'>";


// get database connection
$database = new Connection();
$db = $database->getConnection();

// initialize objects
$user = new Users($db);
$staff = new staffs($db);
$utils = new Utils();
// if form was posted
if($_POST){
    // set values to object properties ---email
    $user->first_name= $_POST['first_name'];
    $user->middle_name= $_POST['middle_name'];
    $user->last_name= $_POST['last_name'];
    $user->user_name= $_POST['user_name'];
    $user->email = $_POST['email'];
    $user->address= $_POST['address'];
    $user->password= $_POST['password'];
    $user->access_level='guardian';
    $user->access_code='code';
    $user->status=1;

    // access code for email verification
    //$user->status=0;
    //$access_code=$utils->getToken();
    //$user->access_code=$access_code;

    // create the user
    if($user->create()){

        if($user->access_level === 'teacher'){
            header("Location: {$home_url}staff/create_staff.php");
        }
        else if($user->access_level === 'student'){
            header("Location: {$home_url}student/create_student.php");
        }
        else if($user->access_level === 'guardian'){
            header("Location: {$home_url}guardian/create_guardian.php");

        }
        // send confimation email
/**          $send_to_email=$_POST['email'];
        $body="Hi {$send_to_email}.<br /><br />";
        $body.="Please click the following link to verify your email and login: {$home_url}verify/?access_code={$access_code}";
        $subject="Verification Email";

        if($utils->sendEmailViaPhpMail($send_to_email, $subject, $body)){
            echo "<div class='alert alert-success'>
        Verification link was sent to your email. Click that link to login.
    </div>";
       }
      else{
      echo "<div class='alert alert-danger'>
      User was created but unable to send verification email. Please contact admin.
      </div>";
      }

**/

            // empty posted values
        $_POST=array();

    }else{
        echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
    }
}
?>
<form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post' id='register'>

    <table class='table table-responsive'>

        <tr>
            <td class='width-30-percent'>First Name</td>
            <td><input type='text' name='first_name' class='form-control' required value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>
        <tr>
            <td class='width-30-percent'>Middle Name</td>
            <td><input type='text' name='middle_name' class='form-control' required value="<?php echo isset($_POST['middle_name']) ? htmlspecialchars($_POST['middle_name'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td><input type='text' name='last_name' class='form-control' required value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>
        <tr>
            <td>User Name</td>
            <td><input type='text' name='user_name' class='form-control' required value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>

        <tr>
            <td>Password</td>
            <td><input type='password' name='password' class='form-control' required id='passwordInput' autocomplete="false" min="6" ></td>
        </tr>

        <tr>
            <td>Address</td>
            <td><textarea name='address' class='form-control' required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : "";  ?></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">
                    <span class="fa fa-plus"></span> NEXT
                </button>
            </td>
        </tr>

    </table>
</form>
<?php


echo "</div>";

// include page footer HTML
include_once "footer.php";
?>
