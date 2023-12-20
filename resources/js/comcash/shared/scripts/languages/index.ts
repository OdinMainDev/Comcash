import $ from 'jquery';

$(document).ready(function () {
    const language = $('.language_select');
    const languages:string[] = [];


    language.each(function() {
        languages.push($(this).attr("name") || '')
    });

    console.log(languages);
    language.on('click', function(): void {
        navigateToLanguagePage($(this).attr("name") || '');
    })
    function navigateToLanguagePage(language: string) {
        const url = window.location.href;
        const languagesPatternString = languages.join('|');
        const languagePattern = new RegExp('\/(' + languagesPatternString + ')\/?', 'i');
        const match = url.match(languagePattern);

        if(match && match[1] !== language) {
            window.location.href = `/${language}`;
        }
    }

})