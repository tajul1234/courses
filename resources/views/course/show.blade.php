<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen p-4">

<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Course Catalog</h1>
        <p class="text-gray-600">Browse all available courses</p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
        <!-- Course Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
            <!-- Course Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 text-white">
                <h2 class="text-xl font-bold mb-2 line-clamp-2">{{ $course->title }}</h2>
                <div class="flex justify-between text-sm">
                    <span class="flex items-center">
                        <i class="fas fa-layer-group mr-1"></i>
                        {{ $course->modules->count() }} Modules
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-play-circle mr-1"></i>
                        {{ $course->modules->sum(fn($module) => $module->contents->count()) }} Lessons
                    </span>
                </div>
            </div>


            @if($course->feature_video)
            <div class="p-4">
                <video class="w-full rounded-lg" controls>
                    <source src="{{ asset('storage/'.$course->feature_video) }}" type="video/mp4">
                </video>
            </div>
            @endif


            <div class="p-4">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-list mr-2 text-blue-500"></i>
                    Course Modules
                </h3>

                <div class="space-y-3 max-h-60 overflow-y-auto">
                    @foreach($course->modules as $module)
                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-medium text-gray-800 text-sm">{{ $module->title }}</h4>
                            <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">
                                {{ $module->contents->count() }}
                            </span>
                        </div>


                        @if($module->contents->count() > 0)
                        <div class="space-y-2">
                            @foreach($module->contents->slice(0, 2) as $content)
                            <div class="flex items-center text-xs text-gray-600 bg-white rounded p-2">
                                <i class="fas fa-play-circle text-green-500 mr-2"></i>
                                <span class="truncate flex-1">{{ $content->title ?? 'Untitled' }}</span>
                            </div>
                            @endforeach

                            @if($module->contents->count() > 2)
                            <div class="text-center">
                                <span class="text-xs text-gray-500">
                                    +{{ $module->contents->count() - 2 }} more lessons
                                </span>
                            </div>
                            @endif
                        </div>
                        @else
                        <p class="text-xs text-gray-500 text-center py-2">No content yet</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>


            <div class="p-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-600 transition">
                        View Course
                    </button>
                    
                    <span class="text-xs text-gray-500">
                        Updated {{ $course->updated_at->format('M d') }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>

</body>
</html>
