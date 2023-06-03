<?php

class DinosaurFetcher
{
    private $base_url = "https://dinosaur-facts-api.shultzlab.com/dinosaurs/random/name";

    public function getName()
    {
        $url = $this->base_url;

        $data = file_get_contents($url);

        return json_decode($data, true);
    }
}

class DinosaurDescriptionFetcher 
{
    private $base_url = "https://dinosaur-facts-api.shultzlab.com/dinosaurs/random/description";

    public function getDescription()
    {
        $url = $this->base_url;

        $data = file_get_contents($url);

        return json_decode($data, true);
    }
}