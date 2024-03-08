<?php

namespace App\Http\Controllers;

use App\Models\SchedulingEnvironment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SchedulingEnvironmentController extends Controller
{
    private $rules = [
        'course_id' => 'numeric',
        'instructor_id' => 'numeric',
        'date_scheduling' => 'required|date|date_format:Y-m-d',
        'initial_hour' => 'required|string|max:9999999999|min:1',
        'final_hour' => 'required|string|max:9999999999|min:1',
        'environment_id' => 'numeric',
       
    ];

    private $traductionAttributes = array(
        'course_id' => 'curso',
        'instructor_id' => 'instructor',
        'date_scheduling' =>  'fecha de reserva',
        'initial_hour' => 'hora inicial',
        'final_hour' => 'hora final',
        'environment_id' => 'ambiente'
    );


    public function applyValidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if($validator->fails())
        {
            $data = response()->json([
                'errors' => $validator->errors(),
                'data' => $request->all()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduling_environments = SchedulingEnvironment::all();
        $scheduling_environments->load(['course' , 'learning_environment', 'instructor']);
        return response()->json($scheduling_environments , Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }
        
        $scheduling_environment = SchedulingEnvironment::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'scheduling_environment' => $scheduling_environment
        ];
        return response()->json($response, Response::HTTP_CREATED);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(SchedulingEnvironment $scheduling_environment)
    {
        $scheduling_environment->load(['course' , 'learning_environment', 'instructor']);
        return response()->json($scheduling_environment , Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchedulingEnvironment $scheduling_environment)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }
        
        $scheduling_environment->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'scheduling_environment' => $scheduling_environment
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchedulingEnvironment $scheduling_environment)
    {
        $scheduling_environment->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'scheduling_environment' => $scheduling_environment->id
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
    * Agrega una nueva actividad
    */

    

}
