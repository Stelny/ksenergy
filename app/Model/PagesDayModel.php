<?php

namespace App\Model;



class PagesDayModel extends BaseModel {

    const 
        TABLE = "pages_day",
        COLUMN_PAGE_ID = "page_id",
        COLUMN_TEXT = 'text',
        COLUMN_TYPE = 'type',
        COLUMN_PAGES_EXTENSION = 'extension';

    public function getPagesDayById($page_id) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE. " WHERE " . self::COLUMN_PAGE_ID . " = ?", $page_id);
        return $response;
    }



}