<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_usuarios_activacion extends CI_Model {

	/**
	 * Inicializar variable con nombre de la tabla
	 * Inicializar primary_key de la tabla
	 */
	protected $table_name = 'info_usuarios_activacion';
	protected $primary_key = 'id';

	function __construct() {
		parent::__construct();
		}
	function get_activation($code) {
		$this->db->where('status', 1);
		$this->db->where('code',$code);
		return $this->db->get($this->table_name)->row();
	}
	function update($code, $status) {
		$data = array( 'status' => $status, 'edit_date' => date('Y-m-d H:i:s') );
		$this->db->where('code', $code);
		$this->db->update($this->table_name, $data);
	}
	function insert($user, $code){
        $data = array(
                'code' => $code,
				'user_id' => $user,
				'status' => 1,
				'create_date' => date('Y-m-d H:i:s'),
				'edit_date' => date('Y-m-d H:i:s')
                );
        $this->db->insert($this->table_name,$data);
	}
}

/* End of file Model_usuarios_activacion.php */
/* Location: ./application/models/Model_usuarios_activacion.php */