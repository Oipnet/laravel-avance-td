<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\ProductSchema;
use App\OpenApi\Schemas\ProductLinksSchema;
use App\OpenApi\Schemas\ProductsMetaSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ListProductsResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->statusCode(200)
            ->content(
                MediaType::json()->schema(
                    Schema::object()
                        ->properties(
                            Schema::array('data')->items(ProductSchema::ref()),
                            Schema::ref('#/components/schemas/ProductLinks', 'links'),
                            Schema::ref('#/components/schemas/ProductMeta', 'meta'),
                        )
                )
            );
    }
}
