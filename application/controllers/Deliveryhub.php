
<?php
    //26-2-19(Mounika)
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/delivery/Idelivery.php'); // require deliveryhub interface


class Deliveryhub  extends CI_Controller implements Idelivery
{


  public function __construct()
  {
    parent::__construct();

    $this->load->model('insert_model');
      $this->load->model('update_model');
      $this->load->model('delete_model');
      $this->load->model('select_model');
      $this->load->model('validate_model'); 
      $this->user_id = $this->session->userdata('admin_id');
      $this->backend_table = $this->session->userdata('delivery_table');
  }
  //26-2-19(Mounika)
	public function index($data = null)
	{
		$this->load->view('headers/deliveryhubheader');
		$this->load->view('deliveryhub/deliveryhub_login',$data);
		$this->load->view('headers/footer');
    }
    //26-2-19(Mounika)
	public function deliveryhub_login()
	{
		$this->form_validation->set_rules('user_name','user_name','required');
		$this->form_validation->set_rules('admin_password','password','required');

		if ($this->form_validation->run())
		{
			$data = array(
				'email_id' => $this->input->post('user_name'),
				'password' => $this->input->post('admin_password')
			);

			$data =  $this->validate_model->get_delivery_user($data);
			$this->session->set_userdata($data);

			if($data['count'])
			{
				if($this->session->has_userdata('admin_id'))
				{
					$this->load->view('headers/deliveryhub_home_header',$data);
					// $this->load->view('deliveryhub/deliveryhub_home');
					$this->load->view('headers/footer'); 
				}
				else
				{
					$this->error_403();
				}	
			}
			else
			{
				$data['error_handler'] = "User Not Found";
				$this->index($data);
			}
		} 
		else 
		{
			$this->index();
		}
	}
   public function deliveryhub_home()
    {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $this->load->view('headers/deliveryhub_home_header',$data);
            $this->load->view('deliveryhub/deliveryhub_home');
            $this->load->view('headers/footer');
        }
        else
        {
            $this->error_403();
        }
    }

	public function delivery_employee()
	{
		 if($this->session->has_userdata('admin_id'))
        {

            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
      			$this->load->view('headers/deliveryhub_home_header',$data);
      			 $this->load->view('deliveryhub/delivery_employee');
      			$this->load->view('headers/footer'); 
        }
        else
        {
            $this->error_403();
        }
		
	}
	public function delivery_emploee_data()
	{
		$this->form_validation->set_rules('txtemp_name', 'txtemp_name', 'required');
       $this->form_validation->set_rules('txtLname', 'txtLname', 'required');
       $this->form_validation->set_rules('txtMname', 'txtMname', 'required');
       $this->form_validation->set_rules('txtemp_id', 'txtemp_id', 'required');
       $this->form_validation->set_rules('txtGender', 'txtGender', 'required');
       $this->form_validation->set_rules('txtemp_role', 'txtemp_role', 'required');
       $this->form_validation->set_rules('txtemail_id', 'txtemail_id', 'required');
       $this->form_validation->set_rules('txtBlood', 'txtBlood', 'required');
       $this->form_validation->set_rules('txtBirthdate', 'txBirthdate', 'required');
       $this->form_validation->set_rules('txtJoindate', 'txtJoindate', 'required');
       $this->form_validation->set_rules('txtmobile', 'txtmobile', 'required');
       $this->form_validation->set_rules('txtemgcnt', 'txtemgcnt', 'required');
       $this->form_validation->set_rules('txtaadhar', 'txtaadhar', 'required');
       $this->form_validation->set_rules('txtpan', 'txtpan', 'required');
       $this->form_validation->set_rules('txtpass', 'txtpass', 'required');
       $this->form_validation->set_rules('l_addr1', 'l_addr1', 'required');
       $this->form_validation->set_rules('l_addr2', 'l_addr2', 'required');
       $this->form_validation->set_rules('l_addr3', 'l_addr3', 'required');
       $this->form_validation->set_rules('l_state', 'l_state', 'required');
       $this->form_validation->set_rules('l_city', 'l_city', 'required');
       $this->form_validation->set_rules('l_zipcode', 'l_zipcode', 'required');
       $this->form_validation->set_rules('p_addr1', 'p_addr1', 'required');
       $this->form_validation->set_rules('p_addr2', 'p_addr2', 'required');
       $this->form_validation->set_rules('p_addr3', 'p_addr3', 'required');
       $this->form_validation->set_rules('p_state', 'p_state', 'required');
       $this->form_validation->set_rules('p_city', 'p_city', 'required');
       $this->form_validation->set_rules('p_zipcode', 'p_zipcode', 'required');
       $this->form_validation->set_rules('txtfather', 'txtfather', 'required');
       $this->form_validation->set_rules('txtfathmail', 'txtfathmail', 'required');
       $this->form_validation->set_rules('txtfathmob', 'txtfathmob', 'required');
       $this->form_validation->set_rules('txtfathaadhar', 'txtfathaadhar', 'required');
       $this->form_validation->set_rules('txtmother', 'txtmother', 'required');
       $this->form_validation->set_rules('txtmothmail', 'txtmothmail', 'required');
       $this->form_validation->set_rules('txtmothmob', 'txtmothmob', 'required');
       $this->form_validation->set_rules('txtmothaadhar', 'txtmothaadhar', 'required');
       $this->form_validation->set_rules('txtbank', 'txtbank', 'required');
       $this->form_validation->set_rules('txtacct', 'txtacct', 'required');
       $this->form_validation->set_rules('txtbranch', 'txtbranch', 'required');
       $this->form_validation->set_rules('txtifsc', 'txtifsc', 'required');

       if ($this->form_validation->run())
       {
		$insert_employee = array(
                "del_id"=>$this->input->post("txtkitchen_id"),
                "emp_id"=>$this->input->post("txtemp_id"),
                "emp_name"=>$this->input->post("txtemp_name"),
                "Lname"=>$this->input->post("txtLname"),
                "Mname"=>$this->input->post("txtMname"),
                "Gender"=>$this->input->post("txtGender"),
                "emp_role"=>$this->input->post("txtemp_role"),
                "email_id"=>$this->input->post("txtemail_id"),
                "Blood"=>$this->input->post("txtBlood"),
                "Birthdate"=>$this->input->post("txtBirthdate"),
                "Joindate"=>$this->input->post("txtJoindate"),
                "mobile"=>$this->input->post("txtmobile"),
                "emgcnt"=>$this->input->post("txtemgcnt"),
                "aadhar"=>$this->input->post("txtaadhar"),
                "pan"=>$this->input->post("txtpan"),
                "pass"=>$this->input->post("txtpass"),
                "l_address1"=>$this->input->post("l_addr1"),
                "l_address2"=>$this->input->post("l_addr2"),
                "l_address3"=>$this->input->post("l_addr3"),
                "state"=>$this->input->post("l_state"),
                "city"=>$this->input->post("l_city"),
                "zipcode"=>$this->input->post("l_zipcode"),
                "p_address1"=>$this->input->post("p_addr1"),
                "p_address2"=>$this->input->post("p_addr2"),
                "p_address3"=>$this->input->post("p_addr3"),
                "p_state"=>$this->input->post("p_state"),
                "p_city"=>$this->input->post("p_city"),
                "p_zipcode"=>$this->input->post("p_zipcode"),
                "father_name"=>$this->input->post("txtfather"),
                "father_email"=>$this->input->post("txtfathmail"),
                "father_mobile"=>$this->input->post("txtfathmob"),
                "father_aadhar"=>$this->input->post("txtfathaadhar"),
                "mother_name"=>$this->input->post("txtmother"),
                "mother_email"=>$this->input->post("txtmothmail"),
                "mother_mobile"=>$this->input->post("txtmothmob"),
                "mother_aadhar"=>$this->input->post("txtmothaadhar"),
                "bank_name"=>$this->input->post("txtbank"),
                "bank_acct"=>$this->input->post("txtacct"),
                "bank_branch"=>$this->input->post("txtbranch"),
                "bank_ifsc"=>$this->input->post("txtifsc")
          );

          $get_count = $this->validate_model->get_del_employee($insert_employee['emp_id']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_delivery_employee($insert_employee);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Employee'); </script>";
				$this->delivery_employee();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
				$this->delivery_employee();
                // $this->create_category();
          }
      }
       else
       {
        $this->delivery_employee();
       }
       
	}
  //18-3-2019 (divya)
    public function view_employee()
    {
    
        //$data['kitchen_user_employee'] = $this->select_model->get_employee();
        //$data['get_role'] = $this->select_model->get_role_master();
       $data['delivery_user_employee'] = $this->select_model->select_del_employee();      
        $this->load->view('headers/deliveryhub_home_header');
        $this->load->view('deliveryhub/delivery_view_employee',$data);
    $this->load->view('headers/footer');
    
    }
     
    public function edit_employee()
    {
    //if($this->session->userdata('kitchen_id'))
    //{
        $data['delivery_emp_data'] = $this->select_model->select_user("delivery_employee",$this->uri->segment(3));
        //$data['get_role'] = $this->select_model->get_role_master();
        
        $this->load->view('headers/deliveryhub_home_header');
        $this->load->view('deliveryhub/delivery_employee',$data);
        $this->load->view('headers/footer');
   // }
    //else
    //{
    //  $this->error_403();
   // }
    }
    
    public function update_employee()
    {
        $this->form_validation->set_rules('txtemp_name', 'txtemp_name', 'required');
        $this->form_validation->set_rules('txtLname', 'txtLname', 'required');
        $this->form_validation->set_rules('txtMname', 'txtMname', 'required');
        $this->form_validation->set_rules('txtemp_id', 'txtemp_id', 'required');
        $this->form_validation->set_rules('txtGender', 'txtGender', 'required');
        $this->form_validation->set_rules('txtemp_role', 'txtemp_role', 'required');
        $this->form_validation->set_rules('txtemail_id', 'txtemail_id', 'required');
        $this->form_validation->set_rules('txtBlood', 'txtBlood', 'required');
        $this->form_validation->set_rules('txtBirthdate', 'txBirthdate', 'required');
        $this->form_validation->set_rules('txtJoindate', 'txtJoindate', 'required');
        $this->form_validation->set_rules('txtmobile', 'txtmobile', 'required');
        $this->form_validation->set_rules('txtemgcnt', 'txtemgcnt', 'required');
        $this->form_validation->set_rules('txtaadhar', 'txtaadhar', 'required');
        $this->form_validation->set_rules('txtpan', 'txtpan', 'required');
        $this->form_validation->set_rules('txtpass', 'txtpass', 'required');
        $this->form_validation->set_rules('l_addr1', 'l_addr1', 'required');
        $this->form_validation->set_rules('l_addr2', 'l_addr2', 'required');
        $this->form_validation->set_rules('l_addr3', 'l_addr3', 'required');
        $this->form_validation->set_rules('l_state', 'l_state', 'required');
        $this->form_validation->set_rules('l_city', 'l_city', 'required');
        $this->form_validation->set_rules('l_zipcode', 'l_zipcode', 'required');
        $this->form_validation->set_rules('p_addr1', 'p_addr1', 'required');
        $this->form_validation->set_rules('p_addr2', 'p_addr2', 'required');
        $this->form_validation->set_rules('p_addr3', 'p_addr3', 'required');
        $this->form_validation->set_rules('p_state', 'p_state', 'required');
        $this->form_validation->set_rules('p_city', 'p_city', 'required');
        $this->form_validation->set_rules('p_zipcode', 'p_zipcode', 'required');
        $this->form_validation->set_rules('txtfather', 'txtfather', 'required');
        $this->form_validation->set_rules('txtfathmail', 'txtfathmail', 'required');
        $this->form_validation->set_rules('txtfathmob', 'txtfathmob', 'required');
        $this->form_validation->set_rules('txtfathaadhar', 'txtfathaadhar', 'required');
        $this->form_validation->set_rules('txtmother', 'txtmother', 'required');
        $this->form_validation->set_rules('txtmothmail', 'txtmothmail', 'required');
        $this->form_validation->set_rules('txtmothmob', 'txtmothmob', 'required');
        $this->form_validation->set_rules('txtmothaadhar', 'txtmothaadhar', 'required');
        $this->form_validation->set_rules('txtbank', 'txtbank', 'required');
        $this->form_validation->set_rules('txtacct', 'txtacct', 'required');
        $this->form_validation->set_rules('txtbranch', 'txtbranch', 'required');
        $this->form_validation->set_rules('txtifsc', 'txtifsc', 'required');


     
       if ($this->form_validation->run())
       {
          $update_employee = array(
                "del_id"=>$this->input->post("txtkitchen_id"),
                "emp_id"=>$this->input->post("txtemp_id"),
                "emp_name"=>$this->input->post("txtemp_name"),
                "Lname"=>$this->input->post("txtLname"),
                "Mname"=>$this->input->post("txtMname"),
                "Gender"=>$this->input->post("txtGender"),
                "emp_role"=>$this->input->post("txtemp_role"),
                "email_id"=>$this->input->post("txtemail_id"),
                "Blood"=>$this->input->post("txtBlood"),
                "Birthdate"=>$this->input->post("txtBirthdate"),
                "Joindate"=>$this->input->post("txtJoindate"),
                "mobile"=>$this->input->post("txtmobile"),
                "emgcnt"=>$this->input->post("txtemgcnt"),
                "aadhar"=>$this->input->post("txtaadhar"),
                "pan"=>$this->input->post("txtpan"),
                "pass"=>$this->input->post("txtpass"),
                "l_address1"=>$this->input->post("l_addr1"),
                "l_address2"=>$this->input->post("l_addr2"),
                "l_address3"=>$this->input->post("l_addr3"),
                "state"=>$this->input->post("l_state"),
                "city"=>$this->input->post("l_city"),
                "zipcode"=>$this->input->post("l_zipcode"),
                "p_address1"=>$this->input->post("p_addr1"),
                "p_address2"=>$this->input->post("p_addr2"),
                "p_address3"=>$this->input->post("p_addr3"),
                "p_state"=>$this->input->post("p_state"),
                "p_city"=>$this->input->post("p_city"),
                "p_zipcode"=>$this->input->post("p_zipcode"),
                "father_name"=>$this->input->post("txtfather"),
                "father_email"=>$this->input->post("txtfathmail"),
                "father_mobile"=>$this->input->post("txtfathmob"),
                "father_aadhar"=>$this->input->post("txtfathaadhar"),
                "mother_name"=>$this->input->post("txtmother"),
                "mother_email"=>$this->input->post("txtmothmail"),
                "mother_mobile"=>$this->input->post("txtmothmob"),
                "mother_aadhar"=>$this->input->post("txtmothaadhar"),
                "bank_name"=>$this->input->post("txtbank"),
                "bank_acct"=>$this->input->post("txtacct"),
                "bank_branch"=>$this->input->post("txtbranch"),
                "bank_ifsc"=>$this->input->post("txtifsc")
          );

         // print_r($update_employee);

          $get_update = $this->update_model->update_emp_deliveryhub($this->input->post("id"),$update_employee);
          if($get_update >= 0)
          {
            echo "<script> alert('Employee profile updated'); </script>";
            echo "<script>window.location.href='".base_url()."deliveryhub/view_employee/';</script>";
          }
          else
          {
            //$this->create_category("vae");
            //echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
        $this->edit_employee();
                // $this->create_category();
          }
       }
       else
       {
          $data['delivery_emp_data'] = $this->select_model->select_user("delivery_employee",$this->uri->segment(3));
        //$data['get_role'] = $this->select_model->get_role_master();

        $this->load->view('headers/deliveryhub_home_header');
        $this->load->view('deliveryhub/delivery_employee',$data);
        $this->load->view('headers/footer');
       }
       
    }
     //18-03-2019(Divya)
    public function delete_employee()
    {
        $get_affected_rows = $this->delete_model->delete_del_employee($this->uri->segment(3));

        if($get_affected_rows)
        {
           redirect(base_url()."deliveryhub/view_employee",'refresh');
        }
    }
	public function logout()
    {
            $this->session->sess_destroy();
            redirect(base_url()."deliveryhub");
	}
}
