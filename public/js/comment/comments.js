const courseId = document.querySelector("#courseId").value;

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
        displayComments(data.courses);
    } catch (error) {
        console.error("Error fetching comments:", error);
    }
}

function displayComments(courses) {
    const commentsContainer = document.getElementById("commentsContainer");
    commentsContainer.innerHTML = "";

    courses.forEach((course) => {
        course.comments.forEach((comment) => {
            const commentElement = `
                    <div class="card replies-card" style="margin-top: 20px;" id="modalid1"
                    onclick="commentCard(${comment.id}, '${comment.user.avatar}', '${comment.coursevideo.name}')">
                    <!-- Bagian gambar profil -->
                    <div class="profile-img">
                        <img src="${storageUrl}${comment.user.avatar}" alt="Profile Picture">
                    </div>
                    <!-- Konten utama card -->
                    <div class="card-content">
                        <p class="question-title" style="white-space: pre-line;">${comment.body}</p>
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
                        </div>
                    </div>
                </div>
                `;
            commentsContainer.innerHTML += commentElement;
        });
    });
}

document.addEventListener("DOMContentLoaded", fetchComments);
