const modal = document.querySelector("#commentModal");
const modalContent = document.querySelector("#modal-content-comment");
const modalContentReply = document.querySelector("#modal-content-reply");
const replymodal = document.querySelector("#replyModal");
const btn = document.querySelector("#openModalBtn");
const span = document.querySelector(".close");
const replyspan = document.querySelector(".replyclose");
const writeReply = document.querySelector("#writeReply");
const cancelReply = document.querySelector("#cancelReply");
const closeCommentModal = document.querySelector("#cancelComment");
const closeReplyModal = document.querySelector("#kembaliButton");
// const commentCard = document.querySelector(".card");

//buka modal
btn.onclick = () => {
    modal.style.display = "flex";
};

// tombol tutup modal
span.onclick = () => {
    modal.style.display = "none";
};

// tombol tutup modal
replyspan.onclick = () => {
    replymodal.style.display = "none";
    fetchComments();
};

//tutup modal lewat luar
window.onclick = (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == replymodal) {
        replymodal.style.display = "none";
        fetchComments();
    }
};

//handle reply
writeReply.onclick = () => {
    document.querySelector(".replying").style.display = "inherit";
    document.querySelector("#replyActions").style.display = "none";
};
cancelReply.onclick = () => {
    document.querySelector(".replying").style.display = "none";
    document.querySelector("#replyActions").style.display = "inherit";
};
closeReplyModal.onclick = () => {
    replymodal.style.display = "none";
    fetchComments();
};
closeCommentModal.onclick = () => {
    modal.style.display = "none";
};

const commentCard = (id) => {
    const commentId = document.getElementById("commentIdforDelete");
    commentId.value = id;

    var menu = document.querySelector("#options-forComment");
    if (menu && menu.classList.contains("show")) {
        // Tutup menu jika terbuka
        menu.classList.remove("show");
    }

    fetchComment(commentId.value);
    replymodal.style.display = "flex";
};

function toggleMenu(kebabIcon, event, id) {
    event.stopPropagation();
    document.querySelector("#commentIdforDelete").value = id;
    var menu = document.querySelector("#options-forComment");

    // Get the position of the kebab icon
    var rect = kebabIcon.getBoundingClientRect();

    // Set the position of the menu relative to the kebab icon
    menu.style.top = rect.bottom + "px";
    menu.style.left = rect.left + "px";

    // Toggle visibility of the menu
    menu.classList.toggle("show");
    if (menu.classList.contains("show")) {
        // Add event listener to close menu when scrolling
        modalContent.addEventListener("scroll", closeMenuOnScroll);
    } else {
        // Remove the event listener when menu is hidden
        modalContent.removeEventListener("scroll", closeMenuOnScroll);
    }
}
function closeMenuComment() {
    var menu = document.querySelector("#options-forComment");
    if (menu.classList.contains("show")) {
        menu.classList.remove("show");
    }
}
function closeMenuOnScroll() {
    var menu = document.querySelector("#options-forComment");
    menu.classList.remove("show");

    // Remove the scroll event listener once menu is closed
    modalContent.removeEventListener("scroll", closeMenuOnScroll);
}

function toggleMenuReply(kebabIcon, event, id) {
    event.stopPropagation();
    document.querySelector("#replyId").value = id;
    var menu = document.querySelector("#options-forReply");

    // Get the position of the kebab icon
    var rect = kebabIcon.getBoundingClientRect();

    // Set the position of the menu relative to the kebab icon
    menu.style.top = rect.bottom + "px";
    menu.style.left = rect.left + "px";

    // Toggle visibility of the menu
    menu.classList.toggle("show");
    if (menu.classList.contains("show")) {
        // Add event listener to close menu when scrolling
        modalContentReply.addEventListener("scroll", closeMenuReplyOnScroll);
    } else {
        // Remove the event listener when menu is hidden
        modalContentReply.removeEventListener("scroll", closeMenuReplyOnScroll);
    }
}
function closeMenuReply() {
    var menu = document.querySelector("#options-forReply");
    if (menu.classList.contains("show")) {
        menu.classList.remove("show");
    }
}
function closeMenuReplyOnScroll() {
    var menu = document.querySelector("#options-forReply");
    menu.classList.remove("show");

    // Remove the scroll event listener once menu is closed
    modalContentReply.removeEventListener("scroll", closeMenuReplyOnScroll);
}
