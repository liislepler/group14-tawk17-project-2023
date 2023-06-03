<?php

require __DIR__ . "/../data-access/DinosaurFetcher.php";

class DinosaurService {


    public static function getDescription(){
        $dinosaur_description_fetcher = new DinosaurDescriptionFetcher();
        $description_data = $dinosaur_description_fetcher->getDescription();
        $text = isset($description_data["description"]) ? $description_data["description"] : "";
        return $text;
    }

    public static function getDinosaur() {
        $dinosaur_fetcher = new DinosaurFetcher();

        return $dinosaur_fetcher->getDinosaur();
    }
}
