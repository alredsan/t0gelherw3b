window.addEventListener('DOMContentLoaded', function () {

    let inputSearch = $('#email');
    let formSearch = $('#searchUser');
    let users = $('#listUsers');
    let btnEdit = $('.btnEdit');
    console.log(btnEdit);
    let body = $('body');
    //let formSearch = document.forms.searchUser;
    //$(formSearch).attr('novalidate', true);
    //let actionFormSearch = formSearch.data().route


    inputSearch.keyup(function () {
        let valueInputSearch = inputSearch.val();

        if (valueInputSearch.length > 2) {

            fetch('/api/user/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/api/user/search',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: inputSearch.val()
                })
            }).then(function (response) {
                return response.json();
            }).then(function (response) {
                let list = $('<div class="list-group"></div>');

                response.forEach((user) => {
                    list.append(`<a href="#" data-email='${user.email}' class="list-group-item list-group-item-action">
                                        <span>${user.name} ${user.Apellidos}</span>
                                        <p class="fw-light text-end">${user.email}</p>
                                    </a>`);
                });
                users.empty();
                users.append(list);
                list.find('a').click(function (event) {

                    inputSearch.val($(this).data().email.trim());
                    inputSearch.attr('readonly', 'true');
                    users.empty();

                })
            }).catch(function (response) {
                console.error("Error");
                users.empty();
                users.append(`<div class="text-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        Ha producido un error de conexion, intentalo mas tarde
                    </div>`);

            })

        }



        // $.post(actionFormSearch +'?email='+ inputSearch.val()).then(
        //     function(data) {
        //         data = JSON.parse(data);

        //         let list = $('<div class="list-group"></div>');
        //         console.log(data);
        //         data.forEach((user) => {
        //             // list.append(`<a href="#" data-lat="${user.lat}" data-lon="${user.lon}" class="list-group-item list-group-item-action">
        //             // ${user.display_name}</a>`);
        //             list.append(`<a href="#" data-email='${user.email}' class="list-group-item list-group-item-action">
        //                             <span>${user.name} ${user.Apellidos}</span>
        //                             <p class="fw-light text-end">${user.email}</p>
        //                         </a>`);
        //         });
        //         users.empty();
        //         users.append(list);
        //         list.find('a').click(function(event) {

        //             inputSearch.val($(this).data().email.trim());
        //             inputSearch.attr('readonly','true');
        //             users.empty();

        //             // event.preventDefault();
        //             // event.stopPropagation();
        //         })

        //     },
        //     function(error) {
        //         users.empty();
        //         users.append(`<div class="text-danger">
        //         <i class="fas fa-exclamation-circle"></i>
        //         Ha producido un error de conexion, intentalo mas tarde
        //     </div>`);
        //     }
        // );

        // event.preventDefault();
        // event.stopPropagation();
    });

    btnEdit.click(function () {
        console.log($(this).data().src);

        fetch($(this).data().src, {
            method: "GET",

        }).then(function (data) {
            return data.json();
        }).then(function (data) {
            console.log(data);
            if (data.result = "Valido") {
                body.append(`<div class="modal fade" id="modalEditAssign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.ong.usersassign.add') }}" method="post">
                            <div class="modal-body">
                                    <p>${data.user.name}</p>
                                    <p>${data.roles}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Understood</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>`);

                let myModal = new bootstrap.Modal('#modalEditAssign', {
                    keyboard: false
                });
                myModal.show();

                let myModalDOM = document.getElementById('modalEditAssign');

                myModalDOM.addEventListener('hidden.bs.modal', event => {
                    console.log("hey");
                    myModalDOM.remove();
                })


            }
        })
    })




















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
