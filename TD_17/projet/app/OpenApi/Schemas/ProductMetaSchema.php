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

class ProductMetaSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('ProductMeta')
            ->properties(
                Schema::integer("current_page")->default(1),
                Schema::integer("from")->default(1),
                Schema::integer("last_page")->default(1),
                Schema::array("links")->items(
                    Schema::object()->properties(
                        Schema::string("url"),
                        Schema::string("label"),
                        Schema::string("active"),
                    )
                ),
                Schema::string("path")->default(route('api_product_index')),
                Schema::integer("per_page")->default(15),
                Schema::integer("to")->default(15),
                Schema::integer("total")->default(15),
            );
    }
}
