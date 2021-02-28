<?php

namespace App\Model;



class PagesColumnModel extends BaseModel {

    const 
        TABLE = "pages_columns",
        COLUMN_ID = "id",
        COLUMN_PAGE_ID = "page_id",
        COLUMN_TEXT = 'text';

    public function getPagesColumnByPageId($page_id) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE. " WHERE " . self::COLUMN_PAGE_ID . " = ?", $page_id);
        return $response;
    }

    public function getPagesColumnById($id) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE. " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }

    public function editPageColumnById($values, $id) {
        $response = $this->database->query("UPDATE " . self::TABLE . " SET",[
            'text' => $values["text"],

        ], "WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
        
    }

    public function insertPageColumnById(array $values, $page_id) {
        $response = $this->database->query("INSERT INTO `pages_columns` (`text`, `page_id`) VALUES (?,?)", $values['text'], $page_id);
        return $response;
    }

    public function deletePageColumnById($id) {
        $response = $this->database->query("DELETE FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }

}