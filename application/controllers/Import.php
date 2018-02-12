<?php

defined('BASEPATH') OR exit('No direct script access allowed' );

    class Import extends CI_Controller {

        public function __construct(){
            parent::__construct();
        }
    
        public function index()
        {
    
        }
    
        function import_csv(){
            
            $file_directory         = $this -> input -> post('file_directory');
            
            $file_delimiter         = $this -> input -> post('file_delimiter');
            
            $file_name              = $this -> input -> post('file_name');
            
            $column_names           = $this -> input -> post('column_names');
            
            $column_headers         = $this -> input -> post('column_headers');

            $csv_file = $file_directory . '/' . $file_name;
            
            $csvfile  = fopen($csv_file, 'r');
            
            $theData  = fgets($csvfile);
            
            $i = 0;
            
            while (!feof($csvfile)) {
                
                $csv_data[] = fgets($csvfile);
                $csv_array = explode($file_delimiter, $csv_data[$i]);
                $insert_csv = array();
                
                $insert_csv['ID'] = $csv_array[0];
                $insert_csv['name'] = $csv_array[1];
                $insert_csv['email'] = $csv_array[2];
    
                $this->import_model->save_default_data( $insert_csv );
            }
            
            fclose($csvfile);
        
            echo "File data successfully imported to database!!";
        }

        public function do_import()
        {
            $import_data = array(
            
                'name'      => $this -> input -> post('name'), 
                'email'     => $this -> input -> post('email'), 

            );
            
            $this -> import_model -> save_data($import_data);
        }
        
        
        public function prepare_import()
        {
            $import_fields = array(
                'ordernumber'               => $this -> input -> post('ordernumber'), 
                'orderdate'                 => $this -> input -> post('orderdate'), 
                'receiveddaysafter'         => $this -> input -> post('receiveddaysafter'), 
                'emailofseller'             => $this -> input -> post('emailofseller'), 
                'nameofseller'              => $this -> input -> post('nameofseller'),
                'secondnameofseller'        => $this -> input -> post('secondnameofseller'),
                'product_sku'               => $this -> input -> post('product_sku'),
                'productname'               => $this -> input -> post('productname'),
                'producturl'                => $this -> input -> post('producturl'),
                'product_gtin'              => $this -> input -> post('product_gtin'),
                'attr_1'                    => $this -> input -> post('attr_1'),
                'attr_2'                    => $this -> input -> post('attr_2'),
                'attr_3'                    => $this -> input -> post('attr_3'),
                'attr_4'                    => $this -> input -> post('attr_4'),
                'attr_5'                    => $this -> input -> post('attr_5'),
                'attr_6'                    => $this -> input -> post('attr_6'), 
            );
            
            $this -> import_model -> create_fields($import_fields);
        }
}
?>
