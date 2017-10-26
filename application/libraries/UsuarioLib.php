<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarioLib {
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Model_usuarios');
		//$this->CI->load->model('model_logacceso');
	}
	public function login($username, $password) {
		//variables
		//echo $username.'+'.$password;exit();
		$query = $this->CI->Model_usuarios->get_login($username, $password);
		/*desarrollo*/
		//$query = $this->CI->model_usuarios->get_login('aaguayo@infoplan.cl', '1l2j1ndr4');
		if($query->num_rows() > 0) {

			$usuario = $query->row();
			//Ultimo ingreso
			//$ultima_sesion = $this->CI->model_logacceso->get_log_ultimo_user( $usuario->id );

			$datosSession = array(	'id' => $usuario->id,
									//'rut' => $usuario->rut,
									'firtsname' => $usuario->nombre,
									'lastname' => $usuario->apellido,
									//'cargo' => $usuario->cargo,
									//'img' => $usuario->img,
									//'email' => $usuario->email,
									//'user_type_id' => $usuario->user_type_id,
									'create_date' => $usuario->creado_fecha,
									//'ultimo_acceso' => $ultima_sesion->fecha_ingreso	
									 );
			$this->CI->session->set_userdata($datosSession);

			return TRUE;
		}else{
			log_message('error', 'Some variable did not contain a value.');
			$this->CI->session->sess_destroy();
			return FALSE;
		}
	}
    public function cambiarPWD($act, $new) {
        if($this->CI->session->userdata('id') == null) {
            return FALSE;
        }
 
        $id = $this->CI->session->userdata('id');
        $usuario = $this->CI->model_usuarios->find($id);
 
        if($usuario->password == $act) {
            $data = array('id' => $id,
                          'password' => $new);
            $this->CI->model_usuarios->update($data);
        }
        else {
            return FALSE;
        }
    }	
}