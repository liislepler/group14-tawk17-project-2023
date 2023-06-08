<?php

require __DIR__ . "/../data-access/DinosaurFetcher.php";

class DinosaurService {

    public static function getDinosaur() {
        $dinosaur_fetcher = new DinosaurFetcher();

        return $dinosaur_fetcher->getDinosaur();
    }
}
