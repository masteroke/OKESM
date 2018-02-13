<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Csvupload extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
            $this->load->model('upload_model');
            $this->load->helper(array('form', 'url'));
            
            /*
            $this->output->enable_profiler(TRUE);
            $sections = array(
                    'controller_info'  => TRUE,
                    'queries' => TRUE
            );
            $this->output->set_profiler_sections($sections);*/
            
    }
        
	public function index()
	{
		$this->dashboard();			// Redirects the index function into dashboard
	}
	
	
	/** Dashboard function for the application **/
	public function dashboard(){
		$data['url'] = base_url();
		$this->load->view('csvupload/dashboard', $data);
	}
	
	/** Order details function for showing the available data from database in table format **/
	public function import_details(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost:8050/CSV-Mapping-Tool/csvupload/order_details";
		$config['total_rows'] = $this -> upload_model -> total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$records = $this->upload_model->fetch_last_import($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$this->load->view('csvupload/import_details',$data);
	}

    /** Order details function for showing the available data from database in table format **/
    public function import_details_all(){
        $data['url'] = base_url();
        //$config['base_url']="http://localhost:8050/CSV-Mapping-Tool/csvupload/order_details";
        $config['total_rows'] = $this -> upload_model -> total();
        $config['per_page'] = 10;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['sort_id'] = "sort_id_desc";
        $data['sort_fname'] = "sort_fname_desc";
        $data['sort_lname'] = "sort_lname_desc";
        $data['sort_country'] = "sort_country_desc";
        $data['total'] = "sort_total_desc";
        $records = $this->upload_model->fetch_all($page,$config['per_page']);       // Pagination happens here
        $data['records'] = $records->result();
        $this->load->view('csvupload/import_details',$data);
    }
	
	/** Upload function for uploading csv and mapping the CSV values **/	
	public function upload_csv(){
		$data['page_status'] = 1;
		$data['error'] = "CSV File";
		if(isset($_POST['btnUpload'])){			// Upload area after clicking the upload button
		
            //$config['upload_path']          = 'C:/Aptana/Projekts/CsvMappingTool/uploads/';
                $config['upload_path']          = APPPATH.'uploads/';
                $config['allowed_types']        = 'csv';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

			if ( $this->upload->do_upload()){
				$data = array('upload_data' => $this->upload->data());
				$data['file'] = $data['upload_data']['full_path'];
				$entire_data = file_get_contents($data['file']);			
				$exp_entire_data = explode("\n",$entire_data);
				$file_column_name = explode(";",$exp_entire_data[0]);
				$data['csv_columns'] = $file_column_name;
				$data['page_status'] = 2;
			}else{
				$data['error'] = "Only CSV files allowed!  " . $config['upload_path'];
			}
		}
		if(isset($_POST['btnUpdate'])){			// Mapping area after maping the values with CSV file values and inserting data to the database
			$entire_data = file_get_contents($_POST['hdnFile']);
			$exp_entire_data = explode("\n",$entire_data);
			$file_column_name = explode(";",$exp_entire_data[0]);
			$count = count($exp_entire_data);
			for($i=1; $i< $count - 1; $i++){
				$exp_entire_value = explode(";",$exp_entire_data[$i]);
				$entire_csv_values[] = array_combine($file_column_name,$exp_entire_value);
			}

			$count = count($entire_csv_values);
			for($c=0;$c<$count;$c++){
				foreach($entire_csv_values[$c] as $key=>$value){
					foreach($_POST as $kval=>$dat){
						if($key==$dat){
							$result[$kval] = $value;
						}
					}
				}
                //ordernumber;orderdate;receiveddaysafter;emailofseller;nameofseller;secondnameofseller;product_sku;productname;producturl;product_gtin
                
				$orderArr = array('ordernumber','orderdate','receiveddaysafter','emailofseller','nameofseller','secondnameofseller','product_sku','productname','producturl','product_gtin','attr1','attr2','attr3','attr4','attr5');
				foreach($orderArr as $val){
					if(array_key_exists($val,$result)){
						$order[$val]= $result[$val];		
					}
				}
				$order_id = $this->upload_model->insert_order($order);		// Matching and inserting the field for the order table
				$result['order_id'] = $order_id;
				
                
				$custArr = array('ordernumber','emailofseller','nameofseller');
				foreach($custArr as $val){
					if(array_key_exists($val,$result)){
						$customer[$val]= $result[$val];
					}
				}
				$this->upload_model->insert_customer($customer);		// Matching and inserting the field for the customer table
				
				$itemArr = array('quantity','price','ordernumber');
				foreach($itemArr as $val){
					if(array_key_exists($val,$result)){
						$item[$val]= $result[$val];
					}
				}
				$this->upload_model->insert_item($item);	// Matching and inserting the field for the order items table 
				
				$productArr = array('product_sku','productname','ordernumber');
				foreach($productArr as $val){
					if(array_key_exists($val,$result)){
						$product[$val]= $result[$val];
					}
				}
				$this->upload_model->insert_product($product);	// Matching and inserting the field for the product table
                 
			}
			redirect('/csvupload/import_details', 'refresh');
		}
		$data['url'] = base_url();
		$this->load->view('csvupload/upload_csv',$data);
	}

    /** Upload function for uploading csv and mapping the CSV values **/    
    public function upload_update_csv(){
        $data['page_status'] = 1;
        $data['error'] = "CSV File";
        
        if(isset($_POST['btnUpload'])){         // Upload area after clicking the upload button

                $config['upload_path']          = APPPATH.'uploads/';
                $config['allowed_types']        = 'csv';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

            if ( $this->upload->do_upload()){
                $data = array('upload_data' => $this->upload->data());
                $data['file'] = $data['upload_data']['full_path'];
                $entire_data = file_get_contents($data['file']);            
                $exp_entire_data = explode("\n",$entire_data);
                $file_column_name = explode(";",$exp_entire_data[0]);
                $data['csv_columns'] = $file_column_name;
                $data['page_status'] = 2;
                
                $upload_data = $this->upload->data();
                
                $user = $this->session->all_userdata(); 
                
                $remote['ip'] = $_SERVER['REMOTE_ADDR'];
                
                if (isset($_SERVER['REMOTE_HOST'])) {
                    $remote['host'] = $_SERVER['REMOTE_HOST'];    
                }
                else {
                    $remote['host'] = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
                }
    
                $upload_file_db['file_path'] = $upload_data['file_path'];
                $upload_file_db['file_name'] = $upload_data['orig_name'];

                $data_db = array_merge($this->sess_user_id(), $upload_file_db);   
                $data_db = array_merge($remote, $data_db);
                
                /*
                echo "<pre>";
                print_r($data_db);
                echo "</pre>";
*/
                
                $id = $this->upload_model->insert_import_file($data_db); 

            }else{
                $data['error'] = "Only CSV files allowed!  " . $config['upload_path'];
            }
        }

        if(isset($_POST['btnUpdate'])){         // Mapping area after maping the values with CSV file values and inserting data to the database
        
            $entire_data = file_get_contents($_POST['hdnFile']);
            $exp_entire_data = explode("\n",$entire_data);
            $file_column_name = explode(";",$exp_entire_data[0]);
            $count = count($exp_entire_data);
            
            for($i=1; $i < $count-1; $i++){

                $exp_entire_value = explode(";",$exp_entire_data[$i]);
                
                $entire_csv_values[] = array_combine($file_column_name,$exp_entire_value);
            }

            $count = count($entire_csv_values);
            
            for($c=0;$c<$count;$c++){

                $csv_header = array(
                'ordernumber',
                'orderdate',
                'receiveddaysafter',
                'emailofseller',
                'nameofseller',
                'secondnameofseller',
                'product_sku',
                'productname',
                'producturl',
                'product_gtin',
                'product_img',
                'email_sent_date1',
                'has_been_sent1',
                'email_sent_date2',
                'has_been_sent2'
                );
                                
                foreach($entire_csv_values[$c] as $key=>$value){
                    foreach($_POST as $kval=>$dat){ 
                        if(strcasecmp(trim($key), trim($dat)) === 0){
                            $result[$kval] = $value;
                        }
                    }
                }
                
                foreach($csv_header as $val){
                    if(array_key_exists($val, $result)){
                        $import_values[$val] = $result[$val];        
                    }
                }  
                
                $data_db = array_merge($this->sess_user_id(), $import_values);        
                
                $order_id = $this->upload_model->insert_import_data($data_db);      // Matching and inserting the field for the order table  
                
                /*
                echo "<pre>";
                print_r($data_db);
                echo "</pre>";*/        
            }
            


            redirect('csvupload/import_details', 'refresh');
        }
        $data['url'] = base_url();
        $this->load->view('csvupload/upload_csv',$data);
    }
	
	
	/** Sorting  function based on ID asecending along with pagination **/
	public function sort_id_asc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->id_asc($page,$config['per_page']);		// Pagination happens here
		
		$data['records'] = $records->result();
        
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	
	/** Sorting function based on ID descenting along with pagination **/
	public function sort_id_desc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->id_desc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_asc";
		$data['sort_fname'] = "sort_fname_asc";
		$data['sort_lname'] = "sort_lname_asc";
		$data['sort_country'] = "sort_country_asc";
		$data['total'] = "sort_total_asc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on First Name ascending along with pagination **/
	public function sort_fname_asc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->fname_asc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on First Name descenting along with pagination **/
	public function sort_fname_desc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->fname_desc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_asc";
		$data['sort_fname'] = "sort_fname_asc";
		$data['sort_lname'] = "sort_lname_asc";
		$data['sort_country'] = "sort_country_asc";
		$data['total'] = "sort_total_asc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on Last Name ascending along with pagination **/
	public function sort_lname_asc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->lname_asc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on Last Name descenting along with pagination **/
	public function sort_lname_desc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->lname_desc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_asc";
		$data['sort_fname'] = "sort_fname_asc";
		$data['sort_lname'] = "sort_lname_asc";
		$data['sort_country'] = "sort_country_asc";
		$data['total'] = "sort_total_asc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on Country ascending along with pagination **/
	public function sort_country_asc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->country_asc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on Country descenting along with pagination **/
	public function sort_country_desc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->country_desc($page,$config['per_page']);	// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_asc";
		$data['sort_fname'] = "sort_fname_asc";
		$data['sort_lname'] = "sort_lname_asc";
		$data['sort_country'] = "sort_country_asc";
		$data['total'] = "sort_total_asc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on Grand Total ascending along with pagination **/
	public function sort_total_asc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->total_asc($page,$config['per_page']);		// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** Sorting function based on Grand Total descenting along with pagination **/
	public function sort_total_desc(){
		$data['url'] = base_url();
		//$config['base_url']="http://localhost/excersise/csvupload/order_details";
		$config['total_rows'] = $this->upload_model->total();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records = $this->upload_model->total_desc($page,$config['per_page']);	// Pagination happens here
		$data['records'] = $records->result();
		$data['sort_id'] = "sort_id_asc";
		$data['sort_fname'] = "sort_fname_asc";
		$data['sort_lname'] = "sort_lname_asc";
		$data['sort_country'] = "sort_country_asc";
		$data['total'] = "sort_total_asc";
		$this->load->view('csvupload/import_details',$data);
	}
	
	/** View function for viewing the individual order based on user selection **/
	public function view_order($id){
		$data['url'] = base_url();
		$data['result'] = $this->upload_model->data_ind($id);
		$this->load->view('csvupload/view_item',$data);
	}
	
	/** Edit function for editing the individual order based on user selection **/
	public function edit_order($id){
		$data['url'] = base_url();
		$data['result'] = $this->upload_model->data_ind($id);
		$this->load->view('csvupload/edit_item',$data);
	}
	
	
	/** Update function for updating the edited data into the database **/
	public function update(){
		$result = $_POST;
		$id = $_POST['ordernumber'];
		
        $csv_header = array(
                'ordernumber',
                'orderdate',
                'receiveddaysafter',
                'emailofseller',
                'nameofseller',
                'secondnameofseller',
                'product_sku',
                'productname',
                'producturl',
                'product_gtin',
                'product_img',
                'email_sent_date1',
                'has_been_sent1',
                'email_sent_date2',
                'has_been_sent2'
        );
                  
		foreach($csv_header as $val){
			if(array_key_exists($val,$result)){
				$data_db[$val]= $result[$val];
			}
		}
        
        /*
        echo "<pre>";
                print_r($data_db);
        echo "</pre>";*/
        
		$this->upload_model->update_import_data_db($data_db,$id);		// Matching and updating order table
		$this->import_details();
	}
	
	/** Search function for searching the data in the data area based on id, first name and last name **/
	public function search(){
		$parameter = $_POST['search'];
		$data['url'] = base_url();
		$data['sort_id'] = "sort_id_desc";
		$data['sort_fname'] = "sort_fname_desc";
		$data['sort_lname'] = "sort_lname_desc";
		$data['sort_country'] = "sort_country_desc";
		$data['total'] = "sort_total_desc";
		$records = $this->upload_model->search($parameter);		//Search happens here
		$data['records'] = $records->result();
		$this->load->view('csvupload/import_details',$data);
	}
    
    private function sess_user_id(){
        $user = $this->session->all_userdata(); 
        $arr['user'] = $user['id'];
        return $arr;
    }
    
    private function sess_user_name(){
        $user = $this->session->all_userdata(); 
        $arr['name'] = $user['name'];
        return $arr;
    }
    
    public function import_files(){
        $records = $this->upload_model->get_import_files($this->sess_user_id());  
        $user = $this->session->all_userdata(); 
        $data = $records->result_array();
        $i = 0;
        foreach($data as $val){
             $data[$i ++]['user'] = $user['username'];
        }        
        
        echo json_encode($data); 
    }
    
    public function import_files_columns(){
        $records = $this->upload_model->get_columns_table('tr_import_files');  
        echo json_encode($records->result());  
    }
            
}
