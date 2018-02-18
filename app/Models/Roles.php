<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Cviebrock\EloquentSluggable\Sluggable;
use Sentinel;

class Roles extends EloquentRole
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function getRolePermissions($id)
    {
        $role = Sentinel::findRoleById($id);
        $sections = array();
        $permissions = array();
        foreach($role->permissions as $key => $value){
            $permissions[]= str_after($key, '.');
            $sections[str_before($key, '.')] = array_unique($permissions);
        }

        return $sections;
    }
}
