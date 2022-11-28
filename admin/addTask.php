<?php
session_start();
if (isset($_SESSION['username'])) {

    $pageTitle = "new task";
    include "init.php";
?>
    <?php
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    if ($do == 'add') {
    ?>
        <div class="container forHeaders">
            <form action="addTask.php?do=addAction" method="POST" class="form">

                <div class="form-group">
                    <div class="forRes">
                        <input type="text" name="title" requierd placeholder="Enter your Task" autocomplete="off" class="req form-control">
                        <i class="fa fa-asterisk"></i>
                        <div class="custom-alert alert alert-danger mt-1">
                            <p>Task must be atleast 5 letters</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="add your task" class="sub btn btn-primary btn-lg">
                </div>

            </form>
        </div>

    <?php
    } elseif ($do == 'addAction') {

        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user = $_SESSION['user_id'];
        $ob = new validator();
        $ob->check('title', $title, ['req', 'str']);

        if ($ob->checkerrors()) {

            $task = new dataConnection();
            $task->insert('tasks', 'title,user_id', "'$title','$user'");

            header("location:dashboard.php");
        } else {
            $bigErrors = $ob->geterrors();
            foreach ($bigErrors as $err) {
                echo "<div class='forHeaders'><div class='m-auto w-25 alert alert-danger'>" . $err . "</div></div>";
            }
        }

    ?>
        <?php
    } elseif ($do == 'edit') {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $ob = new dataConnection();
        $count = $ob->checkItem('id', 'tasks', $id);
        if ($count > 0) {
            $value = $ob->select('*', 'tasks', "WHERE id = '$id'", NULL, '');

            $userid = $_SESSION['user_id'];
            $taskUserId = $ob->select3('user_id', 'tasks', "WHERE id = '$id'", NULL, '');
        
            if($userid == $taskUserId){    
        ?>
            <div class="container forHeaders">
                <form action="addTask.php?do=update" method="POST" class="form">

                    <div class="form-group">
                        <input type="hidden" name="taskid" value="<?php echo $id; ?>">
                        <div class="forRes">
                            <input type="text" name="title" value="<?php echo $value['title']; ?>" requierd placeholder="Enter your Task" autocomplete="off" class="req form-control">
                            <i class="fa fa-asterisk"></i>
                            <div class="custom-alert alert alert-danger mt-1">
                                <p>Task must be atleast 5 letters</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="update your task" class="sub btn btn-primary btn-lg">
                    </div>

                </form>
            </div>

    <?php }else{ 
        echo "<div class='forHeaders'><div class='m-auto w-25 alert alert-danger'>an authorize</div></div>";
        }
     }
    } elseif ($do == 'update') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id   = filter_var($_POST['taskid'], FILTER_SANITIZE_NUMBER_INT);
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $ob = new validator();
            $ob->check('title', $title, ['req', 'str']);

            if ($ob->checkerrors()) {
                $user = new dataConnection();
                $count = $user->checkItem('id', 'tasks', $id);

                if ($count > 0) {
                    $user = new dataConnection();
                    $userid = $_SESSION['user_id'];
                    $taskUserId = $user->select3('user_id', 'tasks', "WHERE id = '$id'", NULL, '');
                    if($userid == $taskUserId){
                        $user->update('tasks', "title='$title'", 'id', $id);
                        header("location:dashboard.php");
                    }else{ echo "<div class='forHeaders'><div class='m-auto w-25 alert alert-danger'>an authorize</div></div>";}
                } else {
                    echo "Sorry This id is not exist";
                }
            } else {
                $bigErrors = $ob->geterrors();
                //// some edits
                foreach ($bigErrors as $err) {
                    echo "<div class='forHeaders'><div class='m-auto w-25 alert alert-danger'>" . $err . "</div></div>";
                }
            }
        } else {
            echo "<div class='container mt-5'>Not Allow To you</div>";
            header("location:dashboard.php");
        }
    } elseif ($do == 'delete') {

        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $ob = new dataConnection();
        $count = $ob->checkItem('id', 'tasks', $id);

        if ($count > 0) {
            $userid = $_SESSION['user_id'];
            $taskUserId = $ob->select3('user_id', 'tasks', "WHERE id = '$id'", NULL, '');
            if($userid == $taskUserId){
            $ob->delete('tasks', 'id', $id);
            header("location:dashboard.php");
            }else{
                echo "<div class='forHeaders'><div class='m-auto w-25 alert alert-danger'>an authorize</div></div>";
            }
        } else {
            echo "Sorry This id is not exist";
        }
    } elseif ($do == 'Activate') {

        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $ob = new dataConnection();
        $count = $ob->checkItem('id', 'tasks', $id);

        if ($count > 0) {
            $userid = $_SESSION['user_id'];
            $taskUserId = $ob->select3('user_id', 'tasks', "WHERE id = '$id'", NULL, '');
            if($userid == $taskUserId){
            $ob->update('tasks', 'status = 1', 'id', $id);
            header("location:dashboard.php");
            }else{
                echo "<div class='forHeaders'><div class='m-auto w-25 alert alert-danger'>an authorize</div></div>";
            }
        } else {
            echo "Sorry This id is not exist";
        }
    }

    ?>
<?php
} else {
    header("location:../login.php");
}
include "inc/templates/footer.php";
?>