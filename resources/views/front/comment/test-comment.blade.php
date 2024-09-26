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
            @foreach($courses as $course)
            <section class="course mt-4">
                <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
                <form class="mt-2" id="commentForm-{{ $course->id }}">
                    @csrf
                    <input
                        type="hidden"
                        name="course_keypoint_id"
                        value="{{ $course->id }}"
                    />
                    <div class="mb-3">
                        <textarea
                            name="body"
                            class="form-control"
                            placeholder="Tambahkan komentar"
                            rows="3"
                        ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </section>
            @endforeach
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
            $(document).ready(function () {
                fetchData();
            });
            function fetchData() {
                $.ajax({
                    type: "GET",
                    url: "/comments/fetchData", // Ensure this URL is correct
                    dataType: "json",
                    success: function (response) {
                        $("#fetchComment").html(""); // Clear previous comments
                        $.each(response.courses, function (index, course) {
                            // Display course name
                            $("#fetchComment").append(
                                "<hr><h3>" + course.name + "</h3>"
                            );

                            // Loop through comments for the course
                            $.each(course.comments, function (key, comment) {
                                $("#fetchComment").append(
                                    '<div class="comment">\
                            <h4 class="font-medium">User: ' +
                                        comment.user.name +
                                        '</h4>\
                            <div class="d-flex align-items-center gap-2 mt-2">\
                                <p class="flex-grow-1 mb-0">' +
                                        comment.body +
                                        '</p>\
                                <button class="btn btn-success" data-id="' +
                                        comment.id +
                                        '" onClick="editModal(this)">Edit</button>\
                                <button class="btn btn-danger" data-id="' +
                                        comment.id +
                                        '" onClick="deleteComment(this)">Delete</button>\
                            </div>\
                        </div>'
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
                    e.preventDefault();
                    const formData = new FormData(this);
                    let url = "comments";
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
                            console.log(response.msg);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log("error");
                        },
                    });
                });
            });

            $("#editCommentForm").on("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");
                const id = $("#id").val(); // Ambil ID dari input tersembunyi

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "POST",
                    url: "comments/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        fetchData();
                        console.log(response.msg);
                        $("#commentModal").modal("hide");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("error", errorThrown);
                    },
                });
            });

            function editModal(e) {
                let id = e.getAttribute("data-id");
                save_method = "update";

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "GET",
                    url: "comments/" + id,
                    success: function (response) {
                        let result = response.data;
                        $("#body").val(result.body);
                        $("#course_keypoint_id").val(result.course_keypoint_id);
                        $("#id").val(result.id);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("error");
                    },
                });

                $("#commentModal").modal("show");
                $(".modal-title").text("Edit Comment");
                $(".btnSubmit").text("Save");
            }

            function deleteComment(e) {
                let id = e.getAttribute("data-id");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "DELETE",
                    url: "comments/" + id,
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
