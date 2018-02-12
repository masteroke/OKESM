<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EuroMap_model extends CI_model {

    function __construct()
    {
        parent::__construct();      // Contructor for the model
    }
    
    /** Function for showing all parameter meta data getting by actual machine's request **/
    public function select_param_data_mapping_act(){
        $query = $this->db->query("SELECT * FROM `SM_VIEW_PARAM_ACT` A LEFT JOIN `SM_PARAM_MAP_EUROMAP63` B 
        ON A.`RequestVar` = B.`RequestVar` AND A.`Controller` = B.`Controller` WHERE B.`RequestVar` IS NOT NULL")->result();
        return $query;
    }
    
    /** Function to truncate current parameter data requested from single machine  **/ 
    public function truncate_param_act($id){
        // machine id is required
        if (empty($id)){
            return FALSE;
        }           
        $this->db->delete('SM_VIEW_PARAM_ACT', array('id' => $id));   
    }
    
    /** Function for actual parameter table insertion **/  
    public function insert_param_act($array){
        $query = $this->db->insert('SM_VIEW_PARAM_ACT',$array);
        $id = $this->db->insert_id();
        return $id;
    }
}
