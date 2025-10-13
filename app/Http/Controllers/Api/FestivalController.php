<?php

namespace App\Http\Controllers\Api;

use App\Models\Festivais;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FestivalController extends Controller
{

    public function index(Request $request){
        $query = Festivais::query();
        
        if ($request->has('local')) {
            $query->where('local', 'like', '%' . $request->local . '%');
        }
    
        if ($request->has('artista')) {
            $query->whereJsonContains('artistas', $request->artista);
        }
    
        if ($request->has('data')) {
            $query->whereDate('data_horario', $request->data);
        }
    
        return $query->orderBy('data_horario', 'asc')->paginate(15);
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'data_horario' => 'required|date',
            'capacidade' => 'required|integer|min:1',
            'artistas' => 'required|array',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $credentials['imagem_path'] = $request->file('imagem')->store('posters', 'public');
        unset($credentials['imagem']);

        $festival = $request->user()->festivais()->create($credentials);

        return response()->json($festival, 201);
    }

}
