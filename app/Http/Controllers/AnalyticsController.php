<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function trackEvent(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string',
            'event_name' => 'required|string',
            'parameters' => 'array',
        ]);

        $uuid = $request->input('uuid');
        $eventName = $request->input('event_name');
        $parameters = $request->input('parameters', []);

        try {
            // Check if 'parameters' is an array
            if (!is_array($parameters)) {
                throw new \Exception('Parameters must be an array.');
            }

            // Track the event in the database
            AnalyticsEvent::create([
                'uuid' => $uuid,
                'event_name' => $eventName,
                'parameters' => json_encode($parameters),
            ]);

            return response()->json(['message' => 'Event tracked successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
