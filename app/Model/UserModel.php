<?php

namespace App\Model;

use App\Model\BaseModel;

class UserModel extends BaseModel {
    const
        TABLE = 'users',
        EMAIL = 'email',
        PASSWORD = 'password',
        NAME = 'name',
        SURNAME = 'surname';


    function getUserByEmail($email) {
        $response = $this->database->fetch('SELECT * FROM ' . TABLE . ' WHERE ' . EMAIL . ' = ? ', $email);
        return $response;
    }

}