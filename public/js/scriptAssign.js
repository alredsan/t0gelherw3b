console.log("hola");
window.addEventListener('DOMContentLoaded',function(){

    let inputSearch = document.getElementById('email');
    let formSearch = document.forms.searchUser;
    let users = $('#listUsers');
    $(formSearch).attr('novalidate', true);


    inputSearch.addEventListener('keyup',function(){

        formSearch.submit();
    });

    formSearch.addEventListener('submit',function(event){

        $.get(this.action +'?ss'+ formSearch.serialize()).then(
            function(data) {

                let list = $('<div class="list-group"></div>');
                data.forEach((user) => {
                    // list.append(`<a href="#" data-lat="${user.lat}" data-lon="${user.lon}" class="list-group-item list-group-item-action">
                    // ${user.display_name}</a>`);
                    list.append(`<a href="#" class="list-group-item list-group-item-action">
                    ${user}</a>`);
                });
                users.empty();
                users.append(list);
                list.find('a').click(function(event) {

                    inputSearch.val($(this).text().trim());
                    users.empty();

                    event.preventDefault();
                    event.stopPropagation();
                })

            },
            function(error) {
                users.empty();
                users.append(`<div class="text-danger">
                <i class="fas fa-exclamation-circle"></i>
                No se ha podido establecer la conexión con el BBDD.
            </div>`);
            }
        )

        event.preventDefault();
        event.stopPropagation();
    })

});
