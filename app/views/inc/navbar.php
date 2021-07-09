<nav class="navbar navbar-expand-lg navbar-dark bg-info mb-3">
  <div class="container">      
      <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
          <?php if(isLoggedIn()): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/registro/ingreso">Ingreso</a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/registro/add">Ciudadano</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/reportes/notificar">Notificar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/persona/positivo">Personas Positivo</a>
            </li>
            <?php endif ?>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">Contactenos</a>
            </li>            
          </ul>
          
          <ul class="navbar-nav ml-auto">
          <?php if(isLoggedIn()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="#"> <?php echo strtoupper($_SESSION['name']) ;?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/ccomercial/logout">Salir</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/ccomercial/register">Registrarse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/ccomercial/login">Login</a>
            </li>
          </ul>
        <?php endif ;?>

        </div>
  </div>
</nav>