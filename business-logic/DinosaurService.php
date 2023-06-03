<?php

require __DIR__ . "/../data-access/DinosaurFetcher.php";

class DinosaurService {
    public static function getName($name){
        $dinosaur_fetcher = new DinosaurFetcher();

        $name_data = $dinosaur_fetcher->getName($name);

        $text = isset($name_data["text"]) ? $name_data["text"] : "";

        return $text;
    }

    public static function getDescription($name, $description){
        $dinosaur_fetcher = new DinosaurDescriptionFetcher ();

        $description_data = $dinosaur_fetcher->getDescription ($name, $description);

        $text = isset($description_data["text"]) ? $description_data["text"] : "";

        return $text;
    }
}
