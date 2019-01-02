<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Navbar</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
   
      <?php if (startHelp::isLoggedIn()) { ?>
    
 <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="<?php echo FULL_ROOT . '/user/test'; ?>">User Test Roles</a>
    <a class="dropdown-item" href="<?php echo FULL_ROOT . '/user/settings'; ?>">User Settings</a>
    <a class="dropdown-item" href="#">email builder tool</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
      
      <form action="<?php echo FULL_ROOT; ?>/user/logout" method="post">
        <button type="submit" data-disable-with="Logging out...">logout</button>
      </form>
    
<?php } else { ?>
            <a href="<?php echo FULL_ROOT; ?>/user/login">login</a> | 
       <a href="<?php echo FULL_ROOT; ?>/user/register">register</a>
<?php } ?>
  </div>
</nav>