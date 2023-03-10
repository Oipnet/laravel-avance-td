<div class="group relative">
    <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
        <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
    </div>
    <div class="mt-4 flex justify-between">
        <div>
            <h3 class="text-sm text-gray-700">
                <a href="{{ route('product_show', $product->slug) }}">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ $product->title }}
                </a>
            </h3>
        </div>
        <p class="text-sm font-medium text-gray-900">{{ $product->formattedPrice }}</p>
    </div>
</div>
