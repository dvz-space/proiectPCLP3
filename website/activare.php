<?php
require('db_connect.php');
session_start();
if (isset($_POST['email']) && isset($_POST['key']))
{
    $email= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $key= filter_var($_POST['key'],FILTER_SANITIZE_NUMBER_INT);
    $query="SELECT * FROM `users` WHERE `email` = '$email' AND `key` = '$key'";
    $result=mysqli_query($connection, $query);
    
    if($result->num_rows==1)
    {
       $query = "UPDATE `users` SET `active` = '1' WHERE `users`.`email` = '$email'";
       $result=mysqli_query($connection, $query);
       $msg="Cont activat cu succes";
        
    }
    else 
    {
        $msg="Eroare la activare";
    }
    
}

 ?>








<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Unitbv.ro</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   <!-- Navigation -->
     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HomePage</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if(isset($_SESSION['username'])){  ?> <li><a href="comanda.php">Comanda acum</a></li><?php } ?>
                    <?php if(isset($_SESSION['username'])){  ?> <li><a href="comenzile_mele.php">Comaenzi active</a></li><?php } ?>
                    <?php if(!isset($_SESSION['username'])){  ?> <li><a href="login.php">Log in</a><?php } ?>
                    <?php if(isset($_SESSION['username'])){  ?><?php } ?>
                    <?php if(!isset($_SESSION['username'])){  ?> <li><a href="register.php">Inregistrare</a><?php } ?>
                    <?php if(!isset($_SESSION['username'])){  ?> <li><a href="activare.php">Activare cont</a><?php } ?>
                    <li><a href="about.php">Contact</a></li>
                    <li><?php if(isset($_SESSION['username'])){  ?><div style="margin-top: 5%" class="list-group-item" > <?php echo $_SESSION['username']; ?> </div><?php } ?></li>
                    <li><?php if(isset($_SESSION['username'])){  ?><div style="margin-top: 10%" class="list-group-item" > <form method="POST" action="logout.php" ><button type="submit"> Log out</button></form> </div><?php } ?></li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h3  class="header">Pentru a activa contul introduceti mailul institutional si codul trimis pe mailul institutional</h3>     

                <div class="container ">
    
 
     <div class="text-center ">
      <form class="form-signin form-horizontal" method="POST">
        
        <div class="form-group">
        <div class="col-sm-4">
        <label for="inputEmail" >Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div> 
        </div>
          
        <div class="form-group">
        <div class="col-sm-4">
        <label for="inputPassword">Cod de activare</label>
        <input type="text" name="key" id="key" class="form-control" placeholder="key" >
        </div>
        </div>
          
          
          <div class="form-group">
              <div class="col-sm-4">
        <button class="btn btn-lg btn-primary btn-block" type="submit" >Activare</button>
              </div>
          </div>
      </form>
         <?php if(isset($msg)){ ?><div class="alert alert-success" role="alert"> <?php echo $msg; ?> </div><?php } ?>
     </div>

</div>
      
            </div>
        </div>

    </div>

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>