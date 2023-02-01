<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\StoreProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreProductRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('Creation de produit')
            ->content(
                MediaType::json()->schema(StoreProductSchema::ref())
            );
    }
}
