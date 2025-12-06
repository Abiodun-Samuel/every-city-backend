<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\PrayerFormRequest;
use App\Http\Requests\BhopApplicationFormRequest;
use App\Http\Requests\MailListFormRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    public function submitContact(ContactFormRequest $request): JsonResponse
    {
        $form = Form::create([
            'type' => 'contact',
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'message' => 'Contact form submitted successfully',
            'data' => $form
        ], 201);
    }

    public function submitPrayer(PrayerFormRequest $request): JsonResponse
    {
        $form = Form::create([
            'type' => 'prayer',
            'full_name' => $request->full_name,
            'address' => $request->address,
            'type_of_prayer' => $request->type_of_prayer,
            'prayer_request' => $request->prayer_request,
        ]);

        return response()->json([
            'message' => 'Prayer request submitted successfully',
            'data' => $form
        ], 201);
    }

    public function submitBhopApplication(BhopApplicationFormRequest $request): JsonResponse
    {
        $form = Form::create([
            'type' => 'bhop_application',
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'location' => $request->location,
            'church' => $request->church,
            'team_volunteering_to' => $request->team_volunteering_to,
            'want_to_be_part_of_team' => $request->want_to_be_part_of_team,
            'reason' => $request->reason,
        ]);

        return response()->json([
            'message' => 'BHOP application submitted successfully',
            'data' => $form
        ], 201);
    }

    public function submitMailList(MailListFormRequest $request): JsonResponse
    {
        $form = Form::create([
            'type' => 'mail_list',
            'email' => $request->email,
            'full_name' => $request->full_name,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Successfully subscribed to mailing list',
            'data' => $form
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $type = $request->query('type');

        if ($type && !in_array($type, ['contact', 'prayer', 'bhop_application', 'mail_list'])) {
            return response()->json([
                'message' => 'Invalid form type',
                'errors' => ['type' => ['The selected type is invalid.']]
            ], 422);
        }

        $query = Form::query();

        if ($type) {
            $query->where('type', $type);
        }

        $forms = $query->latest()->get();

        return response()->json($forms);
    }

    public function show(Form $form)
    {
        return response()->json($form);
    }
}
