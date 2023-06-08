<?php

class DinosaurFetcher
{
    private $base_url = "https://dinosaur-facts-api.shultzlab.com/dinosaurs/random";

    public function getDinosaur()
    {
        $url = $this->base_url;

        $data = file_get_contents($url);

        return json_decode($data, true);
    }
}
