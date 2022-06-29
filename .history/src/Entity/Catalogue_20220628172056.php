<?php

namespace App\Entity;

use App\Repository\CatalogueRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: [
        "get"=>[
            'method'=> 'PATCH',
            'deserialize'=> false,
            'path' => "/users/validate/{token}",
            'controller'=>ValidateEmailActions::class
        ]
],
    itemOperations: []
)]
class Catalogue
{
  
}
