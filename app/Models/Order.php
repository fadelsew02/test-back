<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis en masse.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'prix',
        'quantite',
    ];

    /**
     * Relation avec le modèle User (Un utilisateur peut avoir plusieurs commandes).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Product (Une commande est associée à un produit).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
