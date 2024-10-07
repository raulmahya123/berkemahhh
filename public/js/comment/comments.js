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
            const teacherCommented = comment.replies.some(
                (item) => item.user_id === course.teacher.user_id
            )
                ? true
                : false;
            const commentElement = `
                <div class="card replies-card" style="margin-top: 20px;" id="modalid1"
                onclick="commentCard(${comment.id})">
                    <!-- Bagian gambar profil -->
                    <div class="profile-img">
                        <img src="${storageUrl}${
                comment.user.avatar
            }" alt="Profile Picture">
                    </div>
                    <!-- Konten utama card -->
                    <div class="card-content">
                        <div class="comment-card-head">
                            <p class="comment-owner"> ${comment.user.name} </p>
                            ${
                                loggedInUserId == comment.user_id
                                    ? `
                                    <span class="icon" id="commentOptions" onclick="toggleMenu(this, event, ${comment.id})">
                                        <img src="${assetBaseUrl}assets/icon/kebab-icon.svg" alt="reply icon"
                                            width="20" height="20">
                                    </span>
                            `
                                    : ``
                            }
                        </div>
                        <p class="category">
                            ${comment.coursevideo.name}
                        </p>
                        <div class="editingComment editingComment${
                            comment.id
                        }" style="margin-top: 20px;">
                            <form id="editCommentForm${comment.id}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" id="commentId" name="commentId" 
                                    value="${comment.id}"/>

                                <div class="form-group">
                                    <textarea name="body" placeholder="Edit komentar" rows="3" class="form-control" onclick="event.stopPropagation();" required>${
                                        comment.body
                                    }</textarea>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="form-actions end-to-end">
                                    <button class="btn btn-primary" type="submit" onclick="requestUpdateComment(event, ${
                                        comment.id
                                    })">Kirim</button>
                                    <button class="btn btn-secondary" id="cancelEditComment" type="button" onclick="editorComment(event, ${
                                        comment.id
                                    })">Batal</button>
                                </div>
                            </form>
                        </div>
                        <div style="margin-top: 10px" id="editCommentResponseMessage${
                            comment.id
                        }"></div>
                        <p class="question-title" id="commentBody${
                            comment.id
                        }" style="white-space: pre-line;">${comment.body}</p>
                        <div class="question-details">
                            <div class="replies">
                                <span class="icon">
                                    <img src="${assetBaseUrl}assets/icon/reply.svg" alt="reply icon" width="20" height="20">
                                </span>
                                ${comment.replies.length} Balasan
                            </div>
                            ${
                                teacherCommented
                                    ? `
                                    <div class="answered">
                                        <span class="icon">
                                            <img src="${assetBaseUrl}assets/icon/Person-check.svg" alt="reply icon"
                                                width="20" height="20">
                                        </span>
                                        Dijawab mentor
                                    </div>
                                    `
                                    : ""
                            }
                        </div>
                    </div>
                </div>
            `;
            commentsContainer.innerHTML += commentElement;
        });
    });
}

document.addEventListener("DOMContentLoaded", fetchComments);
