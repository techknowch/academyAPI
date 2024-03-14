<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['role_or_permission:admin|create-user|edit-user|delete-user']);
    }


    public function store(Request $request)
    {
        if(auth()->check())
        {
            $user = auth()->user();
            return new JsonResponse(['message' => 'Authorized'], 200); // HTTP status code 200 for success
        }
        return new JsonResponse(['message' => 'Unauthorized'], 401); // HTTP status code 401 for unauthorized
    }



        public function showPermissions(Request $request)
        {
            $response = [];

            if (Auth::check()) {
                $user = Auth::user();
                $response['message'] = 'Authorized';
                $response['permissions'] = $user->getAllPermissions()->pluck('name');
                return response()->json($response, 200);
            }

            return response()->json(['message' => 'Unauthorized'], 401);
        }


}
