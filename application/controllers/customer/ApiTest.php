<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/firebase.php';
require APPPATH . 'libraries/push.php';
require APPPATH . 'libraries/mailer/PHPMailer/PHPMailerAutoload.php';

 class ApiTest extends REST_Controller {

  function __construct($config = 'rest')
  {  
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');        
      ini_set('error_reporting', E_STRICT);
      date_default_timezone_set('Asia/kolkata'); 

      parent::__construct($config);    
       $this->load->helper('date');
       $this->load->helper('text');
       $this->load->library('upload');
       $this->load->helper('url');
       $this->load->helper('main_helper'); 
       $this->load->library('form_validation');

   }
       
   public function getNearSpotsByUuid_post()
   {
     
     echo "Dfd";
    die;
     try
     {     
       $uuids   =$_POST['uuid'];
       $majors    =$_POST['major'];
       $uuids_arr=explode(',',$uuids);
       if(!empty($uuids) && !empty($uuids_arr))
       {
         $majors_arr=explode(',',$majors);
         $admin_ids=array();
         foreach($uuids_arr as $key=>$val)
         {
           $ex=explode('-',$val);
           $res=$ex[0];
           $check_uuid=$this->Customer->checkUuid($res);
           $major=$majors_arr[$key];
           if(!empty($check_uuid) && !empty($major)){
             $state=pack("H*", $ex[1]);
             $city=pack("H*", $ex[2]);
             $major_len=strlen($major);
             if($major_len==1)
             {
               $res_id=$state.$city.'0000'.$major;
             }else if($major_len==2)
             {
               $res_id=$state.$city.'000'.$major;
             }
             else if($major_len==3)
             {
               $res_id=$state.$city.'00'.$major;
             }
             else if($major_len==4)
             {
               $res_id=$state.$city.'0'.$major;
             }
             else 
             {
               $res_id=$major;
             }
                 $admin_id=$res_id;
           }
           if(!empty($admin_id))
           {
             array_push($admin_ids,$admin_id);
           }
         }
         if(!empty($admin_ids))
         {
           $result=$this->Customer->getNearSpotsByUuid($admin_ids);
           if(!empty($result))
           {
              foreach($result as $value)
              {
                   $array['admin_id']      =$value['admin_id'];
                   $array['city']          =$value['city'];
                   $array['spotId']        =$value['spotId'];
                   $array['trending']      =$value['trending'];
                   $array['name']          =$value['name'];
                   $array['image']         =empty($value['image'])?'':base_url().'uploads/'.$value['image'];
                   $array['rating']        =$value['rating'];
                   $array['lat']           =$value['lat'];
                   $array['lng']           =$value['lng'];
                   $array['location']      =$value['location'];
                   $array['cuisines']      =$value['cuisines'];
                   $array['priceLevel']    =$value['priceLevel'];
                   $array['cost']          =$value['cost'];
                   $array['openStatus']    =$value['openStatus'];
                   $array['cost']          =$value['cost'];
                   $array['openingTime']   =$value['openingTime'];
                   $array['closingTime']   =$value['closingTime'];
                   $array['phone']         =$value['phone'];
                   $array['address']       =$value['address'];
                   $array['imageList']     =explode(",", $value['imageList']);
                   $array['amenities']     =explode(",", $value['amenities']);
                   $array['verified']      =$value['verified'];
                   $finalarray[]           =$array;
   
                   } 
              $arry=array('time'=>date('H:i d-m-Y'),'spots'=>$finalarray);
                     $this->response($arry, 200);
           }else
           {
              $arry=array('time'=>date('H:i d-m-Y'),'spots'=>'failed');
                     $this->response($arry, 200);
           }
         }else{
           $arry=array('time'=>date('H:i d-m-Y'),'spots'=>'failed');
           $this->response($arry, 200);  
         }
   
   
       }else{
         $arry=array('time'=>date('H:i d-m-Y'),'spots'=>'failed');
         $this->response($arry, 200);
       }
   
   
     }catch(Exception $e)
     {
                 echo $e->getMessage();
                 $error = array('status' =>'0', "spots" => "Internal Server Error - Please try Later.","StatusCode"=> "HTTP405");
                 $this->response($error, 200);
     }
     
   }
}
