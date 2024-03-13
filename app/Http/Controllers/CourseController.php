<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseController extends Controller
{
    //
    public function store(Request $request)
    {
        if(auth()->check())
        {
            $user = auth()->user();
            return new JsonResponse(['message' => 'Authorized'], 200); // HTTP status code 200 for success
        }
        return new JsonResponse(['message' => 'Unauthorized'], 401); // HTTP status code 401 for unauthorized
    }

}
