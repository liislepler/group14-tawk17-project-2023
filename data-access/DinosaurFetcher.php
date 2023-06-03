<?php

class DinosaurFetcher
{
    private $base_url = "https://dinosaur-facts-api.shultzlab.com/dinosaurs/random/name";

    public function getName($name)
    {
        $url = $this->base_url . $name;

        $data = file_get_contents($url);

        return json_decode($data, true);
    }
}

class DinosaurDescriptionFetcher 
{
    private $base_url = "https://dinosaur-facts-api.shultzlab.com/dinosaurs/random/description";

    public function getDescription($description)
    {
        $url = $this->base_url . $description;

        $data = file_get_contents($url);

        return json_decode($data, true);
    }
}