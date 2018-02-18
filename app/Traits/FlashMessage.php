<?php

namespace App\Traits;

trait FlashMessage
{
    /**
     * Flashing a new message.
     *
     * @param  string $type
     * @param  string $msg
     */

     public static function flashing($type, $msg)
     {
         session()->flash($type, $msg);
     }
}
