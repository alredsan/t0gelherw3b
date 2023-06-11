
window.addEventListener('DOMContentLoaded',function(){
    let button = document.getElementById('acceptCookie');
    let cardCookie = document.getElementById('cardCookie');

    if (getCookie('accept-cookie') == ""){
        cardCookie.classList.remove('d-none');

        button.addEventListener('click',function(){
            setCookie('accept-cookie','accept',30);

            cardCookie.remove();
        });
    }


    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let re = new RegExp('(?:(?:^|.*;\\s*)' + cname + '\\s*\\=\\s*([^;]*).*$)|^.*$');
        return document.cookie.replace(re, "$1");
    }
})
