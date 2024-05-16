<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = $request->query('per_page', 10);
        $data = Vehicle::paginate($pagination);

        return response()->json([
            'success' => 'true',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'license_number' => 'required|max:10',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = Vehicle::create([
            'license_number' => $request->license_number,
            'type' => $request->type
        ]);

        return response()-> json([
            'success' => 'true',
            'message' => 'Success create data',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::where('id', $id)->first();

        if(!$vehicle) {
            return response()->json([
                'success' => 'false',
                'message' => 'Data not found'
            ], 400);
        }

        return response()->json([
            'success' => 'true',
            'data' => $vehicle
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'license_number' => 'required|max:10',
                'type' => 'required'
            ]);

            $vehicle = Vehicle::findOrFail($id);

            $vehicle->license_number = $request->license_number;
            $vehicle->type = $request->type;
            $vehicle->save();

            return response()->json([
                'success' => 'true',
                'message' => 'Data updated succesfully',
                'data' => $vehicle
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat mengupdate data kendaraan'
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->delete();

            return response()->json([
                'success' => 'true',
                'message' => 'Data deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menghapus data kendaraan'
            ], 500);
        }
    }
}
