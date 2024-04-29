<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class RoverPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
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
