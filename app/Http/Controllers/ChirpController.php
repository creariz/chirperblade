<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //Return the chirps index view.
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
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
    public function store(Request $request):RedirectResponse
    {
        //Validate the request.
        $validated = $request->validate([
            'message' => 'required|max:255',
        ]);

        //Create a new chirp.
        $request->user()->chirps()->create($validated);

        //Redirect to the chirps index.
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
    public function edit(Chirp $chirp):View
    {
        //Authorize the request.
        $this->authorize('update', $chirp);

        //Return the chirps edit view.
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp):RedirectResponse
    {
        //Authorize the request.
        $this->authorize('update', $chirp);

        //Validate the request.
        $validated = $request->validate([
            'message' => 'required|max:255',
        ]);

        //Update the chirp.
        $chirp->update($validated);

        //Redirect to the chirps index.
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp):RedirectResponse
    {
        //Authorize the request.
        $this->authorize('delete', $chirp);

        //Delete the chirp.
        $chirp->delete();

        //Redirect to the chirps index.
        return redirect(route('chirps.index'));
    }
    
}
