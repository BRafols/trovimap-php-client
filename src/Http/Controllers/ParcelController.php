<?php

namespace Trovimap\Http\Controllers;

use Illuminate\Http\Request;
use Trovimap\Http\Requests\ParcelsByAddressRequest;
use Illuminate\Routing\Controller;
use Trovimap\Exception\AddressNotFoundException;
use Trovimap\Exception\BaseException;
use Trovimap\Exception\CadastralReferenceNotFoundException;
use Trovimap\Propertista\TrovimapPhpClient\Trovimap;

class ParcelController extends BaseController
{
    protected $client;

    public function __construct(Trovimap $client)
    {
        $this->client = $client;
    }

    public function index(Request $request) {
        $validator = $this->validate($request, [
            'address' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Por favor, rellene los campos correspodientes',
                'fields' => $validator->errors()
            ], 422);
        }

        try {
            $data = $this->client->getParcelByAddress($validator->getData()['address']);
        } catch (BaseException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getStatus());
        }

        return response()->json($data);
    }

    public function show(Request $request, string $id) {
        $data = $this->client->getBuildingUnitByParcelId($id);

        return response()->json($data);
    }

    public function showByCadastral(string $cadastralReference) {
        try {
            $data = $this->client->getBuildingUnitByCadastralReference($cadastralReference);
        } catch (BaseException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getStatus());
        }

        return response()->json($data);
    }


}
