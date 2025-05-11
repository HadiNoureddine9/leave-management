<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'reason' => 'required|string|max:255',
    ]);

    $leave = LeaveRequest::create([
        'user_id' => auth()->id(),
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],
        'reason' => $validated['reason'],
        'status' => 'pending',
    ]);

    return response()->json([
        'message' => 'Leave request submitted successfully',
        'data' => $leave,
    ], 201);
}

}
