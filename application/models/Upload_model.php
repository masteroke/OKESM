<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_model {

    function __construct()
    {
        parent::__construct();		// Contructor for the model
    }
    
    /** Function for import data table insertion **/  
    public function insert_import_data($array){    
        $max = $this->import_files_last();
        $array['upload_id'] = (int)$max;        
        $query = $this->db->insert('tr_import_data_fields',$array);
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function delete_import_data($upload_id){
        
        // upload id is required
        if (empty($upload_id))
        {
            return FALSE;
        }
                      
        $this->db->delete('tr_import_data_fields', array('upload_id' => $upload_id));  // Produces: // DELETE FROM mytable  // WHERE id = $id 
        
        return TRUE;
    }
    
    /** Function for upload files table insertion **/  
    public function insert_import_file($array){
        $array['upload_id'] = $this->import_files_uploads();
        $query = $this->db->insert('tr_import_files',$array);
        $id = $this->db->insert_id();
        return $id;
    }
    
    /** Function for upload files table insertion **/  
    public function delete_import_file($upload_id){
        $this->db->trans_begin();
        
        $this->delete_import_data($upload_id);
        
        $this->db->delete('tr_import_files', array('upload_id' => $upload_id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->set_error('delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();
        
        return TRUE;
    }

	/** Function for order table insertion **/	
	public function insert_order($array){
		$query = $this->db->insert('tr_import_data_fields',$array);
		$id = $this->db->insert_id();
		return $id;
	}
	
	/** public function for customer table insertion **/
	public function insert_customer($array){	
		$query = $this->db->insert('customer',$array);
		return $query;
	}
	
	/** Function for item table insertion **/
	public function insert_item($array){
		$query = $this->db->insert('order_items',$array);
		return $query;
	}
	
	/** Function for product table insertion **/
	public function insert_product($array){
		$query = $this->db->insert('product',$array);
		return $query;
	}
    
    /** Function for fetching entire data from order table **/
    public function fetch_last_import($limit,$offset){
        $this->db->limit($offset,$limit);
        $last_upload_id = $this->import_files_last();
        $this->db->where('upload_id', $last_upload_id);
        $this->db->order_by('ordernumber','desc');  // Order by id desc which brings the latest record to the first column of table
        $query = $this->db->get('tr_import_data_fields');

        return $query;
    }
	
	/** Function for fetching entire data from order table **/
	public function fetch_all($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by('ordernumber','desc');	// Order by id desc which brings the latest record to the first column of table
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on ID ascending **/
	public function id_asc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("ordernumber", "asc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on ID descending **/
	public function id_desc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("ordernumber", "desc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on First Name ascending **/
	public function fname_asc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("nameofseller", "asc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on First name descending **/
	public function fname_desc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("nameofseller", "desc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on Last Name ascending **/
	public function lname_asc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("secondnameofseller", "asc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on Last Name descending **/
	public function lname_desc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("secondnameofseller", "desc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on Country ascending **/
	public function country_asc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("productname", "asc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on Country descending **/
	public function country_desc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("productname", "desc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on Grand Total ascending **/
	public function total_asc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("orderdate", "asc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for sorting the result based on Grand Total descending **/
	public function total_desc($limit,$offset){
		$this->db->limit($offset,$limit);
		$this->db->order_by("orderdate", "desc");
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
	
	/** Function for finding total for pagination in the table page **/
	public function total(){
		return $this->db->get('tr_import_data_fields')->num_rows();
	}
	
	/** Function for showing individual data result for view and edit **/
	public function data_ind($id){
		$query = $this->db->query("SELECT * FROM `tr_import_data_fields`")->result();
		return $query;
	}
	
    /** Function for updating import table **/
    public function update_import_data_db($array,$ordernummber){
        $query = $this->db->query('SELECT * FROM tr_import_data_fields');
        $this->db->where('ordernumber',trim($ordernummber));
        $this->db->where('sec',$query->num_rows());     
        $query = $this->db->update('tr_import_data_fields',$array);
        return $query;
    }
    
    /** Function for updating import table **/
    public function activate_import_file($upload_id){
        $data = array('active' => '1');
        $this->db->where('upload_id',$upload_id);     
        $query = $this->db->update('tr_import_files',$data);
        return $query;
    }
    
    /** Function for updating import table **/
    public function deactivate_import_file($upload_id){
        $data = array('active' => '0');
        $this->db->where('upload_id != ',$upload_id);     
        $query = $this->db->update('tr_import_files',$data);
        return $query;
    }
    
    /** Function for updating import table **/
    public function deactivate_import_files_other($upload_id){
        $data = array('active' => '0');
        $this->db->where('upload_id != ',$upload_id);     
        $query = $this->db->update('tr_import_files',$data);
        return $query;
    }
    
    public function import_files_uploads(){
        return $this->db->get('tr_import_files')->num_rows();
    }  
    
    public function import_files_last(){
        $this->db->select_max('upload_id');
        $query = $this->db->get('tr_import_files');
        return $query->row()->upload_id;
    } 

    public function get_import_files($id){
        $this->db->select('sec,user,file_name,file_path,ip,alias,data_created,host,active');
        $this->db->from('tr_import_files');
        $this->db->where('user', $id['user']);
        if ($query = $this -> db -> get()) {
            return $query;
        } else {
            return false;
        }
    } 

    public function get_columns_table($table_name){          
        $cols_array = array('sec','user','file_name','file_path','ip','alias','data_created','host','active');
        $this->db->select('column_name, data_type');
        $this->db->from('information_schema.columns');
        $this->db->where('table_name', 'tr_import_files'); 
        $this->db->where_in('column_name', $cols_array);
        if ($query = $this -> db -> get()) {
            return $query;
        } else {
            return array();
        }
    }

	/** Function for updating order table **/
	public function update_order($array,$id){	
		$this->db->where('ordernumber',rtrim($id));
		$query = $this->db->update('tr_import_data_fields',$array);
		return $query;
	}
	
	/** Function for updating customer table **/
	public function update_customer($array,$id){	
		$this->db->where('ordernumber',$id);
		$query = $this->db->update('customer',$array);
		return $query;
	}
	
	/** Function for updating order items table **/
	public function update_item($array,$id){
		$this->db->where('ordernumber',$id);
		$query = $this->db->update('order_items',$array);
		return $query;
	}
	
	/** Function for updating product table **/
	public function update_product($array,$id){
		$this->db->where('ordernumber',$id);
		$query = $this->db->update('product',$array);
		return $query;
	}
	
	/** Function for searching the data entered in the order details page **/
	public function search($data){
		$this->db->like('ordernumber', $data);
		$this->db->or_like('nameofseller', $data); 
		$this->db->or_like('secondnameofseller', $data); 
		$this->db->or_like('productname', $data); 
		$query = $this->db->get('tr_import_data_fields');
		return $query;
	}
}

?>