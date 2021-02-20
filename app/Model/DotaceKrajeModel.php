<?php

namespace App\Model;



class DotaceKrajeModel extends BaseModel {

    const 
        TABLE = "dotace_kraje",
        COLUMN_ID = "id",
        COLUMN_TEXT = "text";

    public function getDotaceKrajeById($id) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?",$id);
        return $response;
    }


        



}