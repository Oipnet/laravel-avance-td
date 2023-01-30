@extends('layouts/app')

@section('content')
    <div class="bg-white">
        <div class="py-16 sm:py-24 xl:mx-auto xl:max-w-7xl xl:px-8">
            <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 xl:px-0">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Boutique par Categories</h2>
            </div>

            <div class="mt-4 flow-root">
                <div class="-my-2">
                    <div class="relative box-content h-80 overflow-x-auto py-2 xl:overflow-visible">
                        <div
                            class="min-w-screen-xl absolute flex space-x-8 px-4 sm:px-6 lg:px-8 xl:relative xl:grid xl:grid-cols-5 xl:gap-x-8 xl:space-x-0 xl:px-0">
                            <a href="#"
                               class="relative flex h-80 w-56 flex-col overflow-hidden rounded-lg p-6 hover:opacity-75 xl:w-auto">
              <span aria-hidden="true" class="absolute inset-0">
                <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-category-01.jpg" alt=""
                     class="h-full w-full object-cover object-center">
              </span>
                                <span aria-hidden="true"
                                      class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-gray-800 opacity-50"></span>
                                <span
                                    class="relative mt-auto text-center text-xl font-bold text-white">Nouveautés</span>
                            </a>
                            @each('partials._category-card', $categories, 'category')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
