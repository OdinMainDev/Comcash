document.querySelector("#video-container .play-btn")
    ?.addEventListener("click", () => {
        document.getElementById("video-container")!.innerHTML = `
            <iframe id="about_video" class="w-full h-full object-cover video-js about__video"
                src="https://www.youtube.com/embed/bAofntH1j-E?autoplay=1"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        `;
    });
