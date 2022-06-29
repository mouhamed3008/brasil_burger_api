<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

[ApiResource(
    normalizationContext: [
        'groups' => ['client:read']
    ],
    denormalizationContext: [
        'groups' => ['client:write']
    ],
    collectionOperations:['GET', 'POST'],
    itemOperations:[
        'GET', 'PUT','PATCH'
    ]
)]

class Catalogue
{
    
}
