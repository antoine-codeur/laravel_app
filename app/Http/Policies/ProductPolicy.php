<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    // Ajoutez vos méthodes de politique ici, par exemple :
    public function update(User $user, Product $product)
    {
        // Remplacez cette ligne par votre logique d'autorisation.
        // Par exemple, vous pouvez vérifier si l'utilisateur est l'auteur du produit :
        // return $user->id === $product->user_id;
    }
}