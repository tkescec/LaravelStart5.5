<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;

class Users extends EloquentUser
{
    /**
     * The Eloquent boats model name.
     *
     * @var string
     */
    //protected static $boatsModel = 'App\Models\Boats\Boat';

    /**
     * Returns the boats relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *//*
    public function boats()
    {
        return $this->hasMany(static::$boatsModel, 'user_id');
    }*/
}
