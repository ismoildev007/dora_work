<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    // Display a listing of activities
    public function index()
    {
        $activities = Activity::with('images')->get();
        return view('admin.activities.index', compact('activities'));
    }

    // Show the form for creating a new activity
    public function create()
    {
        return view('admin.activities.create');
    }

    // Store a newly created activity in storage
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'activity_type' => 'required|in:meeting,call,email,task,other',
            'activity_date' => 'required|date',
            'staff_id' => 'nullable|exists:staff,id',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $activity = Activity::create($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/activity_images');
                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    // Show the form for editing the specified activity
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    // Update the specified activity in storage
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'description' => 'required|string',
            'activity_type' => 'required|in:meeting,call,email,task,other',
            'activity_date' => 'required|date',
            'staff_id' => 'nullable|exists:staff,id',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $activity->update($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/activity_images');
                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    // Remove the specified activity from storage
    public function destroy(Activity $activity)
    {
        // Delete associated images
        foreach ($activity->images as $image) {
            Storage::delete($image->image_path);
        }

        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }

    // Show the details of a specific activity
    public function show(Activity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    public function destroyImage(ActivityImage $activityImage)
    {
        Storage::delete($activityImage->image_path);
        $activityImage->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
