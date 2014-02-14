<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../public/ico/favicon.ico">
    <title><?php echo $titulo ?></title>
    <link href="../../public/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../public/css/style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>  
  <body>
    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PEN</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Inicio</a></li>
              <li><a href="#">Variables</a></li>              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Objetivos <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Lista de Objetivos</li> 
                  <li><a href="#">objetivo 1</a></li>
                  <li><a href="#">objetivo 1</a></li>
                  <li><a href="#">objetivo 1</a></li>                  
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="./">-</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      
      <div> here content!..  <?php echo $content_for_layout; ?></div>

    </div> <!-- /container -->
    <script src="../../public/js/vendor/jquery/jquery-1.11.0.js"></script>
    <script src="../../public/dist/js/bootstrap.min.js"></script>
  </body>
</html>
