<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ChirpRequest;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(Request $request): RedirectResponse
    public function store(ChirpRequest $request): RedirectResponse
    {
        // Authorize the request. The incoming request is validated before this method is called.

        // Rertieve the validated input data
        $validated = $request->validated();

        // Create a new chirp for the authenticated user
        $request->user()->chirps()->create($validated);

        // Redirect back to the index page
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChirpRequest $request, Chirp $chirp): RedirectResponse
    {
        // Authorize the request
        $this->authorize('update', $chirp);

        // Rertieve the validated input data
        $validated = $request->validated();

        // Update the chirp
        $chirp->update($validated);

        // Redirect back to the index page
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
