<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <title>Psikotest</title>
    </head>
    <body>
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">Psikotest Questions</h1>
                <form method="POST" id="psikotestQuestion">
                    @csrf
                    @foreach ($questions as $question)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-800">{{ $question->question_text }}</h3>
                        @foreach ($question->answers as $answer)
                        <div class="flex items-center mb-2">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $answer->id }}"
                                class="mr-2 focus:ring-2 focus:ring-blue-500"
                            />
                            <label class="text-gray-700">{{ $answer->answer_text }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    <div class="text-center">
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $("#productForm").on("submit", function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                let url, method;
                url = "products";
                method = "POST";
                if (save_method === "update") {
                    url = "products/" + $("#id").val();
                    formData.append("_method", "PUT");
                }
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
                        $("#productModal").modal("hide");
                        $("#tableProduct").DataTable().ajax.reload();
                        Swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.icon,
                            // showButtonText: false,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText);
                        // alert(jqXHR.responseText);
                        // Clear previous error messages
                    },
                });
            });
        </script>
    </body>
</html>
