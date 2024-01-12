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

    public function getEventsByType(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
        ]);

        $eventName = $request->input('event_name');

        $events = AnalyticsEvent::where('event_name', $eventName)->get();

        return response()->json($events);
    }

    public function getEventsByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $events = AnalyticsEvent::whereBetween('created_at', [$startDate, $endDate])->get();

        return response()->json($events);
    }

    public function getEventsForGraph(Request $request)
    {
        // Customize this function based on the specific requirements for graph data
        // This is just a placeholder
        $events = AnalyticsEvent::all();

        return response()->json($events);
    }
}
