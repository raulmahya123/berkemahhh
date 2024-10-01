<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <title>Comment</title>
    <style>
        /* Layout adjustments */
        .d-flex {
            display: flex !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .align-items-start {
            align-items: flex-start !important;
        }

        /* Margin adjustments to bring content within blue background */
        .mt-5 {
            margin-top: -50px !important;
            /* Pull the form higher into the blue section */
        }

        /* Card styling */
        .card {
            margin: 0;
            padding: 20px;
            background-color: #fff;
            /* Ensure card has a white background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Add subtle shadow */
            border-radius: 10px;
            /* Rounded corners for a smooth look */
        }

        /* Adjustments for Navbar and Hero Section */
        #hero-section {
            position: relative;
            top: 0;
            margin-bottom: 0;
        }

        /* Container styling */
        .container {
            background-color: #f4f4f9;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form input styling */
        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            background-color: #2e2e2e;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        form textarea {
            resize: none;
        }

        /* Button styling */
        form button,
        form a {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover,
        form a:hover {
            background-color: #3a70b2;
        }

        /* Comment section */
        .comment {
            margin-top: 20px;
        }

        /* Single comment block styling */
        .comment .comment-item {
            background-color: #2e2e2e;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        /* Comment author and content */
        .comment .comment-item .author {
            display: flex;
            align-items: center;
        }

        .comment .comment-item .author img {
            border-radius: 50%;
            width: 35px;
            height: 35px;
            margin-right: 10px;
        }

        .comment .comment-item .author .name {
            font-weight: bold;
            margin-right: 5px;
        }

        .comment .comment-item .content {
            flex-grow: 1;
            margin-left: 10px;
        }

        /* Upvote section */
        .comment .comment-item .upvote {
            display: flex;
            align-items: center;
        }

        .comment .comment-item .upvote button {
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .comment .comment-item .upvote button:hover {
            color: #4a90e2;
        }

        .comment .comment-item .upvote i {
            margin-right: 5px;
        }

        /* Additional Styling */
        /* Responsive design for smaller screens */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            form button,
            form a {
                padding: 8px 15px;
            }

            .comment .comment-item {
                padding: 10px;
            }

            .comment .comment-item .author img {
                width: 30px;
                height: 30px;
            }
        }

        /* Add slight hover effect for comments */
        .comment .comment-item:hover {
            background-color: #3a3a3a;
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body>
    <div id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        <nav class="flex justify-between items-center py-6 px-[50px]">
            <a href="{{ route('front.index') }}">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="logo"style="width: 50px;">

            </a>
            @if (Auth::user())
                <div class="flex gap-[10px] items-center">
                    <div class="flex flex-col items-end justify-center">
                        <p class="font-semibold text-white">Hi, {{ Auth::user()->name }}</p>
                        @if (Auth::user()->subscribe_transactions('is_paid' == true))
                            <p
                                class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                                PRO
                            </p>
                        @else
                            <p
                                class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                                -
                            </p>
                        @endif
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">
                    </a>
                </div>
            @else
                <div class="flex gap-[10px] items-center">
                    <a href="{{ route('register') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign
                        Up</a>
                    <a href="{{ route('login') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign
                        In</a>
                </div>
            @endif
        </nav>

    </div>

    <div class="container py-4">
        <section class="course mt-4">
            <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
            <form id="commentForm-{{ $course->id }}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $course->id }}" />
                <input type="hidden" id="course_id" name="course_id" value="{{ $course->id }}">
                <input type="hidden" id="slug" name="slug" value="{{ $course->slug }}" />
                <div class="mb-3">
                    <label for="course_video_id">Title</label>
                    <select class="form-select course_video_id" name="course_video_id" id="course_video_id">
                        @foreach ($courseVideos as $video)
                            <option value="{{ $video->id }}" {{ old('course_video_id') == $video->id ? 'selected' : '' }}>
                                {{ $video->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback d-block" id="error-course-video"></span>
                </div>
                <div class="mb-3">
                    <label for="body">Comment</label>
                    <textarea class="form-control" id="add_body" name="body" rows="3"></textarea>
                    <span class="invalid-feedback d-block" id="error-add-body"></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div id="fetchComment" class="mt-4"></div>
        </section>
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCommentForm">
                        @csrf
                        <input type="hidden" id="slug" name="slug">
                        <div class="mb-3">
                            <label for="edit_course_video_id">Title</label>
                            <select class="form-select" name="edit_course_video_id" id="edit_course_video_id">
                                @foreach ($courseVideos as $video)
                                    <option value="{{ $video->id }}">{{ $video->name }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback d-block" id="error-edit-course-video"></span>
                        </div>
                        <div class="mb-3">
                            <label for="body">Comment</label>
                            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                            <span class="invalid-feedback d-block" id="error-edit-body"></span>
                        </div>
                        <button type="submit" class="btn btn-primary btnSubmit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @include('front.comment.modal-test')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
<script>
    $(document).ready(function() {
        let users = [];

        // Fetch the user list for mentions
        $.ajax({
            type: "GET",
            url: "/users/fetchAll", // API endpoint to fetch user data
            dataType: "json",
            success: function(response) {
                // Prepare users for autocomplete (jQuery UI requires label and value)
                users = response.map(user => ({
                    label: user.name, // Display name
                    value: '@' + user.name // Value inserted into the textarea
                }));
            },
            error: function(xhr, status, error) {
                console.log("Error fetching users:", error);
            }
        });

        // Autocomplete for mentions
        $('#add_body').on('keyup', function(e) {
            let inputText = $(this).val();
            let lastWord = inputText.split(" ").pop(); // Get the last word being typed

            // Check if the last word starts with '@'
            if (lastWord.startsWith('@')) {
                let searchTerm = lastWord.slice(1); // Get the word after '@'

                // Trigger autocomplete when @ is typed
                $(this).autocomplete({
                    source: users.filter(user => user.label.toLowerCase().includes(searchTerm.toLowerCase())), // Filter users by search term
                    focus: function(event, ui) {
                        return false; // Prevent value from being inserted on focus
                    },
                    select: function(event, ui) {
                        // Insert the selected user's name
                        let inputVal = $('#add_body').val();
                        let updatedVal = inputVal.substring(0, inputVal.lastIndexOf('@')) + ui.item.value + ' ';
                        $('#add_body').val(updatedVal); // Update the textarea with the mention

                        return false; // Prevent default behavior
                    }
                }).autocomplete('search', searchTerm); // Trigger the search with the searchTerm
            }
        });

        // Submit the comment form with mentions handling
       // Submit the comment form with mentions handling
$('form[id^="commentForm-"]').on("submit", function(e) {
    e.preventDefault();
    let slug = $("#slug").val();
    const formData = new FormData(this);

    // Extract mentions from the comment body
    let body = formData.get('body');
    let mentions = extractMentions(body); // Get mentioned usernames
    formData.append('mentions', mentions.join(',')); // Add mentions to form data
    formData.append('course_id', $("#course_id").val()); // Add course_id to form data

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: "/comments/" + slug,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            fetchData(); // Refresh comments
            resetValidation(); // Reset validation messages
            console.log(response.msg);
        },
        error: function(jqXHR) {
            errorValidation(jqXHR.responseJSON.errors); // Show validation errors
        }
    });
});


        // Function to extract mentions from the comment body
        function extractMentions(body) {
            return body.match(/@(\w+)/g) || []; // Match words prefixed with @
        }

        function resetValidation() {
            $(".is-invalid").removeClass("is-invalid");
            $(".is-valid").removeClass("is-valid");
            $("span.invalid-feedback").removeClass("d-block").text("");
        }

        function errorValidation(errorsValidation) {
            const errors = errorsValidation;
            $(".invalid-feedback").text("");
            $("input").removeClass("is-invalid");
            $("textarea").removeClass("is-invalid");

            // Display error messages
            if (errors.body) {
                $("#add_body").addClass("is-invalid");
                $("#error-add-body").text(errors.body[0]).addClass("d-block");
            }
            if (errors.course_video_id) {
                $("#course_video_id").addClass("is-invalid");
                $("#error-course-video").text(errors.course_video_id[0]).addClass("d-block");
            }
        }

        fetchData(); // Initial fetch of comments

        function fetchData() {
            let id = $("#id").val();
            $.ajax({
                type: "GET",
                url: "/comments/fetchData/" + id,
                dataType: "json",
                success: function(response) {
                    $("#fetchComment").html("");
                    $.each(response.courses, function(index, course) {
                        // Loop through comments for the course
                        $.each(course.comments, function(key, comment) {
                            let loggedInUserId = "{{ auth()->user()->id }}";

                            let editButton = "";
                            let deleteButton = "";

                            if (loggedInUserId == comment.user_id) {
                                editButton = '<button class="btn btn-success" data-id="' + comment.slug + '" onClick="editModal(this)">Edit</button>';
                                deleteButton = '<button class="btn btn-danger" data-id="' + comment.slug + '" onClick="deleteComment(this)">Delete</button>';
                            }

                            // Replace mentions in the body with proper formatting
                            let bodyWithMentions = comment.body.replace(/@(\w+)/g, '<span class="mention">@$1</span>');

                            $("#fetchComment").append(
                                '<div class="comment">\
                                    <div class="d-flex align-items-center gap-2">\
                                       <img src="' +
                (comment.user.avatar ? '/storage/' + comment.user.avatar : "{{ Auth::user()->avatar }}") +
                '" alt="User Avatar" class="rounded-circle object-cover" width="40" height="40">\
                                        <h4 class="font-medium mb-0">User: ' + comment.user.name + '</h4>\
                                    </div>\
                                    <p class="flex-grow-1 mb-0">Title: ' + comment.coursevideo.name + '</p>\
                                    <div class="d-flex align-items-center gap-2 mt-2">\
                                        <p class="flex-grow-1 mb-0">' + bodyWithMentions + '</p>\
                                        ' + editButton + ' ' + deleteButton + '\
                                    </div>\
                                </div>'
                            );
                        });
                    });
                },
                error: function(jqXHR) {
                    console.log("Error fetching comments:", jqXHR.responseText);
                },
            });
        }

        $("#editCommentForm").on("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append("_method", "PUT");
            const slug = $("#slug").val();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                url: "/comments/update/" + slug,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response.msg);
                    fetchData();
                    $("#commentModal").modal("hide");
                },
                error: function(jqXHR) {
                    errorEditValidation(jqXHR.responseJSON.errors);
                },
            });
        });

        function editModal(e) {
            let slug = e.getAttribute("data-id");
            console.log("edit:" + slug);

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "GET",
                url: "/comments/show/" + slug,
                success: function(response) {
                    let result = response.data;
                    $("#edit_course_video_id").val(result.course_video_id);
                    $("#body").val(result.body);
                    $("#course_id").val(result.course_id);
                    $("#slug").val(result.slug);
                },
                error: function(jqXHR) {
                    console.log("error");
                },
            });
            resetValidation();
            $("#commentModal").modal("show");
            $(".modal-title").text("Edit Comment");
            $(".btnSubmit").text("Save");
        }

        function deleteComment(e) {
            let slug = e.getAttribute("data-id");
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "DELETE",
                url: "/comments/delete/" + slug,
                dataType: "json",
                success: function(response) {
                    fetchData();
                    console.log(response.msg);
                },
                error: function(jqXHR) {
                    console.log(jqXHR.responseText);
                },
            });
        }
    });
</script>


</body>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</html>
