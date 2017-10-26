<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->library('Session');
		$this->load->library('usuarioLib');
		//$this->load->library('template_email_lib');
		//$this->load->helper('string');
		//$this->load->helper('captcha');
		$this->load->model('Model_usuarios');
		//$this->load->model('model_logacceso');
		//$this->load->model('model_captcha');
		//$this->load->model('model_reset_password');
		//$this->rand = random_string('alnum', 6);
		$this->form_validation->set_message('loginok', 'Usuario o Contraseña incorrecta.');
	}
	public function index(){
		if( $this->session->userdata('id') ){
			redirect('home');
		}else{
			$data['titulo'] = 'Sys Sound';
			$data['contenido'] = 'login/form';
			$this->load->view('template-login', $data);
		}
	}
	/*USUARIO LOGIN*/
	public function ingreso() {
		$data['contenido'] = 'manager/ingreso';
		$data['titulo'] = 'Ingreso';
		$this->load->view('template-login', $data);
	}
	public function loginok(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		//ar_dump($username);exit;
		return $this->usuariolib->login($username,$password);
	}
	public function ingresar(){	 

		$this->form_validation->set_rules('username', 'Usuario', 'required|callback_loginok');
		$this->form_validation->set_rules('password', 'Clave', 'required');

		//$this->usuariolib->set_rules_ingresar();
		if($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			/* Información de nagegación */
			/*$this->load->library('user_agent');
			if ($this->agent->is_browser()){
			    $agent = $this->agent->browser().' '.$this->agent->version();
			}
			if ($this->agent->is_mobile()){
    			$dispositivo = $this->agent->mobile();
			}else{
				$dispositivo = 'Escritorio';
			}*/

			//$this->model_logacceso->insert($this->agent->platform(),$agent, $this->agent->browser(), $dispositivo);
			redirect(base_url('home'));
		}
	}	
	public function salir(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	/**** Recuperando contraseña ****/
	/*public function recuperar(){
		$data['titulo'] = 'Recordar contraseña MyAPP';
		$data['contenido'] = 'login/recuperar';
		$this->load->view('template-login', $data);
	}
	public function valid_user(){
		$this->form_validation->set_rules('email', 'Mail', 'required');
		$email=$this->input->post('email');
		//$find_email = $this->model_usuarios->find_email( $email );
		$usuario = $this->model_usuarios->find_user( $email );
		//En caso que existe un registro anterior se elimina
		$this->model_reset_password->delete_user( $usuario->id );
		//var_dump($token);exit;
		if ( $usuario  <> NULL ) 
		{
			$token = sha1(uniqid());

			$this->model_reset_password->insert( $usuario->id, $token);
			
			$this->send_email_reset($email, $token);

			$this->session->set_flashdata('msg_tipo', 'success');
			$this->session->set_flashdata('msg_texto', '<strong>¡Email enviado!</strong> En algunos minutos te enviaremos un email, con link para que puedas reestablecer tu contraseña');

			redirect('login/recuperar');
		}
		else
		{
			//echo 'no existe';
			$this->session->set_flashdata('msg_tipo', 'danger');
			$this->session->set_flashdata('msg_texto', '<strong>¡Email no valido!</strong> El email ingresado no es valido o no se encuentra registrado en el sistema.');

			redirect('login/recuperar');
		}

	}

	public function send_email_reset($email, $token){
		$this->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "mail.infoplan.cl";
		$config['smtp_port'] = 25;
		$config['smtp_user'] = $this->config->item('email_user'); 
		$config['smtp_pass'] = $this->config->item('email_pass'); 
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$this->email->initialize($config);		

		$this->email->from('contacto@infoplan.cl', 'Sistema Forestal');
		$this->email->to( $email ); 

		$this->email->subject('Reestablecer Clave Sistema Forestal');

        //$this->email->message( $this->template_email_lib->email_wrapper($email,$token) );

		$usuario = $this->model_usuarios->find_user( $email );

		$title = 'Sistema Forestal';
		$t_email = 'SISTEMA';
		$t_sub_email = 'Gestión Forestal';
		$saludo = 'Hola '.$usuario->nombre;
		$content_uno = 'Haz solicitado un cambio de contraseña, para poder ingresar al Sistema Gestión Forestal.';
		$content_dos = 'Selecciona Cambiar clave, si no puedes copia y pega en tu navegador el siguiente link: '.base_url().'login/formreset/'.$token;
		$content_tres = '<a href="'.base_url().'login/formreset/'.$token.'">Cambiar clave</a>';
		$content_footer  = '® '.$data = date('Y').' - Sistema desarrollado por <a href="http://www.infoplan.cl">'.$this->config->item('titleweb').'</a><br>';

		$contenido = $this->template_email_lib->email_template($type = 1, $title, $t_email, $t_sub_email, $saludo, $content_uno, $content_dos, $content_tres, $content_footer);

		$this->email->message( $contenido );

		$this->email->send();

		echo $this->email->print_debugger();
	}

	public function formreset($token, $error = '')
	{
		$data['token'] = $this->model_reset_password->find( $token );
		//var_dump($data);exit;
		if ( $data['token'] <> NULL) {
			$data['error'] = $error;
			$data['titulo'] = 'Cambiar contraseña';
			$data['contenido'] = 'login/formreset';
			$this->load->view('template-login', $data);
		}else{
			echo 'error de acceso, el link no existe.';
		}
	}
	public function reset_pass()
	{
		$this->form_validation->set_rules('pass1', 'Contraseña', 'required|min_length[6]');
		//$this->form_validation->set_message('matches', 'Las contraseñas no son iguales');
		
		$id = $this->input->post('id');
		$token = $this->input->post('token');
		$pass1 = $this->input->post('pass1');
		$pass2 = $this->input->post('pass2');

		if ($this->form_validation->run() == FALSE)
		{
			$this->formreset( $token );
		}
		else
		{
			$this->model_usuarios->update_pass( $id, md5($pass1) );
			$this->model_reset_password->delete( $token);

			$this->session->set_flashdata('msg_tipo', 'success');
			$this->session->set_flashdata('msg_texto', '<strong>¡Cambio exitoso!</strong> Has cambiado tu contraseña.');

			redirect('login/index');	
		}
	}	
	public function test(){
		//$this->form_validation->set_rules('email', 'Mail', 'required');

		$email='aaguayo@infoplan.cl';

		//$find_email = $this->model_usuarios->find_email($email);

		//if ($find_email <> '') {
			//echo 'existe';

			$this->load->library('email');
			
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = "aaguayonitrigual@gmail.com"; 
			$config['smtp_pass'] = "";
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";

			$this->email->initialize($config);		

			$this->email->from('aaguayonitrigual@gmail.com', 'Test');
			$this->email->to( $email ); 
			//$this->email->cc('otro@otro-ejemplo.com'); 
			//$this->email->bcc('ellos@su-ejemplo.com'); 

			$this->email->subject('Reestablecer Clave MyAPP');
			$this->email->message('
				<table>
					<tr background="green">
						<td>
							<h2>Recuperación de contraseña MyADPP | FdelosRíos Ltda.</h2>
						</td>
						<td>

							<a href="http://infoplan.no-ip.org/forestal/repurar/'.uniqid().'">Link recuperación contraseña</a>
							
						</td>
					</tr>
				</table>
				');	

			$this->email->send();

			echo $this->email->print_debugger();
			$this->session->set_flashdata('msg_tipo', 'success');
			$this->session->set_flashdata('msg_texto', '<strong>¡Email enviado!</strong> En algunos minutos te enviaremos un email, con link para que puedas reestablecer tu contraseña');

			//redirect('login/recuperar');

	}
    public function captcha(){
		//configuramos el captcha
		$conf_captcha = array(
			'word'   => $this->rand,
			'img_path' => '.public/captcha/',
			'img_url' =>  base_url().'login/captcha/',
            //fuente utilizada por mi, poner la que tengáis
			'font_path' => '.public/fonts/AlfaSlabOne-Regular.ttf',
			'img_width' => '250',
			'img_height' => '60', 
			//decimos que pasados 10 minutos elimine todas las imágenes
			//que sobrepasen ese tiempo
			'expiration' => 600 
		);
 
		//guardamos la info del captcha en $cap
		$cap = create_captcha($conf_captcha);
 
		//pasamos la info del captcha al modelo para 
		//insertarlo en la base de datos
		$this->model_captcha->insert_captcha($cap);
		
		//devolvemos el captcha para utilizarlo en la vista
		return $cap;
	}
	//comprobamos si la sessión que hemos creado es igual que el captcha introducido
	//con una función callback
	public function validate_captcha()
	{
 
	    if($this->input->post('captcha') != $this->session->userdata('captcha'))
	    {
	        $this->form_validation->set_message('validate_captcha', 'Error');
	        return false;
	    }else{
	        return true;
	    }
 
	}
	*/
}
