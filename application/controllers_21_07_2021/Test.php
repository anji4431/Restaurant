<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
	
	function __construct() 
    {   
       parent::__construct();
       $this->load->library('session');
       $this->load->library('form_validation'); 
       $this->load->library('encrypt');     
       $this->load->model('Test_model');
       $this->load->helper('main_helper');   
       if(empty($_SESSION['mobile_no']))
       {
       	redirect(base_url());
       }
    }
    public function test()
    {
    	$session_data=$this->session->all_userdata();
       // $result['misc_category']=$this->Menu_model->getMenuCategory();
  		$this->load->view('header',$session_data);
  		$this->load->view('leftSidebar',$session_data);
  		$this->load->view('testList');
  		$this->load->view('footer');
    }
    public function getTestList()
    {
        print_r($_REQUEST);
        die;
		   try
		    {	
				$restaurantList =$this->Test_model->get_datatables();
				//echo '<pre>';print_r($restaurantList);exit;
				$data = array();
				$no = $_POST['start'];
				foreach ($restaurantList as $list) {
					$no++;
					$row = array();
					$row[] 	=$no;
					$row[] 	=$list->cus_id;
					$row[] 	=$list->name;
					$row[]  =$list->state;
					$row[] 	=$list->city;
					$row[] 	=$list->address;
					$row[] 	=$list->gender;
					$row[] 	=$list->date_of_birth;
					$row[] 	=$list->mobile_no;
					$row[] 	=$list->email_id;
					// $row[] 	=$list->status=='1'?'Active':'In Active';
					$data[]	=$row;
				}
				$output = array(
								"draw" => $_POST['draw'],
								"recordsTotal" => $this->Test_model->count_all(),
								"recordsFiltered" => $this->Test_model->count_filtered(),
								"data" => $data,
						);
			echo json_encode($output);
		            
		    }catch(Exception $e)
		    {
				    echo $e->getMessage();
				    $error = array('status' =>'0', "data" => "Internal Server Error - Please try Later.","StatusCode"=> "HTTP405");
				    echo json_encode($error, 200);exit;
		    }
		    }

     private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('menu_name') == '')
        {
            $data['inputerror'][] = 'menu_name';
            $data['error_string'][] = 'Menu name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('menu_food_type') == '')
        {
            $data['inputerror'][] = 'menu_food_type';
            $data['error_string'][] = 'Food type is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('menu_price') == '')
        {
            $data['inputerror'][] = 'menu_price';
            $data['error_string'][] = 'Price is required';
            $data['status'] = FALSE;
        }
        // if($this->input->post('menu_sub_category') == '')
        // {
        //     $data['inputerror'][] = 'menu_sub_category';
        //     $data['error_string'][] = 'Sub Category is required';
        //     $data['status'] = FALSE;
        // }
        if($this->input->post('menu_category') == '')
        {
            $data['inputerror'][] = 'menu_category';
            $data['error_string'][] = 'Category is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('menu_gst') == '')
        {
            $data['inputerror'][] = 'menu_gst';
            $data['error_string'][] = 'GST is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('menu_details') == '')
        {
            $data['inputerror'][] = 'menu_details';
            $data['error_string'][] = 'Menu details is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}


?>