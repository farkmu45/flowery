<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

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
            'picture' => 'required',
            'character' => 'required',
            'meaning' => 'required',
            'details' => 'required',
        ]);

        $flower = Flower::create($request->all());
        if ($request->hasFile('picture')) {
            $request->file('picture')->move('picflower/', $request->file('picture')->getClientOriginalName());
            $flower->picture = $request->file('picture')->getClientOriginalName();
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
        $flower = Flower::find($id);
        $flower->update($request->all());

        return redirect()->route('flower.index')
            ->with('success_message', 'Successfully change a Flower Data');

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
        $flower->delete();

        return redirect()->route('flower.index')
            ->with('success_message', 'List of Flower successfully deleted');

    }
}
