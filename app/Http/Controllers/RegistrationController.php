<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function store(RegistrationRequest $request, Event $event): JsonResponse
    {
        try {
            DB::beginTransaction();

            $event = Event::lockForUpdate()->findOrFail($event->id);

            if (!$event->hasAvailableTickets($request->number_of_tickets)) {
                return response()->json([
                    'message' => 'Not enough tickets available',
                    'available_tickets' => $event->available_tickets
                ], 422);
            }

            $registration = $event->registrations()->create($request->validated());

            DB::commit();

            return response()->json([
                'message' => 'Registration successful',
                'data' => new RegistrationResource($registration),
                'remaining_tickets' => $event->available_tickets
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            if ($e->getCode() === '23000') {
                return response()->json([
                    'message' => 'You have already registered for this event'
                ], 422);
            }
            throw $e;
        }
    }

    public function index(Event $event): JsonResponse
    {
        $registrations = $event->registrations()
            ->latest()
            ->get();

        return response()->json([
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'max_tickets' => $event->max_tickets,
                'available_tickets' => $event->available_tickets,
                'total_registered' => $event->registrations()->sum('number_of_tickets'),
            ],
            'registrations' => RegistrationResource::collection($registrations),
        ]);
    }
}
