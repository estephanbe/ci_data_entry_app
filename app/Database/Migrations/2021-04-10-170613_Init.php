<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Init extends Migration
{
	private $users_table = 'users';
	private $entries_table = 'entries';
	private $users_fields = array(
		'id' => array(
			'type' => 'INT',
			'constraint' => 5,
			'unsigned' => true,
			'auto_increment' => true
		),
		'username' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'unique' => true,
		),
		'password' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
		),
		'display_name' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
		),
		'is_admin' => array(
			'type' => 'BOOL',
			'default' => 1
		),
		'created_at datetime default current_timestamp',
		'updated_at datetime default current_timestamp on update current_timestamp',
	);
	private $entries_fields = array(
		'id' => array(
			'type' => 'INT',
			'constraint' => 5,
			'unsigned' => true,
			'auto_increment' => true
		),
		'name' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
		),
		'country' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'null' => true
		),
		'nationality' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'null' => true
		),
		'occupation' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'null' => true
		),
		'photo_url' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'null' => true
		),
		'soft_delete' => array(
			'type' => 'BOOLEAN',
			'default' => 0
		),
		'created_at datetime default current_timestamp',
		'updated_at datetime default current_timestamp on update current_timestamp',
	);

	public function up()
	{

		$this->forge->addField($this->users_fields);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable($this->users_table);

		$this->forge->addField($this->entries_fields);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable($this->entries_table);


		$this->add_init_users();
	}

	public function down()
	{
		//
	}

	private function add_init_users()
	{
		$admin_username = 'admin@2018';
		$admin_password = password_hash('admin@2018', PASSWORD_DEFAULT);
		$admin_display_name = 'مدير الموقع';
		$admin_is_admin = 1;
		$admin_sql = "
		INSERT INTO $this->users_table (username, password, display_name, is_admin) VALUES 
			('$admin_username', '$admin_password', '$admin_display_name', $admin_is_admin);
		";

		$user_username = 'user@2018';
		$user_password = password_hash('user@2018', PASSWORD_DEFAULT);
		$user_display_name = 'مستخدم';
		$user_is_admin = 0;
		$user_sql = "
		INSERT INTO $this->users_table (username, password, display_name, is_admin) VALUES 
			('$user_username', '$user_password', '$user_display_name', $user_is_admin);
		";

		$this->db->query($admin_sql);
		$this->db->query($user_sql);
	}
}
