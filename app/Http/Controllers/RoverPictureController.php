<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class RoverPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('RoverPictures/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
