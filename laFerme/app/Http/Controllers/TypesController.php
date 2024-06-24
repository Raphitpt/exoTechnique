<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypesController extends Controller
{
    public function index(Request $request)
    {
        $type = Type::all();

        if ($type->isEmpty()) {
            return response()->json(['error'], 404);
        }

        $typeData = $type->map(function ($type) {
            return [
                'id' => $type->id,
                'name' => $type->name,
            ];
        });

        return response()->json($typeData);
    }
}
