<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','content','draft'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Save page.
     *
     * @param array $data
     * @return void
     */
    public function savePage($data = array())
    {
        $this->fill($data)->save();

    }

    /**
     * Update page.
     *
     * @param array $data
     * @return void
     */
    public function updatePage($data = array())
    {
        $this->update($data);

    }
}
