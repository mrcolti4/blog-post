import { DEFAULT_URL } from "./constants";

const followBtn = document.querySelector('button.follow-btn');

followBtn.addEventListener('click', async function (e) {
    const userId = followBtn.dataset.userId;
    const url = `${DEFAULT_URL}/follow/${userId}`;
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        }
    });
    console.log(await response.json());
});
