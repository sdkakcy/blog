<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $descendants;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->subcategories()->with('children');
    }

    public function hasChildren()
    {
        return $this->children->count() ? true : false;
    }

    public function findDescendants(Category $category)
    {
        $this->descendants[] = $category->id;

        if ($category->hasChildren()) {
            foreach ($category->children as $child) {
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Category $category)
    {
        $this->findDescendants($category);

        return $this->descendants;
    }

    public static function getTree()
    {
        return self::with('children')->whereNull('parent_id')->get();
    }
}
