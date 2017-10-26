<?php
  $email = array('type'=>'email','name'=>'email','id'=>'email','class'=>'form-control','placeholder'=>'email','value'=>set_value('email'));
  $submit = array('type'=>'submit','content'=>'Recuperar','class'=>'btn btn-success btn-block btn-flat');
?>
<?= my_validation_errors(validation_errors()); ?>
<div class="login-box-body">
  <p class="login-box-msg">¿Haz olvidado tu contraseña?</p>
  <?= form_open('login/valid_user', array('class'=>'form login-form', 'role'=>'form')); ?>
    <div class="form-group has-feedback">
      <?= form_input( $email ); ?>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>  
    <div class="row" align="center" style="margin: 10px 0px 10px 0px;">
      <div class="g-recaptcha" data-sitekey="6LedoyQTAAAAAIrMVJWve2C9JHQahFtG66cnGNh9"></div>  
    </div>
    <div class="row">
      <div class="col-xs-6">
        <a href="<?=base_url('login')?>">Iniciar sesión</a>
      </div><!-- /.col -->          
      <div class="col-xs-6">
        <?= form_button( $submit ); ?>
      </div><!-- /.col -->
      <div class="form-actions">
      </div>
    </div><!--.row-->
  <?= form_close(); ?>
</div><br><!-- /.login-box-body -->
<?php 
  echo my_msj_alert($this->session->flashdata('msg_tipo'), $this->session->flashdata('msg_titulo'), $this->session->flashdata('msg_texto'));
?>