<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    // Ajoutez vos méthodes de politique ici, par exemple :
    public function update(User $user, Category $category)
    {
        // Remplacez cette ligne par votre logique d'autorisation.
        // Par exemple, vous pouvez vérifier si l'utilisateur est l'auteur de la catégorie :
        // return $user->id === $category->user_id;
    }
}