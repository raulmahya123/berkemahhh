const modal = document.querySelector("#commentModal");
const replymodal = document.querySelector("#replyModal");
const btn = document.querySelector("#openModalBtn");
const span = document.querySelector(".close");
const replyspan = document.querySelector(".replyclose");
const writeReply = document.querySelector("#writeReply");
const cancelReply = document.querySelector("#cancelReply");
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
};

//tutup modal lewat luar
window.onclick = (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == replymodal) {
        replymodal.style.display = "none";
    }
};

//handle click card
const commentCard = (element) => {
    // modal.style.display = "flex";
    const elementId = element.id;
    replymodal.style.display = "flex";
    console.log("ID dari elemen yang diklik: " + elementId);
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
