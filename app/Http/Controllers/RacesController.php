<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;

class RacesController extends Controller
{
    public function index(Request $request)
    {
        $race = Race::where("type_id", $request->type_id)->get();

        if ($race->isEmpty()) {
            return response()->json(['message' => 'Animaux non trouvés'], 200);
        }

        $raceData = $race->map(function ($race) {
            return [
                'id' => $race->id,
                'name' => $race->name,
                'type_id' => $race->type_id,
            ];
        });

        return response()->json($raceData);
    }
}
