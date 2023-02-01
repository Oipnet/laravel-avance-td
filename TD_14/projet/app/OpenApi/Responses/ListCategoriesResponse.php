<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\CategorySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ListCategoriesResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->statusCode(200)
            ->content(
                MediaType::json()->schema(CategorySchema::ref())
            );
    }
}
