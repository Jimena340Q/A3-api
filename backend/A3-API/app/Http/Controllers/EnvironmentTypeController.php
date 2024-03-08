<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EnvironmentTypeController extends Controller
{

    private $rules =[
        'description' =>'required|string|max:100|min:3',
    ];

    private $traductionAttributes = [
        'description' => 'descripción',  

    ];

    public function applyvalidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if ($validator->fails()) 
        {
            $data = response()->json([
                'errors'=>$validator->errors(),
                'data' =>$request->all()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $environment_types = EnvironmentType::all();
        return response()->json($environment_types, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyvalidator($request);
        if (!empty($data))
        {
            return $data;
        }

        $environment_type = EnvironmentType::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'environment_type' => $environment_type
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(EnvironmentType $environment_type)
    {
        return response()->json($environment_type, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnvironmentType $environment_type)
    {
        $data = $this->applyvalidator($request);
        if (!empty($data))
        {
            return $data;
        }

        $environment_type -> update($request ->all(''));
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'environment_type' => $environment_type
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnvironmentType $environment_type)
    {
        $environment_type -> delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'environment_type' => $environment_type->id
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
