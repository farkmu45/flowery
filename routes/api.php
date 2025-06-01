<?php

use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('flowers', function () {
    $flowers = Flower::all()->map(fn($flower) => [
        'id' => $flower->id,
        'name' => $flower->flower_name,
        'picture' => asset($flower->picture),
        'character' => $flower->character,
        'meaning' => $flower->meaning,
        'details' => $flower->details,
        'created_at' => $flower->created_at,
        'updated_at' => $flower->updated_at,
    ]);
    return ['data' => $flowers];
});
