<?php

namespace App\Http\Controllers;

use App\Models\Animal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $animals = Animal::with(['type.tax', 'race'])->orderBy('name', 'asc')->get();

        if ($animals->isEmpty()) {
            return response()->json(['error' => 'Animaux non trouvés'], 404);
        }

        $animalData = $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'type' => $animal->type->name ?? null,
                'tax' => optional($animal->type->tax)->value ?? null,
                'race' => $animal->race->name ?? null,
                'age' => $animal->age,
                'description' => $animal->description,
                'state' => $animal->state,
                'pictures' => json_decode($animal->pictures),
                'price' => $animal->price,
            ];
        });

        return response()->json($animalData);
    }
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'age' => 'required|integer',
            'description' => 'required|string',
            'state' => 'required|string',
            'pictures.*' => 'required|image|max:1024',
            'race_id' => 'nullable|integer',
            'price' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $animal = new Animal();

        $picturesPaths = [];
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $path = $file->store('public/images');
                $path = str_replace('public', '', $path);
                $picturesPaths[] = $path;
            }
        }

        $animal->name = $request->name;
        $animal->type_id = $request->type_id;
        $animal->age = $request->age;
        $animal->description = $request->description;
        $animal->state = $request->state;
        if (!empty($picturesPaths)) {
            $animal->pictures = json_encode($picturesPaths);
        }
        $animal->race_id = $request->race_id;
        $animal->price = $request->price;


        try {
            $animal->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Impossible de modifier l\'animal. Veuillez réessayer plus tard.',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'L\'animal a été modifié avec succès.',
            'animal' => $animal
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $animal = Animal::with(['type.tax', 'race'])->find($id);

        if (!$animal) {
            return response()->json(['error' => 'Animal non trouvé'], 404);
        }

        return response()->json([
            'id' => $animal->id,
            'name' => $animal->name,
            'type' => $animal->type->name ?? null,
            'type_id' => $animal->type_id,
            'tax' => $animal->type->tax->value ?? null,
            'race' => $animal->race->name ?? null,
            'race_id' => $animal->race_id,
            'age' => $animal->age,
            'description' => $animal->description,
            'state' => $animal->state,
            'pictures' => json_decode($animal->pictures),
            'price' => $animal->price,
        ]);
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'age' => 'required|integer',
            'description' => 'required|string',
            'state' => 'required|string',
            'pictures.*' => 'required|image|max:1024',
            'race_id' => 'nullable|integer',
            'price' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $animal = Animal::findOrFail($id);

        $picturesPaths = [];
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $path = $file->store('public/images');
                $path = str_replace('public', '', $path);
                $picturesPaths[] = $path;
            }
        }

        $animal->name = $request->name;
        $animal->type_id = $request->type_id;
        $animal->age = $request->age;
        $animal->description = $request->description;
        $animal->state = $request->state;
        if (!empty($picturesPaths)) {
            $animal->pictures = json_encode($picturesPaths);
        }
        $animal->race_id = $request->race_id;
        $animal->price = $request->price;

        try {
            $animal->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Impossible de modifier l\'animal. Veuillez réessayer plus tard.',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'L\'animal a été modifié avec succès.',
            'animal' => $animal
        ], 200);
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

    public function findByType(Request $request, $type_id)
    {

        if ($type_id == 0) {
            $animals = Animal::with(['type.tax', 'race'])->orderBy('name', 'asc')->get();
        } else {
            $animals = Animal::where('type_id',  $type_id)->with(['type.tax', 'race'])->orderBy('name', 'asc')->get();
        }



        if ($animals->isEmpty()) {
            return response()->json(['message' => 'Animaux non trouvés'], 200);
        }

        $animalData = $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'type' => $animal->type->name ?? null,
                'type_id' => $animal->type_id,
                'tax' => $animal->type->tax->value ?? null,
                'race' => $animal->race->name ?? null,
                'race_id' => $animal->race_id,
                'age' => $animal->age,
                'description' => $animal->description,
                'state' => $animal->state,
                'pictures' => json_decode($animal->pictures),
                'price' => $animal->price,
            ];
        });

        return response()->json($animalData);
    }

    public function findByRace(Request $request, $type_id, $race_id)
    {

        if ($race_id == 0) {
            $animals = Animal::where('type_id',  $type_id)->with(['type.tax', 'race'])->orderBy('name', 'asc')->get();
        } else {
            $animals = Animal::where('race_id',  $race_id)->with(['type.tax', 'race'])->orderBy('name', 'asc')->get();
        }

        if ($animals->isEmpty()) {
            return response()->json(['message' => 'Animaux non trouvés'], 200);
        }

        $animalData = $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'type' => $animal->type->name ?? null,
                'type_id' => $animal->type_id,
                'tax' => $animal->type->tax->value ?? null,
                'race' => $animal->race->name ?? null,
                'race_id' => $animal->race_id,
                'age' => $animal->age,
                'description' => $animal->description,
                'state' => $animal->state,
                'pictures' => json_decode($animal->pictures),
                'price' => $animal->price,
            ];
        });

        return response()->json($animalData);
    }
}
