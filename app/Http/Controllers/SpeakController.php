<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use  Illuminate\Http\Request;

class SpeakController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = $request->all();

        return view('speak.index');
    }

    public function processVoice(Request $request)
    {
        $userText = $request->input('text'); // The code or prompt to get suggestions for
//        dd($userText);
        // Initialize the HTTP client
        $client = new Client();

        // Make the request to OpenAI's new endpoint with an updated model
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo', // Or 'gpt-4' if you have access to GPT-4
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an AI assistant helping with code generation and suggestions.'],
                    ['role' => 'user', 'content' => $userText], // The input text or code to process
                ],
                'max_tokens' => 100, // Adjust the number of tokens (characters) for the response
                'temperature' => 0.5, // Adjust for creativity and randomness in the suggestions
            ]
        ]);

        // Decode the response from OpenAI
        $data = json_decode($response->getBody(), true);

        // Extract the AI's response
        $aiResponse = $data['choices'][0]['message']['content'] ?? 'Sorry, I could not process that.';
//        dd($data, $aiResponse);
        // Return the AI's response as JSON
        return response()->json(['reply' => $aiResponse]);
    }

    public function subscriptionPlanIndex(Request $request){
        return view('speak.subscription-plan');
    }
}
