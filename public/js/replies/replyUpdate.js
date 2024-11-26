const requestUpdateReply = (id) => {
    document
        .getElementById(`editReplyForm${id}`)
        .addEventListener("submit", async function (e) {
            e.preventDefault();

            const form = e.target;
            const url = `/replies/update`;
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
                    `editReplyResponseMessage${id}`
                ).innerHTML = `<p style="color: green;">${data.msg}</p>`;

                const commentId = document.getElementById("commentId");
                fetchComment(commentId.value);
                // document.querySelector(".replying").style.display = "none";
                // document.querySelector("#replyActions").style.display = "flex";
            } catch (error) {
                document.getElementById(
                    `editReplyResponseMessage${id}`
                ).innerHTML = `<p style="color: red;">Error: ${error.message}</p>`;
            }
        });
};
