<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;

class UploadCourseVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $courseId;

    public function __construct($filePath, $courseId)
    {
        $this->filePath = $filePath;
        $this->courseId = $courseId;
    }

    public function handle()
    {
        $source = storage_path('app/public/' . $this->filePath);
        $destination = storage_path('app/public/videos/' . basename($this->filePath));

        // Folder nai thakle create koro
        if (!file_exists(dirname($destination))) {
            mkdir(dirname($destination), 0777, true);
        }

        // File move
        rename($source, $destination);

        // Database update
        $course = Course::find($this->courseId);
        if ($course) {
            $course->update(['feature_video' => 'videos/' . basename($this->filePath)]);
        }
    }
}
