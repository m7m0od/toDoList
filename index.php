<?php
$pageTitle='Home';
include "init.php";
/*$ob = new dataConnection();
$members=$ob->threeJoin('members.*,categories.Name AS CATNAME,categories.Description AS description,subjects.Name AS SUBNAME,groups.Name AS GRONAME,groups.Date,groups.ID AS GROID','members','categories','categories.ID = members.Cat_ID','subjects','subjects.ID = members.Sub_ID','groups','groups.ID = members.gro_ID','','','ORDER BY gro_ID ASC');
*/?>

    <div class="row forHeaders">
        <div class="offset-md-1 mt-4 col-md-5 d-flex justify-content-center">
            <div class="m-auto">
                <p class="lead fs-4 fw-bold">With that psychology of a to-do list behind us, let’s take a look at the importance of a to-do list.  When you make a to-do list, It helps you: </p>
                <ul>
                    <li><h5>Acknowledge the tasks.</h5></li>
                    <li><h5>Helps you prioritize.</h5></li>
                    <li><h5>Helps block out distractions and helps focus your mind on one thing.</h5></li>
                    <li><h5>Relieves anxiety (because you don’t have to remember them).</h5></li>
                    <li><h5>Give order to unrelated tasks.</h5></li>
                    <li><h5>Serves as a record of what you have accomplished in a given time frame.</h5></li>
                </ul>
                <div class="text-center">
                    <a href="admin/addTask.php?do=add" class="btn btn-info">Record your notes</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="w-50 text-center m-auto">
                <img src="layout/uploads/checklist.png" class="w-100">
            </div>
        </div>
    </div>


<?php
include "inc/templates/footer.php";
?>