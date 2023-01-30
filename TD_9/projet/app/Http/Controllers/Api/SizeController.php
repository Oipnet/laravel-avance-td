<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Repositories\SizeRepositoryInterface;

class SizeController extends Controller
{
    public function __construct(
        private SizeRepositoryInterface $sizeRepository
    )
    {
    }

    public function index()
    {
        return $this->sizeRepository->getAll();
    }

    public function show(Size $size)
    {
        return $size;
    }
}
