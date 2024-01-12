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

        // Track the event in the database
        AnalyticsEvent::create([
            'uuid' => $uuid,
            'event_name' => $eventName,
            'parameters' => $parameters,
        ]);

        // You can add additional logic or responses here based on your requirements

        return response()->json(['message' => 'Event tracked successfully']);
    }
}
