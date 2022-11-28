<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $noNav = '';
    $pageTitle = "SignUp";
    include "init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $hashpass = sha1($pass);

        $ob = new dataConnection();

        $result = $ob->select("id,name,password,role_id", 'users', "WHERE email = '$email'", "AND password = '$hashpass'", '');

        //print_r($result);

        $groupid = $result['role_id'];

        if ($groupid == 1) {
            //echo 'admin';
    
            $_SESSION['username'] = $result['name'];
            $_SESSION['role_id'] = $groupid;
            $_SESSION['user_id'] = $result['id'];
           
            header("location:admin/dashboard.php");
            exit();
        } elseif ($groupid == 2) {
            //echo 'teatcher';
            $_SESSION['username'] = $result['name'];
            $_SESSION['role_id'] = $groupid;
            $_SESSION['user_id'] = $result['id'];
            header("location:admin/dashboard.php");
            exit();
        }else{
            header("location:login.php");
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

                        <div class="row">
                            <div class="col-12">
                                <p class="mbbb">
                                    <a href="signup.php" class="text-center">Register a new membership</a>
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