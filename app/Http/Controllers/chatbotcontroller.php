<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatbotcontroller extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'input' => 'required|string',
            'response' => 'required|string',
        ]);

        \App\Models\chatbot_data::create($validatedData);

        return response()->json(['message' => 'Chatbot data stored successfully'], 201);
    }
}
