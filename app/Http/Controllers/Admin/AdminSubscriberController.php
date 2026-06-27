<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()
            ->paginate(20);

        return view('admin.subscribers', compact('subscribers'));
    }
}