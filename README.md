Courses Project - Laravel

Description:
This is a Laravel-based course management system where users can create courses, add modules, and add video contents for each module. Feature videos are uploaded in the background using Laravel queues.

Features:
- Create courses with title and feature video
- Add multiple modules under each course
- Add multiple contents under each module
  - Content title
  - Video source type (YouTube, Vimeo, HTML5)
  - Video URL
  - Video length in HH:MM:SS
- Background video upload using Laravel queue
- Responsive and beginner-friendly interface with Tailwind CSS

Screenshots:
1. Welcome Page (Create Course) - <img width="628" height="803" alt="Screenshot 2025-10-27 095426" src="https://github.com/user-attachments/assets/2c262be0-0582-4caf-86b9-1af044fde6d3" />

2. Show Courses Page <img width="1167" height="863" alt="Screenshot 2025-10-27 100858" src="https://github.com/user-attachments/assets/bece1b96-25ef-465e-b5a6-859f0f4d1aaa" />


Installation Steps:
1. Clone the repository:
   git clone https://github.com/tajul1234/courses.git
   cd courses

2. Install PHP dependencies:
   composer install

3. Install Node dependencies and build assets:
   npm install
   npm run dev

4. Copy .env.example to .env and configure database:
   cp .env.example .env
   php artisan key:generate
   - Update database credentials in .env

5. Run migrations:
   php artisan migrate

6. Start queue worker for background video upload:
   php artisan queue:work

7. Serve the application:
   php artisan serve

Usage:
- Open in browser: http://127.0.0.1:8000
- Go to Welcome Page to create courses, modules, and contents
- Feature videos upload in the background
- Go to Show Courses page to view all courses with their modules and contents

Technologies Used:
- Laravel 10
- PHP 8.2
- Tailwind CSS
- Blade Templates
- jQuery for dynamic forms
- MySQL or SQLite
- Laravel Queue for background tasks

Folder Structure:
app/
  Http/
    Controllers/
      CourseController.php
  Jobs/
    UploadCourseVideo.php
resources/
  views/
    welcome.blade.php
    courses/
      show.blade.php
storage/
  app/public/
    temp_videos/
    videos/

Notes for Beginners:
- Run 'php artisan queue:work --queue=videos' to process video uploads
- Upload videos in mp4, avi, or mov format
- Ensure storage/ folder is writable
- Add modules and contents dynamically on the Welcome page
- Place screenshots in the 'screenshots/' folder


