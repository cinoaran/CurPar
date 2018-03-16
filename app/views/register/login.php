
<?php $this->start('head');?>
<?php $this->end();?>

<?php $this->start('body');?>
<div class="col-md-6 col-md-offset-3 well">
  <form class="form" action="<?=PROOT?>register/login" method="post" accept-charset="UTF-8">
    <div class="bg-danger"><?=$this->displayErrors ;?></div>
    <h3 class="center">LOGIN</h3>
    <div class="form-group">
      <label for="username">Username
        <input type="text" name="username" id="username" class="form-control">
      </label>
    </div>
    <div class="form-group">
      <label for="password">Password
          <input type="text" name="password" id="password" class="form-control">
      </label>
    </div>
    <div class="form-group">
      <label for="remember_me">Remember Me
          <input type="checkbox" name="remember_me" id="remember_me" value="on">
      </label>
    </div>
    <div class="form-group">
      <input type="submit" value="login" class="btn btn-large btn-primary">
    </div>
    <div class="text-right">
      <a href="<?=PROOT?>register/register" class="btn btn-primary">REGISTER</a>
    </div>
  </form>
  </div>

<?php $this->end();?>
