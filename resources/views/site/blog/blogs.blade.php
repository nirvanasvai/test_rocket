
<div class="col-xl-9 col-lg-8">
    @foreach($blog_info as $item)
    <div class="blog_content">
        <div class="blog_img">
            <img src="/storage/{{$item->image ?? ''}}" alt="">
        </div>
        <div class="title_block">
             <h3>{{$blog_info->title_name}}</h3>
        </div>
        <div class="blog_text">
                {!!$blog_info->advantages ?? ''!!}
        </div>
        <div class="blog_content">
            @foreach($blogs as $item)
                <section id="section_{{$item->id}}">
                    <div class="title_block">
                        <h2>{{$item->main_title ?? ''}}</h2>
                    </div>
                    <div class="blog_img">
                        <img src="{{'/storage/'.$item->main_image}}" alt="">
                        <div class="blog_text">
                            {!!$item->main_description ?? ''!!}

                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
    @endforeach
</div>




