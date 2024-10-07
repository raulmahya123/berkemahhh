const deleteComment = async (commentId) => {
    closeMenuComment();
    const url = `/comments/delete/${commentId}`;
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
            "responseMessage"
        ).innerHTML = `<p style="color: green;">${data.msg}</p>`;

        fetchComments();
    } catch (error) {
        document.getElementById(
            "responseMessage"
        ).innerHTML = `<p style="color: red;">Error: ${error.message}</p>`;
    }
};
