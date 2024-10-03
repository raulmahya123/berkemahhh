let userAvatar;
let videoName;
let commentId;

const commentCard = (id, user_avatar, video_name) => {
    replymodal.style.display = "flex";
    commentId = id;
    userAvatar = user_avatar;
    videoName = video_name;

    fetchComment(commentId, userAvatar, videoName);
};

async function fetchComment(commentId, userAvatar, videoName) {
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
        displayCommentReplies(data.comment, userAvatar, videoName); // Menampilkan komentar di halaman
    } catch (error) {
        console.error("Error fetching comments:", error);
    }
}

// Fungsi untuk menampilkan komentar ke dalam HTML

function displayCommentReplies(comment, userAvatar, videoName) {
    const commentContainer = document.getElementById("commentContainer");
    commentContainer.innerHTML = "";

    const repliesContainer = document.getElementById("repliesContainer");
    repliesContainer.innerHTML = "";

    const commentId = document.getElementById("commentId");
    commentId.value = "";

    const commenterUseriId = comment.user_id;
    console.log("ID user: " + commenterUseriId);

    commentContainer.innerHTML = `
        <div class="card" style="margin-top: 20px;">
        
            <div class="profile-img">
                <img src="${storageUrl}${userAvatar}" alt="Profile Picture">
            </div>

            <div class="card-content">
                <p class="question-title">${comment.body}</p>
                <div class="question-details">
                    <div class="category">
                        <span class="icon">
                            <img src="${assetBaseUrl}assets/icon/title.svg" alt="reply icon"
                                width="20" height="20">
                        </span>
                        ${videoName}
                    </div>
                    <div class="replies">
                        <span class="icon">
                            <img src="${assetBaseUrl}assets/icon/reply.svg" alt="reply icon"
                                width="20" height="20">
                        </span>
                        3 Replied
                    </div>
                </div>
            </div>
        </div>
    `;
    comment.replies
        .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
        .forEach((reply) => {
            const replyElement = `
            <div class="card" style="margin-top: 20px;">
                <div class="profile-img">
                    <img src="${storageUrl}${reply.user.avatar}" alt="Profile Picture">
                </div>
                <div class="card-content">
                    <div class="question-details">
                        <h4 class="reply-owner">${reply.user.name}</h4>
                    </div>
                    <p class="reply-owner-title">
                        ${reply.user.occupation}
                    </p>
                    <p class="reply-content" style="white-space: pre-line;">${reply.body}</p>
                </div>
            </div>
        `;
            repliesContainer.innerHTML += replyElement;
        });

    commentId.value = comment.id;
    console.log("ID dari comment: " + comment.id);
}
