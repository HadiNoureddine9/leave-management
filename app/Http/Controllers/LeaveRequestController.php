<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return LeaveRequest::with('user')->get();
        }

        return $user->leaveRequests()->with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        return LeaveRequest::create([
            'user_id' => Auth::id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'status' => 'Pending',
        ]);
    }

    public function show($id)
    {
        return LeaveRequest::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);

        /** @var \App\Models\User */
        $user = Auth::user();
        
        if (Auth::id() !== $leave->user_id && !$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $leave->update($request->only(['start_date', 'end_date', 'reason']));
        return $leave;
    }

    public function destroy($id)
    {
        $leave = LeaveRequest::findOrFail($id);

        /** @var \App\Models\User */
        $user = Auth::user();
        
        if (Auth::id() !== $leave->user_id && !$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $leave->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);

        /** @var \App\Models\User */
        $user = Auth::user();
        
        if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Only admins can update status'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $leave->update(['status' => $validated['status']]);

        return $leave;
    }
}
