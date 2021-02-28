<?php

namespace App\Model;


class GalleryModel extends BaseModel 
{
    const 
        TABLE = "gallery",
        COLUMN_ID = "id",
        COLUMN_EXTENSION = "extension";

    
    public function getGallery($order = 'ASC') {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE . " ORDER BY id " . $order);
        return $response;
    }

    
    public function getGalleryById($id) {
        $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }

    public function insertImage($extension) {
        $response = $this->database->fetchAll("INSERT INTO " . self::TABLE . " (" . self::COLUMN_EXTENSION . ") VALUES (?)", $extension);
        return $response;
    }

    public function deleteImage($id) {
        $response = $this->database->query("DELETE FROM " . self::TABLE . " WHERE " . self::COLUMN_ID .  " = ?" , $id);
        return $response;
    }

}