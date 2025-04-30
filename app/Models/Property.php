<?php
// Property.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'numberOfRooms',
        'city',
        'address',
        'postalCode', // Add postalCode here
        'owner_id',
        'img'
    ];
    public function boxes()
    {
        return $this->hasMany(Box::class);
    }


    // Define the relationship between Property and Owner
    public function seller()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
