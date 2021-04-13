<?php

namespace App\Models;

use CodeIgniter\Model;

class Entry extends Model
{
	protected $table                = 'entries';
	protected $allowedFields        = ['name', 'country', 'nationality', 'occupation', 'photo_url', 'soft_delete'];

	// Callbacks
	protected $beforeInsert         = [];
	protected $beforeUpdate         = [];
}
