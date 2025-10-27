<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Jobs\UploadCourseVideo;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_title' => 'required|string|max:255',
            'feature_video' => 'required|file|mimetypes:video/mp4,video/avi,video/quicktime|max:200000',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents.*.title' => 'nullable|string|max:255',
            'modules.*.contents.*.source_type' => 'nullable|string|max:50',
            'modules.*.contents.*.video_url' => 'nullable|string|max:500',
            'modules.*.contents.*.video_length' => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            $course = Course::create([
                'title' => $request->course_title,
                'feature_video' => null,
            ]);

            foreach ($request->modules ?? [] as $moduleData) {
                $module = $course->modules()->create(['title' => $moduleData['title']]);
                foreach ($moduleData['contents'] ?? [] as $contentData) {
                    $module->contents()->create([
                        'title' => $contentData['title'] ?? null,
                        'video_source_type' => $contentData['source_type'] ?? null,
                        'video_url' => $contentData['video_url'] ?? null,
                        'video_length' => $contentData['video_length'] ?? null,
                    ]);
                }
            }

            DB::commit();

            if ($request->hasFile('feature_video')) {
                $tempPath = $request->file('feature_video')->store('temp_videos', 'public');
                UploadCourseVideo::dispatch($tempPath, $course->id)->onQueue('videos');
            }

            return redirect()->back()->with('success', 'Course created Successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error creating course: ' . $e->getMessage());
        }
    }

    public function index() {
    $courses = Course::with('modules.contents')->get();
    return view('course.show', compact('courses'));
}

}
