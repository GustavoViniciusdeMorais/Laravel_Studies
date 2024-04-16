<?php

namespace App\Http\StCommands;

class UpperCaseCommand extends Command
{
    public function execute()
    {
        $text = $this->data;

        if(!is_string($text)){
            return false;
        }
        
        return strtoupper($text);
    }
}