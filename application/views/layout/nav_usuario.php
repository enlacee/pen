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
              <a class="navbar-brand" href="/">PEN | USUARIO</a>
            </div>

            <div class="navbar-collapse collapse"><?php //var_dump($user_objetivo);?>              
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Objetivos <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-header">Lista de Objetivos</li>
                    <?php foreach ($user_objetivo as $key => $value): ?>
                    <li><div class="col-sm-12"><a href="/usuario/objetivo/<?php echo $value['id_objetivo'] ?>" alt="<?php echo $value['titulo'] ?>"><?php echo $value['titulo'] ?></a></div></li>
                    <?php endforeach; ?>                    
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