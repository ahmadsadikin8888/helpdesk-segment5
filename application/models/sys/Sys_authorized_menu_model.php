<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_authorized_menu_model extends CI_Model
{

    public $table 		= 'sys_authorized_menu';
	public $table_menu 	= 'sys_menu';
    public $id = 'id';
	public $idlevel = 'id_level';
    public $order = 'DESC';
	
	private $id_super_admin = 1;
	private $show = 1;
	private $active = 1;
	private $nonactive=0;
	private $hide = 0;

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
		$afield=array(
		 $this->table.'.id',
		 $this->table.'.id_level',
		 $this->table.'.id_menu',
		);
	$this->db->select($afield);
	$this->db->order_by($this->table.'.'.$this->id, $this->order);
     return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
		$afield=array(
		 $this->table.'.'.'id',
		 $this->table.'.'.'id_level',
		 $this->table.'.'.'id_menu',
		);
	$this->db->select($afield);
	$this->db->where($this->table.'.'.$this->id, $id);
    return $this->db->get($this->table)->row();
    }
	
	
	function get_by_idlevel($idlevel)
    {
		$afield=array(
		 $this->table.'.id',
		 $this->table.'.id_level',
		 $this->table.'.id_menu',
		);
		$this->db->select($afield);
		$this->db->where($this->table.'.'.$this->idlevel, $idlevel);
		return $this->db->get($this->table)->row();
    }
	
	function get_all_by_idlevel($idlevel){
		$afield=array(
		 $this->table.'.id',
		 $this->table.'.id_level',
		 $this->table.'.id_menu',
		);
		$this->db->select($afield);
		$this->db->where($this->table.'.'.$this->idlevel, $idlevel);
		return $this->db->get($this->table)->result_array();
    }

	function get_parent_by_idlevel($idlevel){
		$afield=array(
			 $this->table.'.id_level',
			 $this->table.'.id_menu',
			 $this->table_menu.'.name',
			 $this->table_menu.'.icon',
			 'sys_form.link',
		);
		$this->db->select($afield);
		
		$this->db->where('sys_menu.is_parent','0');
		$this->db->where('sys_authorized_menu.id_level',$idlevel);
		$this->db->join('sys_menu','sys_menu.id=sys_authorized_menu.id_menu','left');
		$this->db->join('sys_form','sys_form.id=sys_menu.id_form','left');
		$this->db->order_by('sys_menu.id', "ASC");
		return $this->db->get($this->table)->result_array();
	}
	

	
	function get_child_by_idmenu($idmenu,$idlevel){
		$afield=array(
			 $this->table.'.id_level',
			 $this->table.'.id_menu',
			 $this->table_menu.'.name',
			 'sys_form.link',
			 $this->table_menu.'.icon',
			 $this->table_menu.'.is_parent',
		);
		$this->db->select($afield);
		
		$this->db->where('sys_authorized_menu.id_level',$idlevel);
		$this->db->where('sys_menu.is_parent =',$idmenu);
		$this->db->join('sys_menu','sys_menu.id=sys_authorized_menu.id_menu','left');
		$this->db->join('sys_form','sys_form.id=sys_menu.id_form','left');
		$this->db->order_by('sys_menu.name', "ASC");
		return $this->db->get($this->table)->result_array();
	}
	
	
	
	function is_valid_auth_link($idlevel,$idmenu)
    {
		$condition=array(
		 $this->table.'.'.'id_level'=>$idlevel,
		 $this->table.'.'.'id_menu'=>$idmenu,
		);
		
		$this->db->select('id');
		$data= $this->db->get_where($this->table,$condition,1)->row();
    
		if($data==NULL){
			return 'false';
		}else{
			return 'true';
		}
	
	}
	
	
    
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

	// delete multiple data
	function delete_multiple($data){
		if(!empty($data)){
				$this->db->where_in($this->id,$data);
				$this->db->delete($this->table);
		}		
	}
	
	function delete_multiple_bylevel($data){
		if(!empty($data)){
				$this->db->where_in('id_level',$data);
				//BLOCK DELETE SUPER ADMIN
				$this->db->where_not_in('id_level',$this->id_super_admin);
				$this->db->delete($this->table);
		}		
	}	
}

/* End of file Sys_authorized_model.php */
/* Location: ./application/models/Sys_authorized_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-15 05:08:36 */
/* http://harviacode.com */