<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $from_data = $request->all();
        $slug = Str::slug($request->title, '-');
        $from_data['slug'] = $slug;
        $newType = Type::create($from_data);
        return redirect()->route('admin.types.index')->with('message', 'Type created correctly!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $from_data = $request->all();
        $slug = Str::slug($request->title, '-');
        $from_data['slug'] = $slug;
        $type->update($from_data);
        return redirect()->route('admin.types.index', compact('type'))->with('message', 'Type modified correctly!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index', compact('type'))->with('message_danger', 'Type deleted correctly!!');
    }
}
