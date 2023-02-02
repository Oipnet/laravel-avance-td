<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class ProductLinksSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('ProductLinks')
            ->properties(
                Schema::string("self")->default( route('api_product_index', ['page' => 3])),
                Schema::string("create")->default( route('api_product_create')),
                Schema::string("first")->default(route('api_product_index', ['page' => 1])),
                Schema::string("last")->default(route('api_product_index', ['page' => 1])),
                Schema::string("prev")->default(route('api_product_index', ['page' => 2])),
                Schema::string("next")->default(route('api_product_index', ['page' => 4])),
            );
    }
}
