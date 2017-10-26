<?php
	$id = array( 'type' => 'hidden', 'id' => 'id', 'name' => 'id', 'value'=>$token->id_user );
	$token = array( 'type' => 'hidden', 'id' => 'token', 'name' => 'token', 'value'=>$token->token );
  	$pass1 = array('type'=>'password', 'name'=>'pass1', 'id'=>'pass1','class'=>'form-control', 'placeholder' => 'Ingresar nueva contraseña', 'value'=>set_value('pass1'));
  	$pass2 = array('type'=>'password', 'name'=>'pass2', 'id'=>'pass2','class'=>'form-control', 'placeholder' => 'Confirmar nueva contraseña', 'value'=>set_value('pass2'));
  	$submit = array('type'=>'submit', 'content'=>'Modificar contraseña', 'class'=>'btn btn-success btn-block btn-flat');
?>
   <p class="login-box-msg">Cambiar contraseña</p>
    	<?= my_validation_errors($error); ?>
    	<?= my_validation_errors(validation_errors()); ?>
        <?= form_open('login/reset_pass', array('class'=>'form login-form', 'role'=>'form')); ?>
          	<?= form_input( $id ); ?>
          	<?= form_input( $token ); ?>
          <div class="form-group has-feedback">
            <?= form_input( $pass1 ); ?>
            <span class="fa fa-unlock form-control-feedback"></span>
          </div>  
          <div class="form-group has-feedback">
            <?= form_input( $pass2 ); ?>
            <span class="fa fa-unlock form-control-feedback"></span>
          </div> 
          <div class="row">
            <div class="col-xs-4">
            </div><!-- /.col -->
            <div class="col-xs-8">
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