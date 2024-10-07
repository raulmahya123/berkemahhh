async function fetchButton() {
    let courseId = document.getElementById("checkCourse").value;
    let courseVideoIdValue = document.getElementById("checkCourseVideo").value;
    try {
        const response = await fetch(
            `/checklisProgress/fetchData/${courseVideoIdValue}`,
            {
                method: "GET",
                headers: {
                    Accept: "application/json",
                },
            }
        );
        if (!response.ok) {
            throw new Error("Failed to fetch button");
        }

        const data = await response.json();
        displayButton(data.courseVideo);
    } catch (error) {
        console.error("Error fetching button:", error);
    }
}

function displayButton(courseVideo) {
    const buttonContainer = document.getElementById("buttonContainer");
    buttonContainer.innerHTML = "";

    const buttonElement = `<button id="completeBtn" data-course-id="${courseVideo.course_id}" data-course-video-id="${courseVideo.id}" class="btn-customm hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Ya, saya sudah paham
    </button>`;

    buttonContainer.innerHTML += buttonElement;

    // Tambahkan event listener setelah tombol di-render
    const completeBtn = document.getElementById("completeBtn");
    if (completeBtn) {
        completeBtn.addEventListener("click", async (e) => {
            // Pastikan event target adalah tombol yang diharapkan
            const targetButton = e.target.closest("#completeBtn"); // Menggunakan closest untuk memastikan
            if (targetButton) {
                const courseId = targetButton.getAttribute("data-course-id");
                const videoId = targetButton.getAttribute("data-video-id");

                try {
                    const response = await fetch("/course-progress", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                        body: JSON.stringify({
                            course_id: courseId,
                            course_video_id: videoId,
                        }),
                    });

                    if (response.ok) {
                        const result = await response.json();
                        document
                            .getElementById(`video-${videoId}`)
                            .classList.add("completed");
                        alert(result.message);
                    } else {
                        console.error("Gagal menyimpan progres");
                    }
                } catch (error) {
                    console.error("Terjadi kesalahan:", error);
                }
            } else {
                console.error("Tombol tidak ditemukan atau tidak valid.");
            }
        });
    } else {
        console.error("Button tidak ditemukan.");
    }
}

document.addEventListener("DOMContentLoaded", fetchButton);
