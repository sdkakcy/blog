<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['summary'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getSummaryAttribute()
    {
        return Str::limit($this->content, 75, '...');
    }
}
