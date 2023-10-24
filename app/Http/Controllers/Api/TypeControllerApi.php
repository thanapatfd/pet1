<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeControllerApi extends Controller
{
    public function type_list()
    {
        $types = Type::all();
        return response()->json(array('ok' => true, 'types' => $types));
    }
}
