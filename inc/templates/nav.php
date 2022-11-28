
<?php
session_start();
?>
    <header id="Header">
    <nav class="navHeader navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container-fluid">

            <div class="first-content">
                <a class="navbar-brand" href="index.php">
                    ToDoList <ion-icon class="forCarMargin" name="list-outline"></ion-icon> 
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="second-content collapse navbar-collapse" id="navbarSupportedContent">
               
                <ul class="navbar-nav">
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if(isset($_SESSION['username'])){ ?>
                    <li><a href="admin/dashboard.php">tasks</a></li>
                    <?php } ?>
                    <li class="active"><a href="#help">Help <i class="fa fa-question"></i></a></li>
                    <li class="dropdown"><a href="javascript:void(0)" class="dropbtn">
                            <ion-icon class="forCarMargin" name="person-outline"></ion-icon> Account <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-content">
                            <?php if(!isset($_SESSION['username'])){ ?>
                            <a href='signup.php'>
                                <ion-icon name="person-circle-outline"></ion-icon> SignUp
                            </a>
                            <a href='login.php'>
                                <ion-icon name="log-in-outline"></ion-icon> Login
                            </a>
                            <?php }else{  ?>
                            <a href='logout.php'>
                                <ion-icon name="log-out-outline"></ion-icon> LogOut
                            </a>
                           <?php } ?>
                        </div>
                    </li>
                </ul>
                <div class="links">
                    <span class="icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</header>
