<?php

namespace App\Model;



class DotaceModel extends BaseModel {

    const 
        TABLE = "dotace",
        COLUMN_ID = "id",
        COLUMN_WATT = "watt",
        COLUMN_PHASE = "phase",
        COLUMN_DOTACE_PRICE = "dotace_price",
        COLUMN_PRICE = "price",
        COLUMN_YOUR_PRICE = "your_price",
        COLUMN_LINK = "link",
        COLUMN_PAGE_ID = "page_id",
        COLUMN_DOTACE_KRAJE_ID = "dotace_kraje_id",
        COLUMN_HEADING = "heading",
        COLUMN_CONTENT = "content",
        COLUMN_MENIC = "menic",
        COLUMN_PANEL = "panel",
        COLUMN_PREBYTKY = "prebytky",
        COLUMN_REGULACE = "regulace";



    public function getDotace() {
        $response = $this->database->fetchAll("SELECT * FROM " .  self::TABLE);
        return $response;
    }

    public function getDotaceByPageId($page_id) {
        $response = $this->database->fetchAll("SELECT * FROM " .  self::TABLE . " WHERE page_id = ?", $page_id);
        return $response;
    }

    public function getDotaceById($id) {
        $response = $this->database->fetch("SELECT * FROM " .  self::TABLE . " WHERE id = ?", $id);
        return $response;
    }


    public function updateDotaceById($values) {
        $response = $this->database->query('UPDATE ' . self::TABLE . ' SET',[
            
            'watt' => $values->watt,
            'phase' => $values->phase,
            'dotace_price' => $values->dotace_price,
            'price' => $values->price,
            'your_price' => $values->your_price,
            'heading' => $values->heading,
            'content' => $values->content,
            'menic' => $values->menic,
            'panel' => $values->panel,
            'prebytky' => $values->prebytky,
            'regulace' => $values->regulace,

        ], 'WHERE ' . self::COLUMN_ID . ' = ?', $values->id);
        return $response;
    }


        



}