<?php

namespace Trovimap\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Trovimap\Propertista\TrovimapPhpClient\Trovimap;

class EvaluationController extends Controller
{
    protected $client;
    protected $validator;

    public function __construct(Trovimap $client)
    {
        $this->client = $client;
    }

    public function download(string $id) {

        $path = public_path($id);

        $this->client->download($id, $path);

        return response()->download($path);
    }
}
