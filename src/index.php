<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <title>Log in</title>

  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">


  <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
  <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" type="text/css" rel="stylesheet">




  <style type="text/css">
    html,body {
      height:100%;
    }

    h1 {
      font-family: Arial,sans-serif
      font-size:80px;
      color:#DDCCEE;
    }

    .lead {
     color:#DDCCEE;
   }


   /* Custom container */
   .container-full {
    margin: 0 auto;
    width: 100%;
    min-height:100%;
    background-color:#110022;
    color:#eee;
    overflow:hidden;
  }

  .container-full a {
    color:#efefef;
    text-decoration:none;
  }

  .v-center {
    margin-top:7%;
  }
  
</style>
</head>



<body  >
 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">

    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Home</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="hidden">
          <a href="#page-top"></a>
        </li>

        <li>
          <a class="page-scroll" href="sign_up_page.php">Sign up today</a> 
        </li>

        <li class="page-scroll">
          <a href="index.php">Log in</a>
        </li>
      </ul>
    </div>

  </div>

</nav>

<div class="container-full">
  <form name="form2" class="form-signin" method="post" action="connect.php" onsubmit="return checkSignIn(form2);">


    <div class="row">

      <div class="col-lg-12 text-center v-center">
      <?php if(isset($_GET['WM'])) echo "<div>"."Registration successful, welcome to askaround!"."</div>";
       ?>
       <hr>
       <?php
       if(isset($_GET['RC'])) {
        echo "<div class=\"alert alert-error\">"."You are deconnected please reconnect !"."</div>" ;
      }
      ?>
      <h1>Welcome to Askaround</h1><br><br>
      <p class="lead"><h3>Please log in </h3></p>

      <br><br><br>

      <form class="col-lg-12">
        <div class="form-group" style="width:340px;text-align:center;margin:0 auto;">
          <input class="form-control input-lg" name="Email"  title="Don't worry. We hate spam, and will not share your email with anyone." placeholder="Enter your email address" type="text">
          <span class="input-group-btn"></span>
        </div><br>
        <div class="form-group" style="width:340px;text-align:center;margin:0 auto;">
          <input class="form-control input-lg" name="Password" title="Don't worry. We hate spam, and will not share your email with anyone." placeholder="Enter your password" type="password">
          <span class="input-group-btn"></span>
          <?php if(isset($_GET['WP']))
          echo "<div class=\"alert alert-error\">"."<h4>Error :</h4>"." Wrong Email or Password ! try again"."</div>" ;
          ?>

        </div><br>
        <div class="input-group" style="width:340px;text-align:center;margin:0 auto;">
          <button class="btn btn-lg btn-primary" type="submit">Log me in !</button></span>

        </div>
      </form>
    </div>

  </div> <!-- /row -->

  <div class="row">

    <div class="col-lg-12 text-center v-center" style="font-size:39pt;">
      <h4>Click on the picture to sign up </h4><a href="Sign_up_page.php"><i class="icon-github"></i> </a> <br>

    </div>

  </div>

  <br><br><br><br><br>





  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


  <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>


</body>
</html>