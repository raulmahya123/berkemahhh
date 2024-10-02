document
    .getElementById("commentForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = e.target;
        const url = form.action;
        const formData = new FormData(form);
        const csrfToken = form.querySelector('input[name="_token"]').value;

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
                "responseMessage"
            ).innerHTML = `<p style="color: green;">${data.msg}</p>`;

            form.reset();
        } catch (error) {
            document.getElementById(
                "responseMessage"
            ).innerHTML = `<p style="color: red;">Error: ${error.message}</p>`;
        }
    });
