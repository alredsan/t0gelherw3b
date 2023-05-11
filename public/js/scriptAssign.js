console.log("hola");
window.addEventListener('DOMContentLoaded',function(){

    let inputSearch = $('#email');
    let formSearch = document.forms.searchUser;
    $(formSearch).attr('novalidate', true);
    console.log(formSearch);

    let users = $('#listUsers');


    inputSearch.keyup(function(){

        //formSearch.submit();
        console.log(formSearch.action +'?email='+ inputSearch.val());
        let formSearch2 = $(this);

        $.get(formSearch.action +'?email='+ inputSearch.val()).then(
            function(data) {
                data = JSON.parse(data);

                let list = $('<div class="list-group"></div>');
                console.log(data);
                data.forEach((user) => {
                    // list.append(`<a href="#" data-lat="${user.lat}" data-lon="${user.lon}" class="list-group-item list-group-item-action">
                    // ${user.display_name}</a>`);
                    list.append(`<a href="#" class="list-group-item list-group-item-action">
                    ${user.name}</a>`);
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
        );

        // event.preventDefault();
        // event.stopPropagation();
    });

    // formSearch.submit(function(event){
    //     console.log("hiolaaa");
    //     let formSearch2 = $(this);

    //     $.get(this.action +'?ss'+ formSearch2.serialize()).then(
    //         function(data) {

    //             let list = $('<div class="list-group"></div>');
    //             data.forEach((user) => {
    //                 // list.append(`<a href="#" data-lat="${user.lat}" data-lon="${user.lon}" class="list-group-item list-group-item-action">
    //                 // ${user.display_name}</a>`);
    //                 list.append(`<a href="#" class="list-group-item list-group-item-action">
    //                 ${user}</a>`);
    //             });
    //             users.empty();
    //             users.append(list);
    //             list.find('a').click(function(event) {

    //                 inputSearch.val($(this).text().trim());
    //                 users.empty();

    //                 event.preventDefault();
    //                 event.stopPropagation();
    //             })

    //         },
    //         function(error) {
    //             users.empty();
    //             users.append(`<div class="text-danger">
    //             <i class="fas fa-exclamation-circle"></i>
    //             No se ha podido establecer la conexión con el BBDD.
    //         </div>`);
    //         }
    //     );

    //     event.preventDefault();
    //     event.stopPropagation();
    // });

});
