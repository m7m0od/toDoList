<?php
session_start();
if (isset($_SESSION['username'])) {

    $pageTitle = "dashboard";
    include "init.php";

    if ($_SESSION['role_id'] == 1) {
        $ob = new dataConnection();
        $tasks = $ob->select2('*', 'tasks', NULL, NULL, '');

        if ($tasks) {

?>
            <div class="container table-responsive forHeaders">
                <table class="table main-table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Task</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tasks as $cat) {
                            echo "<tr>";
                            echo "<td>" . $cat['id'] . "</td>";
                            echo "<td>" . $_SESSION['username'] . "</td>";
                            echo "<td>" . $cat['title'] . "</td>";
                            echo "<td>" . $cat['Time'] . "</td>";
                            echo "<td>" . $cat['Date'] . "</td>"; //chunk_split($sub['Description'],0,5)
                            echo "<td>";
                            if ($cat['status'] == 1) {
                                echo 'fiished';
                            } else {
                                echo 'not finished';
                            }
                            echo "</td>";
                            echo "<td><a class='btn btn-info' href='addTask.php?do=edit&id=" . $cat['id'] . "'>edit </a> <a class='btn btn-danger confirm' href='addTask.php?do=delete&id=" . $cat['id'] . "'>Delete </a> ";
                            if ($cat['status'] == 0) {
                                echo "<a class='btn btn-info' href='addTask.php?do=Activate&id=" . $cat['id'] . "'>activate</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a class='btn btn-primary' href='addTask.php?do=add'>Add New Task</a>
            </div>
        <?php
        } else {
        ?>
            <div class="row forHeaders">
                <div class="col-md-12">
                    <div class=" w-50 text-center m-auto">
                        <ion-icon class="iconNotFound" name="book-outline"></ion-icon>
                        <h4>Your notes is empty!</h4>
                        <a href='addTask.php?do=add' class="btn btn-info">Add New Tasks!</a>
                    </div>
                </div>
            </div>
        <?php

        }
    } elseif ($_SESSION['role_id'] == 2) {
        $ob = new dataConnection();
        $userid = $_SESSION['user_id'];

        $tasks = $ob->select2('*', 'tasks', "WHERE user_id = '$userid'", NULL, '');

        if ($tasks) {
            
        ?>
       
            <div class="container table-responsive forHeaders">
                <table class="table main-table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Task</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tasks as $cat) {
                            echo "<tr>";
                            echo "<td>" . $cat['id'] . "</td>";
                            echo "<td>" . $cat['title'] . "</td>";
                            echo "<td>" . $cat['Time'] . "</td>";
                            echo "<td>" . $cat['Date'] . "</td>"; //chunk_split($sub['Description'],0,5)
                            echo "<td>";
                            if ($cat['status'] == 1) {
                                echo 'fiished';
                            } else {
                                echo 'not finished';
                            }
                            echo "</td>";
                            echo "<td><a class='btn btn-info' href='addTask.php?do=edit&id=" . $cat['id'] . "'>edit </a> <a class='btn btn-danger confirm' href='addTask.php?do=delete&id=" . $cat['id'] . "'>Delete </a> ";
                            if ($cat['status'] == 0) {
                                echo "<a class='btn btn-info' href='addTask.php?do=Activate&id=" . $cat['id'] . "'>activate</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a class='btn btn-primary' href='addTask.php?do=add'>Add New Task</a>
            </div>
        <?php
        } else {
        ?>
            <div class="row forHeaders">
                <div class="col-md-12">
                    <div class=" w-50 text-center m-auto">
                        <ion-icon class="iconNotFound" name="book-outline"></ion-icon>
                        <h4>Your notes is empty!</h4>
                        <a href='addTask.php?do=add' class="btn btn-info">Add New Tasks!</a>
                    </div>
                </div>
            </div>
<?php
        }
    }
} else {
    header("location:../index.php");
}
include "inc/templates/footer.php";
?>