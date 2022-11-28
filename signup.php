<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $noNav = '';
    $pageTitle = "SignUp";
    include "init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = sha1($_POST['pass']);
        $password2 = sha1($_POST['confirmPassword']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $errors = [];

        $ob = new validator();
        $ob->check('name', $fname, ['req', 'str']);
        $ob->check('password', $pass, ['req']);
        $ob->check('email', $email, ['req']);

        if ($pass !== $password2) {
            $errors[] = "Must be same";
        }

        if ($ob->checkerrors() && empty($errors)) {
            $role = 2;
            $user = new dataConnection();
            $user->insert('users', 'name,Password,Email,role_id', "'$fname','$pass','$email','$role'");
            $_SESSION['username'] = $fname;
            $_SESSION['role_id'] = $role;
            header("location:logout.php");
        } else {
            $bigErrors = $ob->geterrors();
            foreach($bigErrors as $err)
            {
                echo "<div class='forHeaders'></div><div class='m-auto w-25 alert alert-danger'>".$err."</div></div>";
               
            }
            foreach($errors as $err)
            {
                echo "<div class='forHeaders'></div><div class='m-auto w-25 alert alert-danger'>".$err."</div></div>";
            }
        }
    }
?>

    <div class="container forHeaders">
        <div class="login-box m-auto">
            <div class="login-logo">
                <a href="index.php"><b>ToDoList</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form" enctype="multipart/form-data">

                        <div class="form-group">

                            <div class="forRes">
                                <input type="text" name="fname" requierd placeholder="type Full name of member" autocomplete="off" class="req form-control">
                                <i class="fa fa-asterisk"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>Full Name of member must be atleast 2 letters</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="forRes">
                                <input type="email" name="email" requierd placeholder="type name of category" autocomplete="off" class="req form-control">
                                <i class="fa fa-asterisk"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>email is required</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="forRes">
                                <input type="password" name="pass" requierd placeholder="type strong password" autocomplete="new-password" class="passs inputForShow form-control">
                                <i class="show fa fa-eye"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>Password of member must be atleast 8 letters</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="forRes">
                                <input type="password" name="confirmPassword" requierd placeholder="type strong password" autocomplete="new-password" class="passs inputForShow form-control">
                                <i class="show fa fa-eye"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>confirm password</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="mbbb">
                                    <a href="login.php" class="text-center">Already Have an Account ?</a>
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>

                    </form>
                </div>

                <!-- /.login-card-body -->
            </div>
        </div>
    </div>

<?php
}
include "inc/templates/footer.php";
?>