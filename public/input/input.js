$(document).ready(function() {
    console.log('ready');
    deleteEl()

    $('.js-example-basic-multiple').select2({
        placeholder: "Выберите категории фитров",
    });
});
let addBtn = $('.add_btn');

$(addBtn).click(function(e) {
    e.preventDefault()
    $.ajax({
            method: "POST",
            url: "/admin/api-feature-add",
            data: { _token: $('meta[name="csrf-token"]').attr('content') }
        })
        .done(function(msg) {
            $('.input-wrapper').append(`
        <div class="row row_input">
        <input type="text" hidden name="features_id[]" value='${msg}' class="val">
            <div class="col-md-4">
                <label>Название</label>
            <input class="form-control mb-3" type="text" name="test[title][${msg}]" placeholder="Введите Название" value="">
            </div>
            <div class="col-md-4">
                <label>Значение</label>
            <input class="form-control mb-3" type="text" name="test[title_name][${msg}]" placeholder="Введите Значение" value="">
            </div>
            <div class="col-md-2">
                <label>Иконка</label>
                <input type="file" name="test[icon][${msg}]" class="custom-file-input" value="">
            </div>
            <div class="col-md-2">
                <label>Действие</label>
                <a href="#" class="btn btn-danger delete_btn">
                        Удалить
                </a>
            </div>
        </div>
        `);
            deleteEl()
        });
})



function deleteEl() {
    $(".delete_btn").click(function(e) {
        console.log('delete')
        let parent = $(this).parent().parent();

        e.preventDefault();
        let id_el = $(this).parent().parent().children('.val').val();
        console.log(id_el);
        $.ajax({
                method: "POST",
                url: "/admin/api-feature-delete",
                data: { _token: $('meta[name="csrf-token"]').attr('content'), id: id_el }
            })
            .done(function(msg) {
                if (msg === "1") {
                    parent.remove()
                } else {
                    alert('Товар удален')
                }
            });
    })
}
