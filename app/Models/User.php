<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
  protected $table                = 'users';
  protected $allowedFields        = ['username', 'password', 'display_name', 'is_admin'];

  // Callbacks
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data)
  {
    $data = $this->passwordHash($data);
    return $data;
  }

  protected function beforeUpdate(array $data)
  {
    $original_user = $this->find($data['id'][0]);
    if (!empty($data['data']['password']))
      $data = $this->passwordHash($data);
    else
      $data['data']['password'] = $original_user['password'];
    return $data;
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }
}
