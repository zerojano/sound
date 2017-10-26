<p class="login-box-msg">Activación de cuenta</p>
  <?= form_open('activation/valid', array('class'=>'form login-form', 'role'=>'form')); ?>
    <?=form_hidden('code', $code);?>
    <div class="form-group has-feedback">
			<?= form_input(array('type'=>'password', 'name'=>'new', 'id'=>'new','class'=>'form-control', 'placeholder' => 'Nueva contraseña', 'value'=>set_value('new')));?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
			<?= form_input(array('type'=>'password','name'=>'new_rep','id'=>'new_rep','class'=>'form-control','placeholder'=>'Confirmar contraseña','value'=>set_value('new_rep')));?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <?= form_button(array('type'=>'submit', 'content'=>'Activar cuenta', 'class'=>'btn btn-primary btn-blockbtn-flat')); ?>
      </div>
    </div>
  <?= form_close(); ?>
<?= my_msj_alert($this->session->flashdata('msg_tipo'), $this->session->flashdata('msg_titulo'), $this->session->flashdata('msg_texto'));?>
<?= my_validation_errors(validation_errors()); ?>