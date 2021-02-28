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

    public function getBlogById($id) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }

    public function getBlogByName($name) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_HEADING_WEB. " = ?", $name);
        return $response;
    }

    public function insertBlog($heading, $heading_web, $content, $extension, $date) {
        $response = $this->database->query("INSERT INTO " . self::TABLE . " (heading, heading_web, content, extension, date) VALUES (?, ?, ?, ?, ?) ", $heading, $heading_web, $content, $extension, $date);
        return $response;
    }

    public function deleteBlog($id) {
        $response = $this->database->query("DELETE FROM " . self::TABLE . " WHERE id = ?", $id);
        return $response;
    }

    public function editPageById($heading, $heading_web, $content, $extension, $id) {
        $response = $this->database->query("UPDATE " . self::TABLE . " SET",[
            'heading' => $heading,
            'heading_web' => $heading_web,
            'content' => $content,
            'extension' => $extension

        ], "WHERE " . self::COLUMN_ID . " = ?", $id);

        $id = $this->database->getInsertId();

        return $id;
        
    }

}