<?php

namespace App\Model;

use Nette\Database\Connection;

class BaseModel {

	public $database;

    function __construct(Connection $connection) {

    	$this->database = $connection;
    }
}