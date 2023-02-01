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

class ProductSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Product')
            ->properties(
                Schema::integer('id')->default(0),
                Schema::string('title')->default(null),
                Schema::string('slug')->default(null),
                Schema::ref( '#/components/schemas/Category', 'category'),
                Schema::array('sizes')->items(ProductSizeSchema::ref()),
                Schema::string('description')->default(null),
                Schema::integer('price_in_cents')->default(0),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::array('links')->items(Schema::object()->properties(
                    Schema::string("update")->default(route('api_product_update', ['product' => 'lorem-ipsum']))
                ))
            );
    }
}
