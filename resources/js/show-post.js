const select = document.querySelector("select.comments-sort");
const commentsList = document.querySelector("div.comments-list");
const voteBtns = document.querySelectorAll("[data-vote-event]");
const postLikesCount = document.querySelector(".post-likes-count");
const comments = commentsList.querySelectorAll("div.comment");

select.addEventListener("change", async function (e) {
    const sortType = this.value;
    const url = `{{ url('posts/') }}/{{$post->id}}/comments/index?sort=${sortType}`;
    const response = await fetch(url);

    const data = await response.json();
    commentsList.innerHTML = data.body;
});

voteBtns.forEach((btn) => {
    btn.addEventListener("click", async function (e) {
        // Get the event (like or dislike) and model (Post or Comment)
        const event = e.currentTarget.dataset.voteEvent;
        const model = e.currentTarget.dataset.voteTarget;
        // Get the id for model
        const id = e.currentTarget.closest("[data-id]").dataset.id;
        // Create dynamic url
        const url = `${window.location.protocol}//${window.location.host}/vote/${model}/${id}`;
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ event: event }),
        });
        // Get the response (Difference between likes and dislikes, target)
        const { result, target } = await response.json();
        // Change likes count for corresponding comment
        const targetType = target.type.split("\\");
        const postType = targetType[targetType.length - 1];
        if (btn.closest("div.comment")) {
            const comment = btn.closest("div.comment");
            comment.querySelector(".comment-likes-count").innerHTML = result;
        } else {
            // Change likes count for post
            postLikesCount.innerHTML = result;
        }
    });
});
function handleVoteClick(button) {
    const comment = button.closest("div.comment");
    const likeBtn = comment.querySelector("button.like-btn i");
    const dislikeBtn = comment.querySelector("button.dislike-btn i");
    if (button.classList.contains("like-btn")) {
        likeBtn.classList.toggle("fa-regular");
        likeBtn.classList.toggle("fa-solid");
        dislikeBtn.classList.add("fa-regular");
        dislikeBtn.classList.remove("fa-solid");
    } else {
        dislikeBtn.classList.toggle("fa-regular");
        dislikeBtn.classList.toggle("fa-solid");
        likeBtn.classList.add("fa-regular");
        likeBtn.classList.remove("fa-solid");
    }
}

comments.forEach((comment) => {
    comment.addEventListener("click", (e) => {
        const target = e.target.closest("button");
        if (
            target.classList.contains("like-btn") ||
            target.classList.contains("dislike-btn")
        ) {
            handleVoteClick(target);
        }
    });
});
