<?php

namespace App\Http\Controllers;

use App\Models\LearningEnvironment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LearningEnvironmentController extends Controller
{
    private $rules =[
       
        'name' =>'required|string|max:50|min:3',
        'capacity' => 'numeric|max:9999999999',
        'area_mt2' => 'numeric|max:9999999999|min:2',
        'floor' => 'required|string|max:1',
        'inventory' => 'string|max:150',
        'type_id' => 'numeric',
        'location_id' => 'numeric',
        'status' => 'string|max:20|min:5'


    ];
    private $traductionAttributes = [

        'name' => 'nombre',
        'capacity' => 'capacidad',
        'area_mt2' => 'area_mt2',
        'floor' => 'piso',
        'inventory' => 'inventario',
        'type_id' => 'tipo',
        'location_id' => 'ubicación',
        'status' => 'estado'

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
        $learning_environments = LearningEnvironment::all();
        $learning_environments->load(['environment_type','location']); 
        return response()->json($learning_environments, Response::HTTP_OK);
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

        $learning_environment = LearningEnvironment::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'learning_environmet' => $learning_environment
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningEnvironment $learning_environment)
    {
        $learning_environment->load(['environment_type','location']);
        return response()->json($learning_environment, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LearningEnvironment $learning_environment)
    {
        $data = $this->applyvalidator($request);
        if (!empty($data))
        {
            return $data;
        }

        $learning_environment -> update($request ->all(''));
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'learning_environment' => $learning_environment
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningEnvironment $learning_environment)
    {
        $learning_environment -> delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'learning_environment' => $learning_environment->id
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
