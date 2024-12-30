<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'prix',
        'user_id',
        'image',
        'quantite'
    ];

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
