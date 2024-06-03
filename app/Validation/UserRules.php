<?php

namespace App\Validation;

use App\Models\UsersModel;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data): bool
    {
        try {
            $model = new UsersModel();
            $user = $model->findUserByEmailAddress($data['email']);
            return $data['password'] === $user['password'];
        } catch (\Exception $e) {
            return false;
        }
    }
}