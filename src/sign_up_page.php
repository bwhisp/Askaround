<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <title>Sign up</title>

  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">


  <link rel="shortcut icon" href="dist/img/favicon.ico">
  <link rel="apple-touch-icon" href="dist/img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="dist/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="dist/img/apple-touch-icon-114x114.png">
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



<body >
 <!-- Barre de navigation -->
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

  <div class="row">

    <div class="col-lg-12 text-center v-center">

      <h1>Welcome to Askaround</h1><br><br><br>
      <p class="lead"><h3>Registration </h3></p>

      <br><br><br>

      <form name ="myform" class="form-signin" method="post" action="ajouter_membres.php" onsubmit="return checkForm(myform);" >

        <div class="row">
          <div class="form-group" style="width:340px;text-align:center;margin:0 auto;">
            <label for="email">E-mail</label>
            <input class="form-control input-lg" name="email" title="Email" placeholder="jean.dupont@example.com" type="email">

          </div><br>
        </div>

        <div class="row">
          <div class="form-group" style="width:340px;text-align:center;margin:0 auto;">
           <label for="password">Password</label>
           <input class="form-control input-lg" name="password" title="Password" placeholder="It should contain at least one uppercase, one lowercase and one number" type="password">
           <div id="alert2">
           </div>

         </div><br>
       </div>
       <div class="row">
         <div class="form-group" style="width:340px;text-align:center;margin:0 auto;">
          <label for="password">Password</label>  
          <input class="form-control input-lg" name="password" title="Password check" placeholder="Re-enter it, no copy-paste allowed" type="password">

        </div><br>
      </div>
      <div class="row">
        <div class="form-group" style="width:340px;text-align:center;margin:0 auto;">

          <label for="username">Username</label>
          <input class="form-control input-lg" name="username" title="Username" placeholder="It can contain letters, numbers and underscores only" type="text">
          <div id="alert3">
          </div>
          <span class="input-group-btn"></span>
        </div><br>

        <div class="row">
          <input name="add_new" type="hidden">          
          <?php if (isset($_GET['AI'])) { echo "<div class=\"alert alert-error\" style=\"text-align: left\">"."<strong>Error: </strong>This email already exists in database !"."</div>";}?> 
            <br>

            <div class="row">
              <div class="form-group col-xs-12" style="width:340px;text-align:center;margin:0 auto;">
                <button class="btn btn-lg btn-primary" type="submit" name ="ajouter_membre">Submit</button>
              </div>
            </div>
          </form>
        </div>

      </div> 

    </div>


    <br><br><br><br><br>

    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>






  </body>
  </html>