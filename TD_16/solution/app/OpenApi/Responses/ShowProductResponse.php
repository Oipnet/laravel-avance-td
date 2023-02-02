<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\ProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ShowProductResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::object()->properties(
                        Schema::ref('#/components/schemas/Product', 'data'),
                        Schema::object('meta')->properties(
                            Schema::string("index")->default(route('api_product_index')),
			                Schema::string("create")->default('api_product_create'),
                        )
                    )
                )
            );
    }
}
