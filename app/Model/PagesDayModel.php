<?php

namespace App\Model;



class PagesDayModel extends BaseModel {

    const 
        TABLE = "pages_day",
        COLUMN_TEXT = 'text',
        COLUMN_TYPE = 'type';

    public function getPagesDayByCategory($category) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE . " WHERE category = ?", $category);
        return $response;
    }



}