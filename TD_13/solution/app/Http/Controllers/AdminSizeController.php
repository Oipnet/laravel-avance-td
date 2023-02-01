<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSizeRequest;
use App\Models\Size;
use App\Repositories\SizeRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminSizeController extends Controller
{
    public function __construct(
        private SizeRepositoryInterface $sizeRepository
    ) {
    }

    public function edit(Size $size): View|RedirectResponse
    {
        // $this->authorize('update', $size);
        if (request()->user()->cannot('update', $size)) {
            return redirect()->route('admin_index')->with('success', 'Mise a jour interdite');
        }

        return view('admin.size.edit', compact('size'));
    }

    public function update(EditSizeRequest $editSizeRequest, Size $size)
    {
        if (request()->user()->cannot('update', $size)) {
            return redirect()->route('admin_index')->with('success', 'Mise a jour interdite');
        }

        $validatedRequest = $editSizeRequest->validated();

        $this->sizeRepository->update($validatedRequest, $size->id);

        return redirect()->route('admin_index')->with('success', 'La taille a bien été mis à jour');
    }
}
