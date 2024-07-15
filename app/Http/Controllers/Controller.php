<?php

namespace App\Http\Controllers;

use App\Events\WebSocketEvent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function incrementParticipants()
    {
       /* $response = Http::get('http://127.0.0.1:8000/laravel-websockets/api/websockets/statistics');


        if ($response->successful()) {
            $statistics = $response->json();

            $usersCount = $statistics['statistics']['websocket']['connected_clients'];

            // $usersCount now contains the count of connected users
            echo "Number of connected users: $usersCount";
        } else {
            echo 'Failed to fetch statistics from the WebSocket server.';
        }*/
        $participants = 0;

            // Increment the participant count
            $participants++;

        // Update the participant count in your database or any other source

        // Dispatch the WebSocket event to notify connected clients
        event(new WebSocketEvent($participants));

        return response()->json(['success' => true]);
    }
}
