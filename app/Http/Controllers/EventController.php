<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    protected UploadService $uploadService;
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'status' => ['nullable', Rule::in(['past', 'current', 'upcoming'])]
        ]);

        $query = Event::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);

            return response()->json([
                'status' => 'success',
                'data' => EventResource::collection($query->get())
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => EventResource::collection($query->latest()->get())
        ]);
    }

    public function store(EventRequest $request)
    {
        $validated = $request->validated();

        if (!empty($validated['image'])) {
            $validated['image'] = $this->uploadService->upload($validated['image'], 'everycity');
        }

        $event = Event::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => new EventResource($event)
        ], 201);
    }

    public function show(Event $event)
    {
        return response()->json([
            'status' => 'success',
            'data' => new EventResource($event)
        ]);
    }

    public function update(EventRequest $request, Event $event)
    {
        $validated = $request->validated();

        if (!empty($validated['image'])) {
            if ($event->image !== null) {
                $this->uploadService->delete($event->image);
            }
            $validated['image'] = $this->uploadService->upload($validated['image'], 'everycity');
        }
        $event->update($validated);

        return response()->json([
            'status' => 'success',
            'data' => new EventResource($event)
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Event deleted successfully'
        ]);
    }
}
