<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return Food::all();
    }

    public function show($id)
    {
        return Food::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Food::create($request->all());
    }

    public function update(Request $request, $id)
    {
        try {
            $food = Food::findOrFail($id);
        
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ]);

            $food->update($request->all());

            return $food;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update food. ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $food = Food::findOrFail($id);
            $food->delete();
    
            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete food. ' . $e->getMessage()], 500);
        }
    }
    
}
