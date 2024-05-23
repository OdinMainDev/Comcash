document.addEventListener("DOMContentLoaded", function() {
    let video = document.getElementById('about_video') as HTMLVideoElement;
    if (window.location.href.includes('comcash-knowledgebase/cleaning')) {
      if (video.readyState >= 3) {
        video.play();
      } else {
        video.oncanplaythrough = function() {
          video.play();
        };
      }
    }
  });
