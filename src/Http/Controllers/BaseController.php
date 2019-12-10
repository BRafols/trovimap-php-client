<?php

namespace Trovimap\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseController extends Controller {
    
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = []) {
        return Validator::make($request->all(), $rules, $messages, $customAttributes);
    }
}