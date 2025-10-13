<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizadorController extends Controller
{
    public function store(Request $request){
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:organizadores',
            'telefone' => 'required|string|max:20',
            'localizacao' => 'required|string|max:255',
        ]);

        $organizer = $request->user()->organizadores()->create($credentials);

        return response()->json([
            'message' => 'organizador criado com sucesso',
            $organizer
        ],201);
    }
}
