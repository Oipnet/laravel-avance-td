<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SizeCollection;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use App\Repositories\SizeRepositoryInterface;

class SizeController extends Controller
{
    public function __construct(
        private SizeRepositoryInterface $sizeRepository
    ) {
    }

    public function index()
    {
        return new SizeCollection($this->sizeRepository->getAll(paginate: true));
    }

    public function show(Size $size)
    {
        return new SizeResource($size);
    }
}
