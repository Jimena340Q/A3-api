<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{

    private $rules = [
        'document' => 'required|numeric|max:99999999999999999999|min:3',
        'fullname' => 'required|string|max:100|min:3',
        'sena_email' => 'required|email|max:100',
        'personal_email' => 'required|email|max:100',
        'phone' => 'numeric|max:999999999999999999999999999999|min:3',
        'password' => 'required|string|min:8|max:100',
        'type' => 'required|string|max:20',
        'profile'=> 'required|string|max:120|min:3'
    ];

    private $traductionAttributes = array(
        'document' => 'documento',
        'fullname' => 'nombre',
        'sena_email' => 'correo sena',
        'personal_email' => 'correo personal',
        'phone' => 'telefono',
        'password' => 'contraseña',
        'type' => 'tipo',
        'profile' => 'perfil'    
    );
    
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
        $instructors = Instructor::all();
        return response()->json($instructors, Response::HTTP_OK);
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

        $intructor = Instructor::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'intructor' => $intructor
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $intructor)
    {
        return response()->json($intructor, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $intructor)
    {
        $data = $this->applyvalidator($request);
        if (!empty($data))
        {
            return $data;
        }

        $intructor -> update($request ->all(''));
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'intructor' => $intructor
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $intructor)
    {
        $intructor -> delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'intructor' => $intructor->id
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
