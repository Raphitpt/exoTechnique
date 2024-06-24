<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        return Animal::all();
    }
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'age' => 'required|integer',
            'description' => 'required|string',
            'state' => 'required|string',
            'pictures' => 'required|string',
            'race_id' => 'nullable|integer',
            'price' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $animal = new Animal();
        $animal->name = $request->name;
        $animal->type_id = $request->type_id;
        $animal->age = $request->age;
        $animal->description = $request->description;
        $animal->state = $request->state;
        $animal->pictures = $request->pictures;
        $animal->race_id = $request->race_id;
        $animal->price = $request->price;

        if ($animal->save()) {
            return response()->json([
                'message' => 'l\'animal a été enregistré avec succès.',
                'animal' => $animal
            ], 201);
        } else {
            return response()->json([
                'message' => 'Impossible d\'enregistrer l\'animal. Veuillez réessayer plus tard.'
            ], 500);
        }
    }
    public function show(Request $request, $id)
    {
        return Animal::find($id);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'age' => 'required|integer',
            'description' => 'required|string',
            'state' => 'required|string',
            'pictures' => 'required|string',
            'race_id' => 'nullable|integer',
            'price' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        $animal = Animal::find($id);
        $animal->name = $request->name;
        $animal->type_id = $request->type_id;
        $animal->age = $request->age;
        $animal->description = $request->description;
        $animal->state = $request->state;
        $animal->pictures = $request->pictures;
        $animal->price = $request->price;

        if ($animal->save()) {
            return response()->json([
                'message' => 'l\'animal a été modifié avec succès.',
                'animal' => $animal
            ], 200);
        } else {
            return response()->json([
                'message' => 'Impossible de modifier l\'animal. Veuillez réessayer plus tard.'
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        $animal = Animal::find($id);
        if ($animal->delete()) {
            return response()->json([
                'message' => 'l\'animal a été supprimé avec succès.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Impossible de supprimer l\'animal. Veuillez réessayer plus tard.'
            ], 500);
        }
    }
}
