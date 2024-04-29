<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TokenStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TokenStoreRequest $request): JsonResponse
    {
        // Validate the request data
        $validated = $request->validated();

        // Find the user based on the provided user_id
        $user = User::find($validated['user_id']);

        // Create a new API token for the user with the name 'Roverpics' and the ability to 'read'
        $token = $user->createToken('Roverpics', ['read'])->plainTextToken;

        // Return the generated token as JSON response
        return response()->json(['token' => $token]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
