<?php

namespace Trovimap\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Trovimap\Http\Requests\ParcelsByAddressRequest;
use Trovimap\Events\EvaluationCompleted;
use Trovimap\Exception\BaseException;
use Trovimap\Models\TrovimapEvaluation;
use Trovimap\Propertista\TrovimapPhpClient\Models\Request\EvaluationRequest;
use Trovimap\Propertista\TrovimapPhpClient\Trovimap;

class ApartmentController extends BaseController
{
    protected $client;

    public function __construct(Trovimap $client)
    {
        $this->client = $client;
    }

    public function show(Request $request, string $id)
    {

        $reference = $request->get('reference', null);

        $validator = $this->validate($request, [
            'email' => 'required|email',
            'firstName' => 'required|min:6',
            'phone' => 'required|min:9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Por favor, rellene los campos correspodientes',
                'fields' => $validator->errors()
            ], 422);
        }

        $evaluationRequest = new EvaluationRequest($request->all());

        try {
            $data = $this->client->evaluate($id, $evaluationRequest);
            $characteristics = $this->client->getCharacteristics($id);
        } catch (BaseException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getStatus());
        }
        
        $merged = array_merge(
            (array) $data,
            (array) $characteristics
        );

        $trovimapEvaluation = TrovimapEvaluation::create([
            'trovimap_id' => $data->id, 
            'trovi_value' => $data->troviValue,
            'trovi_rent_value' => $data->troviRent,
            'surface_useful' => $request->get('LivingArea'),
            'bedrooms' => $request->get('Bedrooms'),
            'bathrooms' => $request->get('Bathrooms'),
            'data' => json_encode($merged)
        ]);

        event(new EvaluationCompleted($trovimapEvaluation, [
            'email' => $request->get('email'),
            'firstName' => $request->get('firstName'),
            'phone' => $request->get('phone'),
        ], $reference));

        return response()->json($merged);
    }

    public function characteristics(string $id) {
        $data = $this->client->getCharacteristics($id);

        return response()->json($data);
    }
}
