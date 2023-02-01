<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\OpenApi\Parameters\ListProductsParameters;
use App\OpenApi\RequestBodies\StoreProductRequestBody;
use App\OpenApi\Responses\CreateProductResponse;
use App\OpenApi\Responses\ListProductsResponse;
use App\OpenApi\Responses\ShowProductResponse;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * Liste des produits
     */
    #[OpenApi\Operation(tags: ['Product'], method: Request::METHOD_GET)]
    #[OpenApi\Parameters(
        factory: ListProductsParameters::class
    )]
    #[OpenApi\Response(factory: ListProductsResponse::class)]
    public function index(): ProductCollection
    {
        return new ProductCollection(
            $this->productRepository->getAll(
                with: ['category', 'sizes'],
                paginate: true
            )
        );
    }

    /**
     * Consulter un produit
     * @param Product $product Slug du produit
     * @return ProductResource
     */
    #[OpenApi\Operation(tags: ['Product'], method: Request::METHOD_GET)]
    #[OpenApi\Response(factory: ShowProductResponse::class)]
    public function show(Product $product)
    {
        $product->load(['category', 'sizes']);

        return new ProductResource($product);
    }

    /**
     * Creer un nouveau produit
     */
    #[OpenApi\Operation(tags: ['Product'], method: Request::METHOD_POST)]
    #[OpenApi\RequestBody(factory: StoreProductRequestBody::class)]
    #[OpenApi\Response(factory: CreateProductResponse::class)]
    public function create(Request $request)
    {
        return response(status: 201);
    }

    public function update()
    {}
}
