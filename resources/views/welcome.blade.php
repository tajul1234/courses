<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen">

    <div class="max-w-5xl mx-auto mt-10 bg-gray-800 p-8 rounded-lg shadow-lg">

        @if (session('success'))
        <div class="bg-green-500 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="bg-red-500 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <a href="{{ route('show') }}">Show</a>

        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-400">Create Course</h1>

        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label>Course Title</label>
                    <input type="text" name="course_title" class="w-full p-2 rounded bg-gray-700" placeholder="Course Title" required>
                </div>

                <div>
                    <label>Feature Video</label>
                    <input type="file" name="feature_video" accept="video/*" class="w-full p-2 rounded bg-gray-700" required>
                </div>
            </div>

            <div id="modules-container"></div>

            <button type="button" id="add-module" class="bg-blue-500 px-4 py-2 rounded text-white mb-6">+ Add
                Module</button>

            <div class="flex justify-end gap-3">
                <button type="submit" class="bg-green-500 px-5 py-2 rounded text-white">Save</button>
                <button type="button" onclick="window.history.back()" class="bg-red-500 px-5 py-2 rounded text-white">Cancel</button>
            </div>

        </form>
    </div>

    <script>
        let moduleIndex = 0;

        function moduleHTML(i) {
            return `
<div class="module border p-4 mb-4 bg-gray-700 relative">
<button type="button" class="remove-module absolute top-2 right-2 text-red-400">✖</button>
<label>Module Title</label>
<input type="text" name="modules[${i}][title]" class="w-full p-2 mb-3 rounded bg-gray-800" required>
<div class="contents-container"></div>
<button type="button" class="add-content bg-indigo-500 px-2 py-1 rounded text-white">+ Add Content</button>
</div>`;
        }

        function contentHTML(m, c) {
            return `
<div class="content bg-gray-800 p-3 mb-3 rounded relative">
<button type="button" class="remove-content absolute top-1 right-1 text-red-400">✖</button>
<label>Content Title</label>
<input type="text" name="modules[${m}][contents][${c}][title]" class="w-full p-2 mb-2 rounded bg-gray-700">
<label>Video Source</label>
<select name="modules[${m}][contents][${c}][source_type]" class="w-full p-2 mb-2 rounded bg-gray-700">
<option value="">Choose...</option><option value="YouTube">YouTube</option><option value="Vimeo">Vimeo</option><option value="HTML5">HTML5</option>
</select>
<label>Video URL</label>
<input type="text" name="modules[${m}][contents][${c}][video_url]" class="w-full p-2 mb-2 rounded bg-gray-700">
<label>Video Length</label>
<input type="text" name="modules[${m}][contents][${c}][video_length]" class="w-full p-2 rounded bg-gray-700">
</div>`;
        }

        $('#add-module').click(function() {
            $('#modules-container').append(moduleHTML(moduleIndex));
            moduleIndex++;
        });

        $(document).on('click', '.remove-module', function() {
            $(this).closest('.module').remove();
        });

        $(document).on('click', '.add-content', function() {
            const moduleDiv = $(this).closest('.module');
            const contentCount = moduleDiv.find('.content').length;
            const moduleNum = $('#modules-container .module').index(moduleDiv);
            moduleDiv.find('.contents-container').append(contentHTML(moduleNum, contentCount));
        });

        $(document).on('click', '.remove-content', function() {
            $(this).closest('.content').remove();
        });

    </script>

</body>

</html>
