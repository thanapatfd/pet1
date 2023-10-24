<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Type;

class PetControllerApi extends Controller
{
    public function pet_list($type_id = null)
    {
        if ($type_id) {
            $pets = Pet::where('type_id', $type_id)->get();
        } else {
            $pets = Pet::all();
        }
        return response()->json(
            array(
                'ok' => true,
                'pets' => $pets,
            )
        );
    }


    public function pet_search(Request $request)
    {

        $query = $request->search_query;
        if ($query) {
            $pets = Pet::where('name', 'like', '%' . $query . '%')->get();
        } else {
            $pets = Pet::all();
        }

        return response()->json(
            array(
                'ok' => true,
                'pets' => $pets,
            )
        );
    }
}
