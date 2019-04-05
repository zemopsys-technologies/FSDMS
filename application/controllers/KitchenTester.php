<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KitchenTester extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
       
        //UNIT TEST LIBRARY
        $this->load->library('unit_test');

        //LOADING VALIDATE MODEL
        $this->load->model('validate_model');
        $this->load->model('insert_model');
        $this->load->model('update_model');
        $this->load->model('delete_model');
        $this->load->model('select_model');
        
    }
    //1-4-19(Mounika)
    public function testLogin()
    {
        $data = NULL;
        switch('c')
        {
            case 'a':
            $data = array(
                "email_id"=>"mounika.m@zenopsys.com",
                "password"=>"12345"
            );
            break;

            case 'b':
            $data = array(
                "email_id"=>"divya@gmail.com",
                "password"=>"1245"
            );
            break;

            case 'c':
            $data = array(
                "email_id"=>"",
                "password"=>""
            );
            break;
        }

        //print_r($data);

       $test =  $this->validate_model->get_kitchen_user($data);

       //print_r($test['count']);
       $expected_result = 1;
       $test_name = "Login Validation";
       echo $this->unit->run($test['count'],$expected_result,$test_name);
    }

    //1-4-19(Mounika)
    public function edit_user_dataTest()
    {
        $user_data = array(
			"kitchen_id" => "123",
            "first_name" => "mounika",
		    "last_name" => "marel",
		    "email_id" => "mounika.m@zenopsys.com",
            "user_name" => "mounika"
        //   "password" => $this->input->post("renew_pass")
        );
            $test = $this->update_model->update_kit_ser_profile($user_data['kitchen_id'],$user_data);
       $expected_result = 1;
       $test_name = "User Validation";
       echo $this->unit->run($test,$expected_result,$test_name);
    }
    //2-4-19(Mounika)
    public function edit_kitchen_dataTest()
    {
        $user_data = array(
            "k_id" => "123",
            "k_name" => "kitch",
            "kitchen_type" => "other",
            "k_address1" => "Bangalore",
            "k_address2" => "BSk",
            "k_address3" => "3rd stage",
            "state" => "Karnataka",
            "city" => "Bangalore",
            "zipcode" => "560067"
          );
          $test = $this->update_model->update_kitchen_regprofile($user_data['k_id'],$user_data);
          $expected_result = 1;
          $test_name = "kitchen Details Update";
          echo $this->unit->run($test,$expected_result,$test_name);
           
    }
    //3-4-19(Mounika)
    public function edit_profile_dataTest()
    {
        $user_data = array(
			"kitchen_id" => "125",
			"password" => "1234"
        );
        $test = $this->update_model->update_kit_ser_profile($user_data["kitchen_id"],$user_data);
        $expected_result = 1;
        $test_name = "Change Password";
        echo $this->unit->run($test,$expected_result,$test_name);
        
    }
    //3-4-19(Mounika)
    public function employeeTest()
    {
        $user_data = array(
            "kitchen_id"=>"125",
            "emp_id"=>"1234",
            "emp_name"=>"Mounika",
            "Lname"=>"Marella",
            "Mname"=>"prasad",
            "Gender"=>"Female",
            "emp_role"=>"admin",
            "email_id"=>"mounika@gmail.com",
            "Blood"=>"AB+",
            "Birthdate"=>"1997-02-23",
            "Joindate"=>"2018-06-01",
            "mobile"=>"987678088",
            "emgcnt"=>"777826272",
            "aadhar"=>"80808080",
            "pan"=>"7080080808",
            "pass"=>"908808088",
            "l_address1"=>"Bangalore",
            "l_address2"=>"BSK 3rd stage",
            "l_address3"=>"Karnataka",
            "state"=>"karnataka",
            "city"=>"Bangalore",
            "zipcode"=>"567892",
            "p_address1"=>"kathhriguppe",
            "p_address2"=>"watertankroad",
            "p_address3"=>"Bsk 3rd stage",
            "p_state"=>"Karnataka",
            "p_city"=>"bangalore",
            "p_zipcode"=>"568903",
            "father_name"=>"prasad",
            "father_email"=>"prasad@gmail.com",
            "father_mobile"=>"9087656567",
            "father_aadhar"=>"08080808086",
            "mother_name"=>"vijaya",
            "mother_email"=>"vijaya@gmail.com",
            "mother_mobile"=>"90797777772",
            "mother_aadhar"=>"870098080-8808",
            "bank_name"=>"Andhra",
            "bank_acct"=>"77808080808",
            "bank_branch"=>"guntur",
            "bank_ifsc"=>"9000808080088",
            "approve"=> 0,
            "status"=> 0

      );

      // print_r($user_data);
     $test = $this->insert_model->insert_kitchen_employee($user_data);
     $expected_result = 1;
     $test_name = "Insert Employee";
    echo $this->unit->run($test,$expected_result,$test_name);
    }

    //3-4-19(Mounika)
    public function update_employeeTest()
    {
        $id=7;
        $user_data = array(
            "kitchen_id"=>"1234",
            "emp_id"=>"403",
            "emp_name"=>"Mounika",
            "Lname"=>"Marella",
            "Mname"=>"Mouni",
            "Gender"=>"Female",
            "emp_role"=>"Admin",
            "email_id"=>"m@g.com",
            "Blood"=>"AB+",
            "Birthdate"=>"1997-02-23",
            "Joindate"=>"2018-06-01",
            "mobile"=>"9567890342",
            "emgcnt"=>"9876543242",
            "aadhar"=>"93889922w2w2282182",
            "pan"=>"9498588508483485345",
            "pass"=>"fdg5655765878",
            "l_address1"=>"Bangalore",
            "l_address2"=>"BSK 3rd stage",
            "l_address3"=>"kathriguppe",
            "state"=>"karnataka",
            "city"=>"Bangalore",
            "zipcode"=>"560769",
            "p_address1"=>"p_addr1",
            "p_address2"=>"p_addr2",
            "p_address3"=>"p_addr3",
            "p_state"=>"p_state",
            "p_city"=>"p_city",
            "p_zipcode"=>"p_zipcode",
            "father_name"=>"uyttuy",
            "father_email"=>"huewekhwe",
            "father_mobile"=>"txtfathmob",
            "father_aadhar"=>"txtfathaadhar",
            "mother_name"=>"txtmother",
            "mother_email"=>"txtmothmail",
            "mother_mobile"=>"txtmothmob",
            "mother_aadhar"=>"txtmothaadhar",
            "bank_name"=>"txtbank",
            "bank_acct"=>"txtacct",
            "bank_branch"=>"txtbranch",
            "bank_ifsc"=>"txtifsc"
            
      );
      
      $test = $this->update_model->update_emp_profile($id,$user_data);
      $expected_result = 1;
      $test_name = "Update Employee";
      echo $this->unit->run($test,$expected_result,$test_name);

    } 
    //3-4-19(Mounika)
    public function delete_empTest()
    {
        $id=6;
        $user_data = array(
            "status" => '1'
        );
        $test = $this->update_model->update_emp_status($id,$user_data);
        $expected_result = 1;
      $test_name = "Delete Employee";
      echo $this->unit->run($test,$expected_result,$test_name);

    }

    //4-4-19(Mounika)
    public function insert_emp_roleTest()
    {
        $user_data = array(
            "emp_role"=>"role1"
      );
      $test = $this->insert_model->insert_emp_role($user_data);
      $expected_result = 1;
      $test_name = "Insert Employee Role";
      echo $this->unit->run($test,$expected_result,$test_name);

    }
    //4-4-19(Mounika)
    public function update_emp_roleTest()
    {
        $user_data = array(
            "id" => 7,
            "emp_role" =>"admin"
        );
        $test = $this->update_model->update_role_master($user_data);
        $expected_result = 1;
        $test_name = "Update Employee Role";
        echo $this->unit->run($test,$expected_result,$test_name);

    }


     //4-4-19(Mounika)

     public function delete_roleTest()
     {
         $id=8;
         $test = $this->delete_model->delete_emp_role($id);
         //print_r($test);
         $expected_result = 1;
         $test_name = "Delete Employee Role";
         echo $this->unit->run($test,$expected_result,$test_name);

     }

     //4-4-19(Mounika)

     public function add_stockTest()
     {
        
        $user_data = array(
            "product_name"=>"product1",
            "product_sku"=>"sku1",
            "product_units"=>"unit1",
            "product_quantity"=>"256"
            
        );
        // $insert_kitchen_inventory = $this->insert_model->kitchen_inventory_insert($this->session->userdata('kitchen_id'),$add_stock_insert);
        $test = $this->insert_model->kitchen_inventory_insert('125',$user_data);
        $expected_result = 1;
        $test_name = "adding stock in inventory table";
        echo $this->unit->run($test,$expected_result,$test_name);

        $user_data1 = array(
            "product_name"=>'name',
            "product_sku"=>'sku1',
            "product_units"=>'units',
            "product_quantity"=>'quant',
            "addordel"=>'addordel'
        );
        $test1 = $this->insert_model->kitchen_inventory_update('125',$user_data1);
        $expected_result1 = 1;
        $test_name1 = "updating stock in inventory table";
        echo $this->unit->run($test1,$expected_result1,$test_name1);

        $user_data2 = array(
            "sku" => "sku1",
            "quantity" => "679"
        );
        $test2 = $this->update_model->update_stock_add('125',$user_data2);
        $expected_result2 = 1;
        $test_name2 = "updating quantity in inventory table";
        echo $this->unit->run($test2,$expected_result2,$test_name2);

        $user_data3 = array(
            "kitchen_id" =>'125',
            "delivery_id" =>'456',
            "DC_no" => '9099',
            "product_sku"=>'sku1',
            "product_name"=>'name1',
            "current_quantity" =>'123',
            "obtained_quantity"=>'456'
            
        );

        $test3   = $this->insert_model->insert_RC($user_data3); 
        $expected_result3 = 1;
        $test_name3 = "inserting stock in Rc table";
        echo $this->unit->run($test3,$expected_result3,$test_name3);


        $id=12;
        $test4 = $this->update_model->update_acceptflag($id);
        $expected_result4 = 1;
        $test_name4 = "updating stock in inventory table";
        echo $this->unit->run($test4,$expected_result4,$test_name4);

        
     }


     //4-4-19
     public function deduct_stockTest()
     {
        $user_data = array(
            "product_name"=>'name1',
            "product_sku"=>'sku1',
            "product_units"=>'units1',
            "product_quantity"=>'16',
            "addordel"=>'addordel1'
        );
        $test = $this->insert_model->kitchen_inventory_update_deduct('125',$user_data);
        $expected_result = 1;
        $test_name = "Deducting stock in inventory table";
        echo $this->unit->run($test,$expected_result,$test_name);

        $user_data1 = array(
            "sku" => 'sku1',
            "quantity" => '14'
        );
        //print_r($user_data1);
        $test1 = $this->update_model->update_stock_deduct('125',$user_data1);
        //print_r($test1);
        $expected_result1 = 1;
        $test_name1 = "Deducting stock in inventory table";
        echo $this->unit->run($test1,$expected_result1,$test_name1);
     }

     //5-4-19(Mounika)

     public function kitchen_attendanceTest()
     {
        $user_data = array(
            
            "kitchen_id" => 'kitchenid',
            "employee_id" => 'usertable',
            "employee_name" => 'rowid',
            "employee_role" => 'sku',
            "set_date" => 'name',
            "attendance_flag"=>0
        );
        $test = $this->insert_model->insert_attendance_data($user_data);
        $expected_result = 1;
        $test_name = "Inserting kitchen Attendance";
        echo $this->unit->run($test,$expected_result,$test_name);

        $test1 = $this->select_model->get_attendance_data();
        $expected_result1 = 'is_array';
        $test_name1 = "Selecting kitchen Attendance";
        echo $this->unit->run((array)$test1,$expected_result1,$test_name1);


     }

     public function kitchen_delivery_reportTest()
     {
        $test = $this->select_model->get_delivery_data('125');
        $expected_result = 'is_array';
        $test_name = "Kitchen Delivery";
        echo $this->unit->run((array)$test,$expected_result,$test_name);


     }

     public function ajaxCalldelstatusTest()
    {
       $test = $this->update_model->update_kitchen_delivery('345','123','234');
       $expected_result = 'is_array';
       $test_name = "update status";
       echo $this->unit->run((array)$test,$expected_result,$test_name);

    }

    public function ajaxCallAttendanceTest()
    {
       $test = $this->update_model->update_kitchen_attendance('12345','2019-03-22');
       $expected_result = '1';
       $test_name = "update Attendance";
       echo $this->unit->run($test,$expected_result,$test_name);
    }
}

/* End of file LoginTest.php */
