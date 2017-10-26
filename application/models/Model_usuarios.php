<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usuarios extends CI_Model {

	protected $table_name = 'users';
	protected $primary_key = 'id';
 
	function __construct() {
		parent::__construct();
		}
	 
	/*function all() {
		$this->db->order_by("id", "desc"); 
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	function get_all( $fields='', $where, $order_by='', $limit ){
        if ($fields != '') { $this->db->select($fields); }
		if (count($where)) { $this->db->where($where); }
		if ($limit != '') 	{ $this->db->limit($limit); }
        if ($order_by != '') { $this->db->order_by($order_by); }
		$query = $this->db->get( $this->table_name );
		return $query->result();
	}*/	
	function find($id) {
		$this->db->where($this->primary_key, $id);
		return $this->db->get($this->table_name)->row();
	}
	/*function find_email($email) {
        $this->db->where('email',$email);
        $query = $this->db->get($this->table_name);
		if($query->num_rows() == 1)
		{
	        $row = $query->row();
	        return $row->email;
		}
	}*/
	/*
	function update_password_activation( $user_id, $new_pass ){
		$data = array( 
			'password' => md5( $new_pass ),
			'user_status_id' => 2
			);
		$this->db->where($this->primary_key, $user_id );
		$this->db->update($this->table_name, $data);	
	}	
    function insert($rut, $nombres, $apellidos, $email, $telefono, $direccion, /$user_type_id, $cargo)
    {
        $data = array(
                'rut' => $rut,
                'nombre' => $nombres,
                'apellido' => $apellidos,
				'email' => $email,
				'telefono' => $telefono,
				'direccion' => $direccion,
				'password' => md5(date('Y-m-d H:i:s')),
				'img' => 'default/user_1.png',
				'user_type_id' => $user_type_id,
				'user_status_id' => 1,
				'cargo' => $cargo,
				'token' => '',
				'create_date' => date('Y-m-d H:i:s'),
				'edit_date' => date('Y-m-d H:i:s')
                );
        $this->db->insert($this->table_name, $data);
    }
	function verifica_rut($rut) {
        $this->db->where('rut',$rut);
        $query = $this->db->get($this->table_name);
		if($query->num_rows() == 1)
		{
	        $row = $query->row();
	        return $row->rut;
		}
    }
	function update($registro) {
		$data = array( 
			'nombre' => $registro['nombre'],
			'apellido' => $registro['apellido'],
			'telefono' => $registro['telefono'],
			'direccion' => $registro['direccion'],
			'cargo' => $registro['cargo'],
			'user_type_id' => $registro['tipo']
			);
		$this->db->where($this->primary_key, $registro['id']);
		$this->db->update($this->table_name, $data);
	}
	function update_perfil($registro) {
		$data = array( 
			'nombre' => ucfirst(strtolower($registro['nombre'])),
			'apellido' => ucfirst(strtolower($registro['apellido'])),
			'telefono' => $registro['telefono'],
			'direccion' => ucfirst(strtolower($registro['direccion'])),
			'cargo' => ucfirst(strtolower($registro['cargo']))
			);
		$this->db->where($this->primary_key, $this->session->userdata('id'));
		$this->db->update($this->table_name, $data);
	}     
	function delete($id) {
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table_name);
	} 
	*/
	function get_login($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', md5 ( $password ));
		//$this->db->where('user_status_id = 2');
		return $this->db->get($this->table_name);
	}
	/*
	function estado($usuario,$estado) {
		if ($estado == 2) {
			$estado = 3;
		}else{
			$estado = 2;
		}
		$data = array(
			'user_status_id' => $estado
			);
		//$this->db->set('user_status_id',$estado);
		$this->db->where($this->primary_key, $usuario);
		$this->db->update($this->table_name, $data);
	}
    function verifica_email($email) {
        $this->db->where('email',$email);
        $consulta = $this->db->get($this->table_name);
		if($consulta->num_rows() == 1)
		{
	        $row = $consulta->row();
	        return $row->email;
		}
    }
	function find_user( $email )
	{
		$this->db->where('email', $email);
		return $this->db->get($this->table_name)->row();
	}
	function get_password( $password ) {

		$this->db->where($this->primary_key, $this->session->userdata('id') );
        $this->db->where('password',md5($password));
        $query = $this->db->get($this->table_name);
		if($query->num_rows() == 1)
		{
	        $row = $query->row();
	        //echo $row;exit;
	        return $row->id;
		}
	}    
    function update_pass( $usuario, $clavenueva ){
		$data = array( 'password' => $clavenueva );
		$this->db->where('id', $usuario );
		$this->db->update($this->table_name, $data);
    }
    function get_count_all($operador, $tipo){
		$this->db->where('user_status_id'.$operador,$tipo);
		return $this->db->count_all_results($this->table_name); 
    }
    function update_img( $imagen ){
		$data = array( 'img' => $imagen );
		$this->db->where($this->primary_key, $this->session->userdata('id') );
		$this->db->update($this->table_name, $data);
    }
    */  
}