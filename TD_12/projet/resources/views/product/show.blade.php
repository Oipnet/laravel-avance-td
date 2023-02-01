@extends('layouts/app')

@section('content')
    <div class="bg-white">
        <div class="pt-6 pb-16 sm:pb-24">
            <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <ol role="list" class="flex items-center space-x-4">
                    <li class="text-sm">
                        <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $product->category->libelle }}</a>
                    </li>
                </ol>
            </nav>
            <div class="mx-auto mt-8 max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="lg:grid lg:auto-rows-min lg:grid-cols-12 lg:gap-x-8">
                    <div class="lg:col-span-5 lg:col-start-8">
                        <div class="flex justify-between">
                            <h1 class="text-xl font-medium text-gray-900">{{ $product->title }}</h1>
                            <p class="text-xl font-medium text-gray-900">{{ $product->formattedPrice }}</p>
                        </div>
                        <!-- Reviews -->
                        <div class="mt-4">
                            <h2 class="sr-only">Critiques</h2>
                            <div class="flex items-center">
                                <p class="text-sm text-gray-700">
                                    {{ $product->avgReview }}
                                    <span class="sr-only"> sur 5</span>
                                </p>
                                <div aria-hidden="true" class="ml-4 text-sm text-gray-300">·</div>
                                <div class="ml-4 flex">
                                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Voir les {{ $product->countReview }} critiques</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image gallery -->
                    <div class="mt-8 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
                        <h2 class="sr-only">Images</h2>

                        <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-rows-3 lg:gap-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-featured-product-shot.jpg" alt="Back of women&#039;s Basic Tee in black." class="lg:col-span-2 lg:row-span-2 rounded-lg">

                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-product-shot-01.jpg" alt="Side profile of women&#039;s Basic Tee in black." class="hidden lg:block rounded-lg">

                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-product-shot-02.jpg" alt="Front of women&#039;s Basic Tee in black." class="hidden lg:block rounded-lg">
                        </div>
                    </div>

                    <div class="mt-8 lg:col-span-5">
                        <form action="{{ route('order_create', ['product' => $product->slug]) }}" method="POST">
                            @csrf
                            <div class="mt-8">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-sm font-medium text-gray-900">Taille</h2>
                                </div>

                                <fieldset class="mt-2">
                                    <legend class="sr-only">Choisir une taille</legend>
                                    <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
                                        @foreach($product->sizes as $size)
                                            <label class="label-sizes border rounded-md py-3 px-3 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                                                <input type="radio" name="size" value="{{ $size->code }}" class="sr-only" aria-labelledby="size-choice-0-label">
                                                <span id="size-choice-0-label">{{ $size->code }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                            @auth
                                <button type="submit"
                                   class="mt-8 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    Commander
                                </button>
                            @endauth
                            @guest
                                <div class="mt-8 flex w-full gap-1 items-center justify-center">
                                    <a href="{{ route("login") }}" class="w-1/2 text-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Se connecter
                                    </a>
                                    <a href="{{ route("register") }}" class="w-1/2 text-center  rounded-md border border-indigo-600 py-3 px-8 text-base font-medium text-indigo-600 hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Créer un compte
                                    </a>
                                </div>
                            @endguest
                        </form>

                        <!-- Product details -->
                        <div class="mt-10">
                            <h2 class="text-sm font-medium text-gray-900">Description</h2>

                            <div class="prose prose-sm mt-4 text-gray-500">
                                {{ $product->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
