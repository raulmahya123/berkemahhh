const deleteReply = async (replyId) => {
    closeMenuReply();
    const url = `/replies/delete/${replyId}`;
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    try {
        const response = await fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();

        document.getElementById(
            "replyResponseMessage"
        ).innerHTML = `<p style="color: green;">${data.msg}</p>`;

        const commentId = document.getElementById("commentId");
        fetchComment(commentId.value);
    } catch (error) {
        document.getElementById(
            "replyResponseMessage"
        ).innerHTML = `<p style="color: red;">Error: ${error.message}</p>`;
    }
};
