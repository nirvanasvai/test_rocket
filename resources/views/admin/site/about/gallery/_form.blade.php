<div class="shadow card">
    <div class="card-header">

		@component('admin.components.check')
		@endcomponent

    </div>
</div>
@if(Request::is('admin/gallery*edit'))
        <label for="">Фотографии для Галереи(800-600)</label>
        <div class="input-group control-group increment" >
            <input type="file" name="image" multiple class="form-control">
            <div class="input-group-btn">
            </div>
        </div>
@endif
@if(Request::is('admin/gallery*create'))
    <label for="">Фотографии для Галереи(800-600)</label>
    <div class="input-group control-group increment" >
        <input type="file" name="image[]" multiple class="form-control">
        <div class="input-group-btn">
        </div>
    </div>


@endif


<script type="text/javascript">

    $(document).ready(function() {

        $(".btn-success").click(function(){
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click",".btn-danger",function(){
            $(this).parents(".control-group").remove();
        });

    });

</script>
