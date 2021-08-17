<?php

class Admin_model extends CI_Model
{
	
	var $table ='spots AS s';
    var $column_order = array('s.spotId','s.trending','s.admin_id','s.name','s.image','s.gst_no','s.pan_no','s.location','s.cuisines','s.openingTime','s.closingTime','s.phone','s.create_date','s.status'); 
    var $column_search =  array('s.spotId','s.trending','s.admin_id','s.name','s.image','s.gst_no','s.pan_no','s.location','s.cuisines','s.openingTime','s.closingTime','s.phone','s.create_date','s.status'); 
    var $order = array('spotId' => 'asc');
	public function __construct() 
    {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
    }
   private function _get_datatables_query()
    {

            $select="s.rating,a.restaurant_name,a.user_email,a.mobile_no,s.gst_no,s.pan_no,s.address,a.user_role,s.create_date,a.admin_id,s.status";
	        $this->db->select($select);
	        $this->db->from('spots AS s');
            // print_r($_SESSION['user_role']);exit;
            $this->db->JOIN('tbl_admin AS a','a.admin_id=s.admin_id','INNER');
            if($_SESSION['user_role']==2)
            {
                $this->db->where('a.mobile_no',$_SESSION['mobile_no']);
            }
	        $this->db->order_by('s.spotId','DESC');

        $i = 0;
        foreach ($this->column_search as $item) 
        {
            if($_POST['search']['value']) 
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {


        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
       // print_r($this->db->last_query());exit;
        return $query->result();
    }
    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }
public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
public function getAmenities()
{
    $this->db->select('*');
    $this->db->from('tbl_amenities_type');
    $this->db->where('status',1);
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
}
public function getFoodType()
{
    $this->db->select('*');
    $this->db->from('tbl_food_type');
    $this->db->where('status',1);
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
}
public function checkAdmin($mobile_no)
{
    $this->db->select('*');
    $this->db->from('tbl_admin');
    $this->db->where('mobile_no',$mobile_no);
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
}
public function max()
{
    $this->db->select('max(user_id) AS user_id');
    $this->db->from('tbl_admin');
    $query=$this->db->get();
    $result=$query->result_array();
    return $result[0]['user_id']; 
}
public function addAdmin($admin_array)
{
    $this->db->insert('tbl_admin',$admin_array);
    return $this->db->insert_id();;
}
public function addRestaurant($restau_array)
{
    $this->db->insert('spots',$restau_array);
    return $this->db->insert_id();;
}
public function getRestaurant($admin_id)
{
    $this->db->select('s.name,a.restaurant_name,a.mobile_no,a.user_email,a.user_password,a.salt,s.gst_no,s.pan_no,s.address,s.city,s.openingTime,s.closingTime,s.amenities,s.cuisines,a.user_fullname,a.admin_id');
    $this->db->from('spots AS s');
    $this->db->JOIN('tbl_admin AS a','a.admin_id=s.admin_id');
    $this->db->where('s.status',1);
    $this->db->where('s.admin_id',$admin_id);
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
}

public function updateRestaurant($admin_id,$restau_array,$admin_array)
{
    $this->db->where('admin_id',$admin_id);
    $this->db->update('tbl_admin',$admin_array);

    $this->db->where('admin_id',$admin_id);
    $this->db->update('spots',$restau_array);
    return $this->db->affected_rows();
}
public function changeStatus($admin_id,$change,$convenience_code,$gst_code)
{
  
  // print_r($this->db->last_query());exit;
   $this->db->where('admin_id',$admin_id);
   $this->db->update('tbl_admin',array('status'=>$change));


   $this->db->where('admin_id',$admin_id);
   $this->db->update('spots',array('status'=>$change,'gst_code'=>$gst_code,'convenience_code'=>$convenience_code));  

   return $this->db->affected_rows();
}
  public function insertGstDetails($array)
  {
   $insert=$this->db->insert_batch('master_item_category',$array);
    return $insert?$this->db->insert_id():false; 
  }
 function getRestaurantTypes(){
  $this->db->select('*');
  $this->db->from('master_restaurant_types');
  $this->db->where('status',1);
  $query=$this->db->get();
  // print_r($this->db->last_query());exit;
  $result=$query->result_array();
  return $result;
}
function addService($services){
    $insert=$this->db->insert_batch('restaurant_types',$services);
    return $insert?$this->db->insert_id():false; 
 }
 function removeService($admin_id){
     $this->db->where('admin_id', $admin_id);
     $this->db->delete('restaurant_types');
 }
 function getServices($admin_id){
  $this->db->select('type_id');
  $this->db->from('restaurant_types');
  $this->db->where('status',1);
  $this->db->where('admin_id',$admin_id);
  $query=$this->db->get();
  // print_r($this->db->last_query());exit;
  $result=$query->result_array();
  return $result;
 }
 function getRestaurantList()
{
    $select="s.rating,a.restaurant_name,a.user_email,a.mobile_no,a.admin_id,s.status";
    $this->db->select($select);
    $this->db->from('spots AS s');
    // print_r($_SESSION['user_role']);exit;
    $this->db->JOIN('tbl_admin AS a','a.admin_id=s.admin_id','INNER');
    if($_SESSION['user_role']==2)
    {
        $this->db->where('a.mobile_no',$_SESSION['mobile_no']);
    }
    $this->db->order_by('s.spotId','DESC');
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
 
}

}
