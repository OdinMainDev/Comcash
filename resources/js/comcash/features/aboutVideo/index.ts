document.addEventListener("DOMContentLoaded", function() {
    let iframe = document.getElementById('about_video') as HTMLIFrameElement;
    // Check the current URL
    if (window.location.href.includes('comcash-knowledgebase/cleaning')) {
        iframe.src += "?autoplay=1";
    }
  });
