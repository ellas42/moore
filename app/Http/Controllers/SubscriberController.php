<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\SubscriberConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create($validated);

        Mail::to($subscriber->email)
            ->send(new SubscriberConfirmation($subscriber));

        return response()->json([
            'success' => true,
            'message' => "You're on the list.",
        ]);
    }
}