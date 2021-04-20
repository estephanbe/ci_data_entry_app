<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveSoftDelete extends Migration
{
	public function up()
	{
		$this->forge->dropColumn('entries', 'soft_delete');
	}

	public function down()
	{
		$this->forge->addField(
			array(
				'soft_delete' => array(
					'type' => 'BOOLEAN',
					'default' => 0
				)
			)
		);
	}
}
