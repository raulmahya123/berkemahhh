<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <title>Test Comment</title>
    </head>
    <body>
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
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    <a
                        href="/details/{{ $course->slug }}"
                        class="btn btn-primary"
                        >Back</a
                    >
                </form>
            </section>
            <div class="comment mt-4" id="fetchComment"></div>
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
                                    '<div class="comment">\
                            <h4 class="font-medium">User: ' +
                                        comment.user.name +
                                        '</h4>\
                                        <p class="flex-grow-1 mb-0">Title: ' +
                                        comment.coursevideo.name +
                                        '</p>\
                            <div class="d-flex align-items-center gap-2 mt-2">\
                                <p class="flex-grow-1 mb-0">' +
                                        comment.body +
                                        "</p>\
                                " +
                                        editButton +
                                        " " +
                                        deleteButton +
                                        "\
                            </div>\
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
                        $("#course_video_id").val(result.course_video_id);
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
