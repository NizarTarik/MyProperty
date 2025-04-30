<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'property_id',
    ];

    /**
     * Get the user that owns the bookmark.
     */

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
