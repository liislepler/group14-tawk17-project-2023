<?php

require __DIR__ . "/../data-access/DinosaurFetcher.php";

class DinosaurService {
    public static function getName(){
        $dinosaur_fetcher = new DinosaurFetcher();
        $name_data = $dinosaur_fetcher->getName();
        $text = isset($name_data["name"]) ? $name_data["name"] : "";
        return $text;
    }

    public static function getDescription(){
        $dinosaur_description_fetcher = new DinosaurDescriptionFetcher();
        $description_data = $dinosaur_description_fetcher->getDescription();
        $text = isset($description_data["description"]) ? $description_data["description"] : "";
        return $text;
    }
}
