<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class KotController extends CI_Controller
{
	
	function __construct() 
    {   
       parent::__construct();
       $this->load->library('session');
       $this->load->library('form_validation'); 
       $this->load->library('encrypt');     
       $this->load->model('OrderList_model');
       $this->load->helper('main_helper');   
       if(empty($_SESSION['mobile_no']) && $_SESSION['user_role']==3)
       {
       	redirect(base_url());
       }
    }
    public function orderList()
    {
    	$session_data=$this->session->all_userdata();
      // print_r($_SESSION);
      // die;
    //$result['admin_id']=$_SESSION['admin_id'];
		$this->load->view('header',$session_data);
		$this->load->view('leftSidebar',$session_data);
		$this->load->view('orderList');
		$this->load->view('footer');
    }
    public function getOrderList()
    {
		   try
		    {	
				$restaurantList =$this->OrderList_model->get_datatables();
				 //echo '<pre>';print_r($restaurantList);exit;
				$data = array();
				$no = $_POST['start'];
				foreach ($restaurantList as $list) {
          $menus='';
					$no++;
          $row[] 	=$no;
					$row[] 	=$list->order_id;
          $row[] 	=$list->table_no;
          $menu_item=array_filter(explode(',',$list->menu_item_name));
          $menu_quantity=array_filter(explode(',',$list->quantity));
          $menu_half_full=array_filter(explode(',',$list->half_and_full_status));

          $submenu_item=array_filter(explode(',',$list->submenu_item_name));
          $submenu_quantity=array_filter(explode(',',$list->sub_quantity));
          $submenu_half_full=array_filter(explode(',',$list->sub_half_full_status));
          $j=1;
          $count=count($menu_item);
          $sub_count=count($submenu_item);
          $menu='<table><thead><tr>
          <th>Sr.No.</th>
          <th>Menu Item Name</th>
          <th>Quantity</th>
          <th>Half/Full</th></tr></thead><tbody>';
          

          for($k=0;$k<=$count;$k++)
          {
            $menus='';
            if($menu_item[$k]!='')
            {
              $menus.='<tr class="click_class">';
              $menus.= '<td>'.$j.'</td>';
              $menus.= '<td>'.$menu_item[$k].'</td>';
              $menus.= '<td>'.$menu_quantity[$k].'</td>';
              $menus.= '<td>'.$menu_half_full[$k].'</td>';
              $j++;
              $menus.='</tr>';
            }
          }
          // $j1=$j;
          // if(!empty($submenu_item))
          //     {
          //       for($l=0;$l<=$sub_count;$l++)
          //       {
          //         $submenu='';
          //         if($submenu_item[$l]!='')
          //         {
          //           $submenu.='<tr>';
          //           $submenu.= '<td>'.$j1.'</td>';
          //           $submenu.= '<td>'.$submenu_item[$l].'</td>';
          //           $submenu.= '<td>'.$submenu_quantity[$l].'</td>';
          //           $submenu.= '<td>'.$submenu_half_full[$l].'</td>';
          //           $j1++;
          //           $submenu.='</tr>';
          //         }
          //       }
          //     }
          $menu.=$menus.'</tbody>';
          $row[]=$menu;
				 $row[] 	='<div class="row text-center " style="width: max-content;margin-right: auto; margin-left: auto;"><a class="btn btn-sm btn-primary btn-xs print_slip" href="javascript:void(0)" title="Print" onclick="print_status('."'".$list->order_id."'".')"style="height: 33px"><i class="fa fa-print">&nbsp</i>Print</a></div>';
					$data[]	=$row;
				}
        print_r($data);
        die;
				$output = array(
								"draw" => $_POST['draw'],
								"recordsTotal" => $this->OrderList_model->count_all(),
								"recordsFiltered" => $this->OrderList_model->count_filtered(),
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
public function change_status()
{
	try
	{
    $order_id=$_POST['order_id'];
		if(!empty($order_id))
		{

			$result=$this->OrderList_model->change_status($order_id);
			if($result)
			{
				$arry=array('status'=>'1','message'=>'Success');
             	echo json_encode($arry, 200);exit();
			}else
			{
				$arry=array('status'=>'0','message'=>'Something went wrong');
             	echo json_encode($arry, 200);exit();
			}
		}else
		{
			 $arry=array('status'=>'0','message'=>'Something went wrong');
             echo json_encode($arry, 200);exit;
		}
	}catch(Exception $e)
	{
		$e->getMessage();
		$error = array('status' =>'0', "data" => "Internal Server Error - Please try Later.","StatusCode"=> "HTTP405");
		echo json_encode($error, 200);exit;

	}
}
// public function printData()
//     {
//     $session_data=$this->session->all_userdata();
//     $order_id = $_POST['order_id'];
// 				$restaurantList =$this->OrderList_model->get_print_data($order_id);
//        // echo '<pre>';print_r($restaurantList);exit;
// 		$this->load->view('printData',$restaurantList);
//     }
    public function printData()
    {
		   try
		    {	
          $order_id = $_POST['order_id'];
          $restaurantList =$this->OrderList_model->get_print_data($order_id);
          // echo '<pre>';print_r($restaurantList);exit;
          $data = array();
          $no = $_POST['start'];
				foreach ($restaurantList as $list) {
					$no++;
          $row[] 	=$no;
					$row[] 	=$list->order_id;
          $row[] 	=$list->table_no;
          $menu_item=array_filter(explode(',',$list->menu_item_name));
          $menu_quantity=array_filter(explode(',',$list->quantity));
          $menu_half_full=array_filter(explode(',',$list->half_and_full_status));

          $submenu_item=array_filter(explode(',',$list->submenu_item_name));
          $submenu_quantity=array_filter(explode(',',$list->sub_quantity));
          $submenu_half_full=array_filter(explode(',',$list->sub_half_full_status));
          $j=1;
          $count=count($menu_item);
          $sub_count=count($submenu_item);
          $menu='';
          $menu.='<table><thead><tr>
          <th>Sr.No.</th>
          <th>Menu Item Name</th>
          <th>Quantity</th>
          <th>Half/Full</th></tr></thead>';
          $menu.='<tbody>';
          for($k=0;$k<=$count;$k++)
          {
            if($menu_item[$k]!='')
            {
              $menu.='<tr class="click_class">';
              $menu.= '<td>'.$j.'</td>';
              $menu.= '<td>'.$menu_item[$k].'</td>';
              $menu.= '<td>'.$menu_quantity[$k].'</td>';
              $menu.= '<td>'.$menu_half_full[$k].'</td>';
              $j++;
              $menu.='</tr>';
            }
          }
          $j1=$j;
          if(!empty($submenu_item))
              {
                for($l=0;$l<=$sub_count;$l++)
                {
                  if($submenu_item[$l]!='')
                  {
                    $menu.='<tr>';
                    $menu.= '<td>'.$j1.'</td>';
                    $menu.= '<td>'.$submenu_item[$l].'</td>';
                    $menu.= '<td>'.$submenu_quantity[$l].'</td>';
                    $menu.= '<td>'.$submenu_half_full[$l].'</td>';
                    $j1++;
                    $menu.='</tr>';
                  }
                }
              }
              $menu.='</tbody>';
          $row[]=$menu;
					$data[]	=$row;
				}
        //echo '<pre>';print_r($data);exit;
       $this->load->view('printData',array('res'=>$data));
		            
		    }catch(Exception $e)
		    {
				    echo $e->getMessage();
				    $error = array('status' =>'0', "data" => "Internal Server Error - Please try Later.","StatusCode"=> "HTTP405");
				    echo json_encode($error, 200);exit;
		    }
		    }
}


?>