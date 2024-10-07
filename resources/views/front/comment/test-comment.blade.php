<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="{{ asset('css/all.css') }}" rel="stylesheet" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
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
                margin-top: -50px !important; /* Pull the form higher into the blue section */
            }

            /* Card styling */
            .card {
                margin: 0;
                padding: 20px;
                background-color: #fff; /* Ensure card has a white background */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
                border-radius: 10px; /* Rounded corners for a smooth look */
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
        <div
            id="hero-section"
            class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden"
        >
            <nav class="flex justify-between items-center py-6 px-[50px]">
                <a href="{{ route('front.index') }}">
                    <img
                        src="{{ asset('assets/logo/logo.png') }}"
                        alt="logo"
                        style="width: 50px"
                    />
                </a>
                @if (Auth::user())
                <div class="flex gap-[10px] items-center">
                    <div class="flex flex-col items-end justify-center">
                        <p class="font-semibold text-white">
                            Hi, {{ Auth::user()->name }}
                        </p>
                        @if (Auth::user()->subscribe_transactions('is_paid' ==
                        true))
                        <p
                            class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center"
                        >
                            PRO
                        </p>
                        @else
                        <p
                            class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center"
                        >
                            -
                        </p>
                        @endif
                    </div>
                    <a
                        href="{{ route('dashboard') }}"
                        class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0"
                    >
                        <img
                            src="{{ Storage::url(Auth::user()->avatar) }}"
                            class="w-full h-full object-cover"
                            alt="photo"
                        />
                    </a>
                </div>
                @else
                <div class="flex gap-[10px] items-center">
                    <a
                        href="{{ route('register') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]"
                        >Sign Up</a
                    >
                    <a
                        href="{{ route('login') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]"
                        >Sign In</a
                    >
                </div>
                @endif
            </nav>
        </div>

        <div class="container py-4">
            <section class="course mt-4">
                <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
                <form id="commentForm-{{ $course->id }}">
                    @csrf
                    <input
                        type="hidden"
                        id="id"
                        name="id"
                        value="{{ $course->id }}"
                    />
                    <input
                        type="hidden"
                        id="slug"
                        name="slug"
                        value="{{ $course->slug }}"
                    />
                    <div class="mb-3">
                        <label for="course_video_id">Title</label>
                        <select
                            class="form-select course_video_id"
                            name="course_video_id"
                            id="course_video_id"
                        >
                            @foreach ($courseVideos as $video)
                            @if(old('course_video_id') == $video->id)
                            <option value="{{ $video->id }}" selected>
                                {{ $video->name }}
                            </option>
                            @else
                            <option value="{{ $video->id }}">
                                {{ $video->name }}
                            </option>
                            @endif @endforeach
                        </select>
                        <span
                            class="invalid-feedback"
                            id="error-course-video"
                        ></span>
                    </div>
                    <div class="mb-3">
                        <textarea
                            name="body"
                            id="add_body"
                            class="form-control"
                            placeholder="Tambahkan komentar"
                            rows="3"
                        ></textarea>
                        <span
                            class="invalid-feedback"
                            id="error-add-body"
                        ></span>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="background-color: #3525b3"
                    >
                        Kirim
                    </button>
                    <a
                        href="/details/{{ $course->slug }}"
                        class="btn btn-primary"
                        style="background-color: #3525b3"
                        >Back</a
                    >
                </form>
            </section>
            <div class="comment mt-4" id="fetchComment">
                <!-- More comment items -->
            </div>
        </div>

        @include('front.comment.modal-test')

        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>

        <script>
            let save_method;

            function resetValidation() {
                $(".is-invalid").removeClass("is-invalid");
                $(".is-valid").removeClass("is-valid");
                $("span.invalid-feedback").removeClass("d-block");
                $("span.invalid-feedback").text("");
            }

            function errorValidation(errorsValidation) {
                const errors = errorsValidation;
                $(".invalid-feedback").text("");
                $("input").removeClass("is-invalid");

                // Display error messages
                if (errors.body) {
                    $("#add_body").addClass("is-invalid");
                    $("#error-add-body")
                        .text(errors.body[0])
                        .addClass("d-block");
                }
            }

            function errorEditValidation(errorsValidation) {
                const errors = errorsValidation;
                $(".invalid-feedback").text("");
                $("input").removeClass("is-invalid");

                // Display error messages
                if (errors.body) {
                    $("#body").addClass("is-invalid");
                    $("#error-body").text(errors.body[0]).addClass("d-block");
                }
            }

            $(document).ready(function () {
                fetchData();
            });

            function fetchData() {
                let id = $("#id").val();
                $.ajax({
                    type: "GET",
                    url: "/comments/fetchData/" + id,
                    dataType: "json",
                    success: function (response) {
                        $("#fetchComment").html("");
                        $.each(response.courses, function (index, course) {
                            // Loop through comments for the course
                            $.each(course.comments, function (key, comment) {
                                let loggedInUserId = "{{ auth()->user()->id }}";

                                let editButton = "";
                                let deleteButton = "";
                                let balasan =
                                    '<a href="/comments/' +
                                    comment.course.slug +
                                    "/replies/" +
                                    comment.slug +
                                    '" class="btn btn-warning">Balasan</a>';

                                if (loggedInUserId == comment.user_id) {
                                    editButton =
                                        '<button class="btn btn-success" data-id="' +
                                        comment.slug +
                                        '" onClick="editModal(this)">Edit</button>';
                                    deleteButton =
                                        '<button class="btn btn-danger" data-id="' +
                                        comment.slug +
                                        '" onClick="deleteComment(this)">Delete</button>';
                                }

                                $("#fetchComment").append(
                                    '<div class="comment-item mb-3">\
                            <div class="author d-flex align-items-center mb-2">\
                                <img src="/storage/' +
                                        comment.user.avatar +
                                        '" alt="' +
                                        comment.user.name +
                                        '" class="rounded-circle" width="50" height="50" ">\
                                <span class="name ml-2">' +
                                        comment.user.name +
                                        '</span>\
                            </div>\
                            <div class="content">\
                                <p><strong>Title:</strong> ' +
                                        comment.coursevideo.name +
                                        "</p>\
                                <p>" +
                                        comment.body +
                                        '</p>\
                            </div>\
                            <div class="d-flex align-items-center gap-2 mt-2">' +
                                        editButton +
                                        " " +
                                        deleteButton +
                                        "" +
                                        balasan +
                                        "</div>\
                        </div>"
                                );
                            });
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(
                            "Error fetching comments:",
                            jqXHR.responseText
                        );
                    },
                });
            }

            $(document).ready(function () {
                $('form[id^="commentForm-"]').on("submit", function (e) {
                    let slug = $("#slug").val();
                    e.preventDefault();
                    const formData = new FormData(this);
                    let url = "/comments/" + slug;
                    let method = "POST";

                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: method,
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            fetchData();
                            resetValidation();
                            console.log(response.msg);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            errorValidation(jqXHR.responseJSON.errors);
                        },
                    });
                });
            });

            $("#editCommentForm").on("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");
                const slug = $("#slug").val();

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "POST",
                    url: "/comments/update/" + slug,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response.msg);
                        fetchData();
                        $("#commentModal").modal("hide");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        errorEditValidation(jqXHR.responseJSON.errors);
                    },
                });
            });

            function editModal(e) {
                let slug = e.getAttribute("data-id");
                console.log("edit:" + slug);

                save_method = "update";

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "GET",
                    url: "/comments/show/" + slug,
                    success: function (response) {
                        let result = response.data;
                        $("#edit_course_video_id").val(result.course_video_id);
                        $("#body").val(result.body);
                        $("#course_id").val(result.course_id);
                        $("#slug").val(result.slug);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
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
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "DELETE",
                    url: "/comments/delete/" + slug,
                    dataType: "json",
                    success: function (response) {
                        fetchData();

                        console.log(response.msg);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText);
                    },
                });
            }
        </script>
    </body>
</html>
