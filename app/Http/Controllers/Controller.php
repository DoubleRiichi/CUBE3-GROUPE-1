<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

abstract class Controller
{
    protected $model;
    protected $viewPath;

    protected function getModelById($id)
    {
        $item = $this->model::find($id);
        if ($item === null) {
            abort(404);
        }
        return $item;
    }

    public function index()
    {
        $items = $this->model::all();
        return view($this->viewPath . 'index', compact('items'));
    }

    public function show($id)
    {
        $item = $this->getModelById($id);
        return view($this->viewPath . 'show', compact('item'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(Request $request)
    {
        $this->model::create($request->all());
        return redirect()->route($this->viewPath . 'index')
                         ->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = $this->getModelById($id);
        return view($this->viewPath . 'edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->getModelById($id);
        $item->update($request->all());
        return redirect()->route($this->viewPath . 'index')
                         ->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = $this->getModelById($id);
        $item->delete();
        return redirect()->route($this->viewPath . 'index')
                         ->with('success', 'Item deleted successfully.');
    }
}
