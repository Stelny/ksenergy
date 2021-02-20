<?php

namespace App\Model;


class PagesModel extends BaseModel {
    const 
        TABLE = "pages",
        COLUMN_ID = "id",
        COLUMN_HEADING = "heading",
        COLUMN_SUBHEADING = "subHeading",
        COLUMN_INFO = "info",
        COLUMN_EXTENSION = "extension",
        COLUMN_NAME = "name",
        COLUMN_CATEGORY = "category";

    public function getPage(string $category,string $name) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_CATEGORY . " = ? AND " . self::COLUMN_NAME . " = ?", $category, $name);
        return $response;
    }

    public function getPageByCategory(string $category) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_CATEGORY . " = ?", $category);
        return $response;
    }

    public function getAllPages() {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . "");
        return $response;
    }

    public function getPageById(int $id) { 
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }






}