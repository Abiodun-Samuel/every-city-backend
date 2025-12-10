<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Form;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'events' => $this->getEventAnalytics(),
            'registrations' => $this->getRegistrationAnalytics(),
            'forms' => $this->getFormAnalytics(),
            'recent_events' => $this->getRecentEvents(),
        ]);
    }

    private function getEventAnalytics(): array
    {
        $totalEvents = Event::count();
        $eventsByStatus = Event::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $eventsByType = Event::select('event_type', DB::raw('count(*) as count'))
            ->whereNotNull('event_type')
            ->groupBy('event_type')
            ->pluck('count', 'event_type')
            ->toArray();

        return [
            'total' => $totalEvents,
            'current' => $eventsByStatus['current'] ?? 0,
            'upcoming' => $eventsByStatus['upcoming'] ?? 0,
            'past' => $eventsByStatus['past'] ?? 0,
            'by_type' => $eventsByType,
            'total_capacity' => Event::sum('max_tickets'),
        ];
    }

    private function getRegistrationAnalytics(): array
    {
        $totalRegistrations = Registration::count();
        $totalTickets = Registration::sum('number_of_tickets');

        $topEvents = Event::withCount('registrations')
            ->with('registrations:event_id,number_of_tickets')
            ->having('registrations_count', '>', 0)
            ->orderByDesc('registrations_count')
            ->limit(5)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'registrations_count' => $event->registrations_count,
                    'total_tickets' => $event->registrations->sum('number_of_tickets'),
                    'max_tickets' => $event->max_tickets,
                    'available_tickets' => $event->available_tickets,
                    'occupancy_rate' => $event->max_tickets > 0
                        ? round(($event->registrations->sum('number_of_tickets') / $event->max_tickets) * 100, 2)
                        : 0,
                ];
            });

        // Recent registrations (last 7 days)
        $recentRegistrations = Registration::where('created_at', '>=', now()->subDays(7))
            ->count();

        return [
            'total_registrations' => $totalRegistrations,
            'total_tickets_sold' => $totalTickets,
            'recent_registrations_7_days' => $recentRegistrations,
            'top_events' => $topEvents,
            'average_tickets_per_registration' => $totalRegistrations > 0
                ? round($totalTickets / $totalRegistrations, 2)
                : 0,
        ];
    }

    private function getFormAnalytics(): array
    {
        $totalForms = Form::count();

        $formsByType = Form::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $formsByStatus = Form::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Recent forms (last 7 days)
        $recentForms = Form::where('created_at', '>=', now()->subDays(7))
            ->count();

        return [
            'total' => $totalForms,
            'contact' => $formsByType['contact'] ?? 0,
            'prayer' => $formsByType['prayer'] ?? 0,
            'bhop_application' => $formsByType['bhop_application'] ?? 0,
            'mail_list' => $formsByType['mail_list'] ?? 0,
            'by_status' => $formsByStatus,
            'recent_submissions_7_days' => $recentForms,
            'pending_count' => $formsByStatus['pending'] ?? 0,
        ];
    }

    private function getRecentEvents(): array
    {
        return Event::with(['registrations:event_id,number_of_tickets'])
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'status' => $event->status,
                    'event_type' => $event->event_type,
                    'starts_at' => $event->starts_at->toDateTimeString(),
                    'ends_at' => $event->ends_at->toDateTimeString(),
                    'location' => $event->location,
                    'max_tickets' => $event->max_tickets,
                    'tickets_sold' => $event->registrations->sum('number_of_tickets'),
                    'available_tickets' => $event->available_tickets,
                    'registrations_count' => $event->registrations->count(),
                    'created_at' => $event->created_at->toDateTimeString(),
                ];
            })
            ->toArray();
    }
}
