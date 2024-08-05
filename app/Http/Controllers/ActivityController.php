<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\Client;
use App\Models\Project;
use App\Models\Staff;
use App\Models\User;
use App\Notifications\ActivityNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    // Display a listing of activities
    public function index()
    {
        $this->authorize('viewAny', Activity::class);
        $activities = Activity::with('images', 'staff')->get();
        return view('admin.activities.index', compact('activities'));
    }

    // Show the form for creating a new activity
    public function create()
    {
        $this->authorize('create', Activity::class);
        $users = User::where('role', 'staff')->get();
        $projects = Project::all();
        return view('admin.activities.create', compact('users', 'projects'));
    }

    // Store a newly created activity in storage
    public function store(Request $request)
    {
        $this->authorize('create', Activity::class);

        $activity = Activity::create($request->except('images', 'user_ids'));

        // Attach multiple users
        if ($request->has('user_ids')) {
            $activity->users()->attach($request->input('user_ids'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/activity_images');
                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    // Show the form for editing the specified activity
    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);
        $users = User::where('role', 'staff')->get();
        $projects = Project::all();
        return view('admin.activities.edit', compact('activity', 'users', 'projects'));
    }

    // Update the specified activity in storage
    public function update(Request $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $activity->update($request->except('images', 'user_ids'));

        // Sync multiple users
        if ($request->has('user_ids')) {
            $activity->users()->sync($request->input('user_ids'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/activity_images');
                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    // Remove the specified activity from storage
    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);
        // Delete associated images
        foreach ($activity->images as $image) {
            Storage::delete($image->image);
        }

        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }

    // Show the details of a specific activity
    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('admin.activities.show', compact('activity'));
    }
}