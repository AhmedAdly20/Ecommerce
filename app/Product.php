<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
// use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use Searchable;
    
    protected $fillable = ['quantity'];
    // use SearchableTrait;
    
    // protected $searchable = [
    //     /**
    //      * Columns and their priority in search results.
    //      * Columns with higher values are more important.
    //      * Columns with equal values have equal importance.
    //      *
    //      * @var array
    //      */
    //     'columns' => [
    //         'name' => 10,
    //         'details' => 5,
    //         'description' => 2,
    //     ],
    // ];

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $extraFields = [
            'categories' => $this->categories->pluck('name')->toArray(),
        ];

        return array_merge($array, $extraFields);
    }
}
