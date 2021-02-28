<?php

namespace App\Model;

class SettingsModel extends BaseModel 
{
    const 
        TABLE = "settings",
        COLUMN_ID = "id",
        COLUMN_KEY = "meta_key",
        COLUMN_VALUE = "meta_value",
        COLUMN_DESCRIBTION = "describtion";

    public function getSettings() {
       $response = $this->database->fetchAll("SELECT * FROM " . self::TABLE . "");
       return $response;
    }

    public function getSettingsById($id) {
        $response = $this->database->fetch("SELECT * FROM " . self::TABLE . " WHERE " . self::COLUMN_ID . " = ?", $id);
        return $response;
    }

    public function editSettingsById(array $values) {
        $response = $this->database->query("UPDATE " . self::TABLE . " SET",[
            'meta_key' => $values["meta_key"],
            'meta_value' => $values["meta_value"],
            'describtion' => $values["describtion"]

        ], "WHERE " . self::COLUMN_ID . " = ?", $values["id"]);

        return $response;
    }
}