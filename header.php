<?php
session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/fonts/font-awesome.min.css">
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="index.php">IsangeShop.com </a></div>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="nav navbar-nav navbar-right">
                    <li class="" role="presentation"><a href="index.php#home">HOME <span class="glyphicon glyphicon-home"></span></a></li>
                    <?php

                        if(isset($_SESSION['user'])){
                    ?>
                    <li role="presentation"><a href="cart.php">CART <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                     <li role="presentation"><a href="profile.php">PROFILE <i class="fa fa-user"></i></a></li>
                    <?php
                        }
                    ?>
                    

                   
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">7X24 SUPPORT <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Tel:(250) 726176476</a></li>
                            <li><a href="#">City: Gisenyi,Rubavu,Rw</a></li>
                            <li><a href="#">E-mail: niyobuhungiro.yves@gmail.com</a></li>
                            <li><a href="about.php">About Us</a></li>
                        </ul>
                    </li>
                    <li role="presentation">
                        <a href="#"> </a>
                    </li>
                    <?php
                    if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
                        echo '<li role="presentation"><a href="login.php">LOGIN <span class="fa fa-sign-in"></span></a></li>';
                    }else{
                        echo '<li role="presentation"><a href="logout.php" class="btn btn-link">LOGOUT <span class="fa fa-sign-out"></span></a></li>';
                    }

                    ?>
                   
                    
                </ul>
            </div>
        </div>
    </nav>