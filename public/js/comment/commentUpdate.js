const requestUpdateComment = (event, id) => {
    event.stopPropagation();
    document
        .getElementById(`editCommentForm${id}`)
        .addEventListener("submit", async function (e) {
            e.preventDefault();

            const form = e.target;
            const url = `/comments/update`;
            const formData = new FormData(form);
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }

                const data = await response.json();

                document.getElementById(
                    `editCommentResponseMessage${id}`
                ).innerHTML = `<p style="color: green;">${data.msg}</p>`;

                fetchComments();
            } catch (error) {
                document.getElementById(
                    `editCommentResponseMessage${id}`
                ).innerHTML = `<p style="color: red;">Error: ${error.message}</p>`;
            }
        });
};
