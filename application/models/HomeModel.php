<?php 
class HomeModel extends CI_Model{
   public function __construct(){
       parent::__construct();
       $this->load->database();
       }
    
    public function home(){
       $data=$this->db->get('events')->result_array();

       return $data;
    }


    }
?>