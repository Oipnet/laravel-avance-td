<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');

        return view('todos', ['todos' => $response->json()]);
    }
}
