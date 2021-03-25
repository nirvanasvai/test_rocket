$(document).ready(function() {
    deleteEl();
    $('.status_update').click(function(e) {
        let dataId = $(this).attr('data-id')
        let dataType = $(this).attr('data-type')
        if ($(this).prop('checked')) {
            $.ajax({
                method: "POST",
                url: "/admin/api-update-status",
                data: { _token: $('meta[name="csrf-token"]').attr('content'), id: dataId, type: dataType, status: 1 },
                success: () => {}
            })
        } else {
            $.ajax({
                method: "POST",
                url: "/admin/api-update-status",
                data: { _token: $('meta[name="csrf-token"]').attr('content'), id: dataId, type: dataType, status: 0 },
                success: () => {}
            })
        }
    });
});
let addFilterBtn = document.querySelector('.add_filter_btn');

addFilterBtn.addEventListener('click', function(e) {
    e.preventDefault();
    $('.input-wrapper-filter').append(`
        <div class="row row_input">
                    <div class="col-md-4">
                        <label>Значение</label>
                        <input class="form-control mb-3" type="text" name="title_item[]" placeholder="Введите Значение" value="">
                    </div>
                    <div class="col-md-2">
                        <label>Действие</label>
                        <a href="#" class="btn btn-danger delete_btn_filter">
                            Удалить
                        </a>
                    </div>
                </div>
        `)
        // deleteElFilter()
})

// function deleteElFilter() {
//     $(".delete_btn_filter").click(function(e) {
//         $(this).parent().parent().remove();
//         e.preventDefault();
//         if ($(this).hasClass('have_id')) {
//             console.log($(this).attr('class'))
//         } else {
//             console.log('delete')
//         }
//         //let id_el = $(this).parent().parent().children('.val').val();
//         //console.log(id_el);
//         /*$.ajax({
//             method: "POST",
//             url: "/admin/api-feature-delete",
//             data: { _token: $('meta[name="csrf-token"]').attr('content'), id: id_el }
//         })
//             .done(function(msg) {
//                 if (msg === "1") {
//                     parent.remove()
//                 } else {
//                     alert('Товар удален')
//                 }
//             });*/
//     })
// }

$('.delete_btn_api').click(function(e) {
    e.preventDefault();
    let parent = $(this).parent().parent();
    let href = $(this).attr('href');
    $.ajax({
            method: "GET",
            url: href,
        })
        .done(function(msg) {
            if (msg) {
                $(parent).remove()
            } else {
                alert("Ошибка удаления, обратитесь к администратору !")
            }
        });
})

$('.input_ajax_update').each((i, item) => {
    $(item).focusout(function() {
        let dataId = $(this).attr('data-input')
        let dataVal = $(this).val()
        $.ajax({
            method: "POST",
            url: "/admin/api-filter-edit",
            data: { _token: $('meta[name="csrf-token"]').attr('content'), id: dataId, name: dataVal },
            success: () => {
                console.log('true');
            }
        })
    })
})
