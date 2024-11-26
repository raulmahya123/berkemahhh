async function fetchComment(commentId) {
    try {
        const response = await fetch(`/comments/show/${commentId}`, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error("Failed to fetch comments");
        }

        const data = await response.json();
        displayCommentReplies(data.comment);
        // Menampilkan komentar di halaman
    } catch (error) {
        console.error("Error fetching comments:", error);
    }
}

// Fungsi untuk menampilkan komentar ke dalam HTML

function displayCommentReplies(comment) {
    const commentContainer = document.getElementById("commentContainer");
    commentContainer.innerHTML = "";

    const repliesContainer = document.getElementById("repliesContainer");
    repliesContainer.innerHTML = "";

    const commentId = document.getElementById("commentId");
    commentId.value = "";

    const teacherCommented = comment.replies.some(
        (item) => item.user_id === comment.course.teacher.user_id
    )
        ? true
        : false;

    commentContainer.innerHTML = `
        <div class="card" style="margin-top: 20px;">
        
            <div class="profile-img">
                <img src="${storageUrl}${
        comment.user.avatar
    }" alt="Profile Picture">
            </div>

            <div class="card-content">
                <p class="comment-owner"> ${comment.user.name} </p>
                <div class="category">
                    ${comment.coursevideo.name}
                </div>
                <p class="question-title" style="white-space: pre-line;">${
                    comment.body
                }</p>
                <div class="question-details">
                    <div class="replies">
                        <span class="icon">
                            <img src="${assetBaseUrl}assets/icon/reply.svg" alt="reply icon"
                                width="20" height="20">
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
    comment.replies
        .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
        .forEach((reply) => {
            const replyElement = `
            <div class="card" style="margin-top: 20px;" onclick="closeMenuReply()">
                <div class="profile-img">
                    <img src="${storageUrl}${
                reply.user.avatar
            }" alt="Profile Picture">
                </div>
                <div class="card-content">
                    <div class="reply-head">
                        <h4 class="reply-owner">${reply.user.name}</h4>
                        ${
                            reply.user.id == comment.course.teacher.user_id
                                ? `
                                    <div class="isMentor">
                                        <div class="isMentorHead">
                                            <span class="icon">
                                                <img src="${assetBaseUrl}assets/icon/isMentor.svg" alt="reply icon"
                                                    width="13" height="17">
                                            </span>
                                            Mentor
                                        </div>
                                        ${
                                            loggedInUserId == reply.user.id
                                                ? `
                                                    <span class="icon" id="commentOptions" onclick="toggleMenuReply(this, event, ${reply.id})">
                                                        <img src="${assetBaseUrl}assets/icon/kebab-icon.svg" alt="reply icon"
                                                            width="20" height="20">
                                                    </span>
                                                `
                                                : ``
                                        }
                                    </div>
                                `
                                : ``
                        }
                    </div>
                    <p class="reply-owner-title">
                        ${reply.user.occupation}
                    </p>
                    <div class="editingReply editingReply${
                        reply.id
                    }" style="margin-top: 20px;">
                        <form id="editReplyForm${reply.id}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="replyId" name="reply_id" 
                                value="${reply.id}"/>

                            <div class="form-group">
                                <textarea name="body" placeholder="Edit balasan" rows="3" class="form-control" required>${
                                    reply.body
                                }</textarea>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="form-actions end-to-end">
                                <button class="btn btn-primary" type="submit" onclick="requestUpdateReply(${
                                    reply.id
                                })">Kirim</button>
                                <button class="btn btn-secondary" id="cancelEditReply" type="button" onclick="editorReply(${
                                    reply.id
                                })">Batal</button>
                            </div>
                        </form>
                    </div>
                    <div style="margin-top: 10px" id="editReplyResponseMessage${
                        reply.id
                    }"></div>
                    <p class="reply-content" id="reply-content${
                        reply.id
                    }" style="white-space: pre-line;">${reply.body}</p>
                </div>
            </div>
        `;
            repliesContainer.innerHTML += replyElement;
        });

    commentId.value = comment.id;
}
