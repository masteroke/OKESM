<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_model {


    function __construct(){
        // Call the Model constructor
        parent::__construct();        

    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tr_import_data');
    }
    
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $update = $this->db->update('tr_import_data', $data);
        return $update;
    }
    
    public function save_custom_data($data)
    {
       $string = array(
            'id'        =>$data['id'],
            'fieldname' =>$data['fieldname'],
            'value'     =>$data['value']
        );
        
        $q = $this->db->insert_string('tr_import_data', $string); 
                    
        $this->db->query($q);
        
        return $this->db->insert_id();        
    }
    
    public function save_default_data($data)
    {
       $string = array(
            'id'                    =>$data['id'],
            'user'                  =>$data['user'],
            'name'                  =>$data['name'],
            'ordernumber'           =>$data['ordernumber'],
            'orderdate'             =>$data['orderdate'],
            'receiveddaysafter'     =>$data['receiveddaysafter'],
            'emailofseller'         =>$data['emailofseller'],
            'nameofseller'          =>$data['nameofseller'],
            'secondnameofseller'    =>$data['secondnameofseller'],
            'product_sku'           =>$data['product_sku'],
            'productname'           =>$data['productname'],
            'producturl'            =>$data['producturl'],
            'product_gtin'          =>$data['product_gtin'],
            'attr_1'                =>$data['attr_1'],
            'attr_2'                =>$data['attr_2'],
            'attr_3'                =>$data['attr_3'],
            'attr_4'                =>$data['attr_4'],
            'attr_5'                =>$data['attr_5'],
            'attr_6'                =>$data['attr_6']
        );
        
        $q = $this->db->insert_string('tr_import_data_fields', $string); 
                    
        $this->db->query($q);
        
        return $this->db->insert_id();        
    }
    
}