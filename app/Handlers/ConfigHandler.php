<?php

namespace App\Handlers;

use Sentinel;

class ConfigHandler
{
    public function userField()
    {
        return Sentinel::getUser()->id;
        //return auth()->user()->id;
    }
}
