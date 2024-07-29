<?php

namespace App\Http\StCommands;

class UrlShortCommand extends Command
{
    public function execute()
    {
        $url = $this->data;

        $valid = filter_var($url, FILTER_VALIDATE_URL);

        if(!$valid){
            return false;
        }

        $url = str_replace(['http://','https://'], '', $url);
        $url = str_replace('.com', '', $url);
        // dd($url);

        $url = substr($url, 0, 5);
        $urlLenght = strlen($url);

        if($urlLenght === 5){
            return strtoupper($url);
        }else{
            return $this->fixShortUrl($urlLenght, $url);
        }
    }

    public function fixShortUrl($urlLenght, $url)
    {
        $amtLetters = 5 - $urlLenght;

        for($i = 0; $i < $amtLetters; $i++){
            $url .= 'x';
        }
        // dd($url);
        return strtoupper($url);
    }
}