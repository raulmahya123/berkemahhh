const courseId = document.querySelector("#courseId").value; // Mengambil course ID dari Blade

// Fungsi untuk fetch data komentar
async function fetchComments() {
    try {
        const response = await fetch(`/comments/fetchData/${courseId}`, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error("Failed to fetch comments");
        }

        const data = await response.json();
        displayComments(data.courses); // Menampilkan komentar di halaman
    } catch (error) {
        console.error("Error fetching comments:", error);
    }
}

// Fungsi untuk menampilkan komentar ke dalam HTML
function displayComments(courses) {
    const commentsContainer = document.getElementById("commentsContainer");
    commentsContainer.innerHTML = ""; // Kosongkan container sebelum menambahkan komentar baru

    courses.forEach((course) => {
        course.comments.forEach((comment) => {
            const commentElement = `
                    <div class="card replies-card" style="margin-top: 20px;" id="modalid1"
                    onclick="commentCard(this)">
                    <!-- Bagian gambar profil -->
                    <div class="profile-img">
                        <img src="${storageUrl}${comment.user.avatar}" alt="Profile Picture">
                    </div>
                    <!-- Konten utama card -->
                    <div class="card-content">
                        <p class="question-title">${comment.body}</p>
                        <div class="question-details">
                            <div class="category">
                                <span class="icon">
                                    <img src="${assetBaseUrl}assets/icon/title.svg" alt="reply icon" width="20" height="20">
                                </span>
                                ${comment.coursevideo.name}
                            </div>
                            <div class="replies">
                                <span class="icon">
                                    <img src="${assetBaseUrl}assets/icon/reply.svg" alt="reply icon" width="20" height="20">
                                </span>
                                3 Replied
                            </div>
                            <div class="answered">
                                <span class="icon">
                                    <img src="${assetBaseUrl}assets/icon/Person-check.svg" alt="reply icon" width="20" height="20">
                                </span>
                                Dijawab mentor
                            </div>
                        </div>
                    </div>
                </div>
                `;
            commentsContainer.innerHTML += commentElement;
        });
    });
}

// Panggil fetchComments ketika halaman dimuat
document.addEventListener("DOMContentLoaded", fetchComments);
