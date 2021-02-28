<?php

namespace App\Model;


class BlogModel extends BaseModel  {

    const 
        TABLE = "blog",
        COLUMN_ID = "id",
        COLUMN_HEADING = "heading",
        COLUMN_HEADING_WEB = "heading_web",
        COLUMN_CONTENT = "content",
        COLUMN_EXTENSION = "extension";


    public function getBlog() {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE);
        return $response;
    }

    /*public function getBlogById($id) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }

    public function getBlogByName($name) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_HEADING_WEB. " = ?", $name);
        return $response;
    }

    public function insertBlog($heading, $heading_web, $content, $extension, $date) {
        $response = $this->database->fetchAll("INSERT INTO " . self::TABLE . " (heading, heading_web, content, extension, date) VALUES (?, ?, ?, ?, ?) ", $heading, $heading_web, $content, $extension, $date);
        return $response;
    }*/

}