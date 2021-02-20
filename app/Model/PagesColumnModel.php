<?php

namespace App\Model;



class PagesColumnModel extends BaseModel {

    const 
        TABLE = "pages_columns",
        COLUMN_PAGE_ID = "page_id",
        COLUMN_TEXT = 'text';

    public function getPagesColumnById($page_id) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE. " WHERE " . self::COLUMN_PAGE_ID . " = ?", $page_id);
        return $response;
    }
}