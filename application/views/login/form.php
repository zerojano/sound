<?php
  $username = array('type'=>'text','maxlength'=>'100','name'=>'username','id'=>'username','class'=>'form-control','placeholder'=>'Usuario','value'=>set_value('username'));
  $password = array('type'=>'password','maxlength'=>'20','name'=>'password','id'=>'password','class'=>'form-control','placeholder'=>'Contraseña','value'=>set_value('password'));
  /*
  $email = array('type'=>'email','maxlength'=>'100','name'=>'email','id'=>'email','class'=>'form-control','placeholder'=>'Usuario','value'=>'aaguayo@infoplan.cl');
  $password = array('type'=>'password','maxlength'=>'20','name'=>'clave','id'=>'clave','class'=>'form-control','placeholder'=>'Contraseña','value'=>'1l2j1ndr4');
  */
  $submit = array('type'=>'submit','class'=>'btn btn-lg btn-success btn-block','content'=>'Login');
?>

<?= form_open('login/ingresar', array('role'=>'form')); ?> 
  <fieldset>
    <div class="form-group">
      <?= form_input( $username ); ?>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group">
      <?= form_input( $password ); ?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>    
    <?= form_button( $submit ); ?>
  </fieldset>
<?= form_close(); ?>



 