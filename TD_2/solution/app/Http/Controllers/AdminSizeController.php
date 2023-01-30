<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSizeRequest;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSizeController extends Controller
{
    public function edit(Size $size): View|RedirectResponse
    {
        // $this->authorize('update', $size);
        if (request()->user()->cannot('update', $size)) {
            return redirect()->route('admin_index')->with('success', 'Mise a jour interdite');
        }

        return view('admin.size.edit', compact('size'));
    }

    public function update(EditSizeRequest $editSizeRequest, Size $size) {
        if (request()->user()->cannot('update', $size)) {
            return redirect()->route('admin_index')->with('success', 'Mise a jour interdite');
        }

        $validatedRequest = $editSizeRequest->validated();

        $size->update($validatedRequest);

        return redirect()->route('admin_index')->with('success', 'La taille a bien été mis à jour');
    }
}
