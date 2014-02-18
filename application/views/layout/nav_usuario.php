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
              <a class="navbar-brand" href="#">PEN | USUARIO</a>
            </div>

            <div class="navbar-collapse collapse">              
              <ul class="nav navbar-nav">
                <li class="active"><a href="/">Inicio</a></li>
                <li><a href="/adm_variable/index">Variables</a></li>              
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
                  <li><a href="#"><?php echo $user['nombre'] ." ". $user['apellido']; ?></a></li>  
                  <li class="active"><a href="/auth/salir">Salir</a></li>
              </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>