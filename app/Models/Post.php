<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'category_id', 'is_favourite');
    protected $translatable = ['title', 'content'];

    public function post_category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function delete()
    {
        $this->clients()->detach();
        return parent::delete();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['is_favourite'] = $this->attributes['is_favourite'] ?? 0;
    }
}
