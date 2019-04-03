<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_model extends CI_Model
{
	
	public function __construct()
	{
                parent::__construct();
                $this->load->dbforge();
	}


	public function create_inventory_tables($table_name)
	{

		$fields = array(
			array(
        'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'product_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL'
        ),
         'product_sku' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL'
        ),
        'product_units' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL',
        ),
        'product_quantity' => array(
                'type' => 'TEXT',
                'null' => TRUE,
        )
    ),
			array(
        'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'product_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL'
        ),
         'product_sku' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL'
        ),
        'product_units' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL'
        ),
        'product_quantity' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'NULL'
        ),
        'addordel' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
        )

    )
);

$table_names = array("insert_inventory_kitchen_","update_inventory_kitchen_");

			$get_value = null;

			for($i = 0; $i < count($table_names); $i++)
			{
				$this->dbforge->add_field($fields[$i]);
				$this->dbforge->add_field("timestamp timestamp(6) NULL  DEFAULT CURRENT_TIMESTAMP(6)");
				$this->dbforge->add_key('id', TRUE);
				$get_value = $this->dbforge->create_table($table_names[$i].$table_name, FALSE);
			}

			return $get_value;
	}
}

/* End of file Create_model.php */
/* Location: ./application/models/Create_model.php */