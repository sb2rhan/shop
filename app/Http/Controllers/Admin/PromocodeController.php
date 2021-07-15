<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromocodeRequest;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function index()
    {
        $promocodes = Promocode::query()
            ->latest()->paginate();

        return view('admin.promocodes.index', [
            'promocodes' => $promocodes
        ]);
    }

    public function create()
    {
        return view('admin.promocodes.form');
    }

    public function store(PromocodeRequest $request)
    {
        Promocode::query()
            ->create($request->validated());

        return redirect()->route('admin.promocodes.index');
    }

    public function edit(Promocode $promocode)
    {
        return view('admin.promocodes.form', [
            'promocode' => $promocode
        ]);
    }

    public function update(PromocodeRequest $request, Promocode $promocode)
    {
        $promocode->update($request->validated());
        return redirect()->route('admin.promocodes.index');
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('admin.promocodes.index');
    }
}
