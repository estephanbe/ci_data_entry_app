<?php

namespace App\Validation;

use App\Models\User;

class UserRules
{

  public function validateUser(string $str, string $fields, array $data)
  {
    $model = new User();
    $user = $model->where('username', $data['username'])
      ->first();

    if (!$user)
      return false;

    return password_verify($data['password'], $user['password']);
  }
}
