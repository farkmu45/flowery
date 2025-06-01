<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flower = Flower::all();
        $menuflower = 'active';

        return view('flower.index_flower', compact('menuflower', 'flower'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuflower = 'active';

        return view('flower.create', compact('menuflower'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'flower_name' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'character' => 'required',
            'meaning' => 'required',
            'details' => 'required',
        ]);

        $flower = Flower::create($request->except('picture'));

        if ($request->hasFile('picture')) {
            $storedFile = $request->file('picture')->store();
            $flower->picture = $storedFile;
            $flower->save();
        }

        return redirect()->route('flower.index')->with('success_message', 'New flower successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $flower = Flower::find($id);
        if (! $flower) {
            return redirect()->route('flower.index')
                ->with('error_message', 'Flower with ID'.$id.'not found');
        }

        return view('flower.edit', [
            'flower' => $flower,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'flower_name' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'character' => 'required',
            'meaning' => 'required',
            'details' => 'required',
        ]);

        $flower = Flower::find($id);
        if (!$flower) {
            return redirect()->route('flower.index')
                ->with('error_message', 'Flower with ID ' . $id . ' not found');
        }

        // Handle picture update
        if ($request->hasFile('picture')) {
            // Delete old picture if it exists
            if ($flower->picture && Storage::disk('s3')->exists($flower->picture)) {
                Storage::disk('s3')->delete($flower->picture);
            }

            // Store new picture
            $storedFile = $request->file('picture')->store('flowers', 's3');
            $flower->picture = $storedFile;
        }

        // Update other fields
        $flower->flower_name = $request->flower_name;
        $flower->character = $request->character;
        $flower->meaning = $request->meaning;
        $flower->details = $request->details;
        $flower->save();

        return redirect()->route('flower.index')
            ->with('success_message', 'Successfully updated flower data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $flower = Flower::find($id);

        if (!$flower) {
            return redirect()->route('flower.index')
                ->with('error_message', 'Flower with ID ' . $id . ' not found');
        }

        // Delete the image from S3 storage if it exists
        if ($flower->picture && Storage::disk('s3')->exists($flower->picture)) {
            Storage::disk('s3')->delete($flower->picture);
        }

        $flower->delete();

        return redirect()->route('flower.index')
            ->with('success_message', 'Flower successfully deleted');
    }
}
