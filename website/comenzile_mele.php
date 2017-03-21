<?php
    require('db_connect.php');
    session_start();
    $user=$_SESSION['username'];
    
    $SQL_COMANDA="SELECT `comanda` FROM `comenzi_personale` WHERE `email` = '".$user."' ORDER BY `ora_plasare` DESC";
    $SQL_ORA="SELECT `ora_plasare` FROM `comenzi_personale` WHERE `email` = '".$user."' ORDER BY `ora_plasare` DESC";
    $SQL_RESPONSE_COMANDA=mysqli_query($connection,$SQL_COMANDA);
    $SQL_RESPONSE_ORA=mysqli_query($connection,$SQL_ORA);
    if(($SQL_RESPONSE_ORA -> num_rows > 0))
    {   $orele=[];
       while($row = $SQL_RESPONSE_ORA -> fetch_assoc())
       {   
           array_push($orele, date('M j Y g:i A', strtotime($row['ora_plasare'])));
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
    <script src="http://www.w3schools.com/lib/w3data.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {padding-top: 70px;}
    ul { list-style: none; }
    </style>


</head>

<body>

   <!-- Navigation -->
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
     <?php
     if(($SQL_RESPONSE_COMANDA -> num_rows > 0))
     {  $temp=0;
         echo "<p>Exista comenzi</p>";
         while($row = $SQL_RESPONSE_COMANDA -> fetch_assoc())
         {  
             $comanda= str_replace("&&&", "<br>", $row['comanda']);
             echo "<h4>".$orele[$temp]."</h4>";
             echo "<p>".$comanda."</p>";
             $temp+=1;
         }
     }
     else
     {
         echo "<p>Nu exista Comenzi</p>";
     }
     
     
     
     
     ?>
    </div>
    
    
   
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>