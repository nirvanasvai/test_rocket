<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\Image;
use App\Models\Service;
use App\Services\Admin\AboutService;
use App\Models\Description;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function main()
    {
        return view('admin.site.main.index');
    }

    public function index()
    {

        $about = About::where('page_type', 0)->first();
        return view('admin.site.about.index',compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');

        $about = About::where('page_type', 0)->first();
        $data = $request->all();

        return view('admin.site.about.create', compact('about','data'));
    }

    public function createSale(Request $request)
    {
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');

        $about = About::where('page_type', 1)->first();
        return view('admin.site.about.create_sale', compact('about'));
    }

    public function createBrands(Request $request)
    {
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');

        $about = About::where('page_type', 2)->first();
        return view('admin.site.about.create_brands', compact('about'));
    }
    public function createService(Request $request)
    {
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');

        $about = About::where('page_type', 3)->first();
        $data = $request->all();
        return view('admin.site.about.create_service', compact('about', 'data'),
        [
            'services'=>Service::query()->get()
        ]);
    }

    public function createPartner(Request $request)
    {
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $data = $request->all();
        $about = About::where('page_type', 4)->first();
        $descriptions = Description::query()->get();
        return view('admin.site.about.create_partner', compact('about','descriptions','data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(AboutRequest $request,AboutService $service)
    {
        $service->create($request->validated());
//        dd($request->all());

        return redirect('admin/about')->with('success','Успешно Добавлено!');
    }
    public function storeSale(Request $request)
    {
        $dataAll = $request->all();
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $main = About::where('page_type', 1)->first();
        if($main){
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }


                $main->meta_title = $request->get('meta_title');


                $main->meta_description = $request->get('meta_description');


            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->update();
        }else{
            $main = new About();
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }

            if (!empty($request->input('meta_title'))) {
                $main->meta_title = $request->get('meta_title');
            }
            if (!empty($request->input('meta_description'))) {
                $main->meta_description = $request->get('meta_description');
            }

            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');
            $main->page_type = $request->get('page_type');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->save();
        }
        return redirect('admin/sale')->with('success','Успешно Добавлено!');
    }

    public function storeBrands(Request $request)
    {
        //dd($request->all());
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $main = About::where('page_type', 2)->first();
        if($main){
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }
            $main->description = $request->get('description');
            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');


            $main->meta_title = $request->get('meta_title');
            $main->meta_description = $request->get('meta_description');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->update();
        }else{
            $main = new About();
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }

            if (!empty($request->input('meta_title'))) {
                $main->meta_title = $request->get('meta_title');
            }
            if (!empty($request->input('meta_description'))) {
                $main->meta_description = $request->get('meta_description');
            }

            $main->description = $request->get('description');
            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');
            $main->page_type = $request->get('page_type');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->save();
        }
        return redirect('admin/brands')->with('success','Успешно Добавлено!');
    }

    public function storeService(Request $request)
    {
        //dd($request->all());
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $main = About::where('page_type', 3)->first();
        if($main){
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }
            $main->description = $request->get('description');
            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');


            $main->meta_title = $request->get('meta_title');


            $main->meta_description = $request->get('meta_description');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->update();
        }else{
            $main = new About();
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }
            $main->description = $request->get('description');
            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');
            $main->page_type = $request->get('page_type');


            $main->meta_title = $request->get('meta_title');


            $main->meta_description = $request->get('meta_description');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->save();
        }
        return redirect('admin/service_page')->with('success','Успешно Добавлено!');
    }

    public function storePartner(Request $request)
    {
        //dd($request->all());
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $main = About::where('page_type', 4)->first();
        if($main){
            //dd($request->all());
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }


            $main->meta_title = $request->get('meta_title');


            $main->meta_description = $request->get('meta_description');

            $main->description = $request->get('description');
            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->update();
        }else{
            $main = new About();
            if (isset($request->image)) {
                $main->image = $request->image->store('/blog');
            }

            if (isset($request->icon)) {
                $main->icon = $request->icon->store('/blog');
            }
            $main->description = $request->get('description');
            $main->advantages = $request->get('advantages');
            $main->title_name = $request->get('title_name');
            $main->page_type = $request->get('page_type');

            $main->meta_title = $request->get('meta_title');
            $main->meta_description = $request->get('meta_description');

            if(!empty($request->input('slug'))){
                $main->slug = $request->get('slug');
            }else{
                $main->slug = Str::slug($request->get('title_name'));
            }

            $main->save();
        }
        //dd($request->all());
        return redirect('admin/partners_page')->with('success','Успешно Добавлено!');
    }

    public function storeContact(Request $request)
    {
        //dd($request->all());
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $main = About::where('page_type', 5)->first();
        if($main){

            $main->meta_title = $request->get('meta_title');


            $main->meta_description = $request->get('meta_description');

            $main->update();
        }else{
            $main = new About();

            $main->page_type = $request->get('page_type');
            $main->meta_title = $request->get('meta_title');
            $main->meta_description = $request->get('meta_description');
            $main->slug = 'contact';
            $main->save();
        }
        //dd($request->all());
        return redirect('admin/info')->with('success','Успешно Добавлено!');
    }

    public function storeHome(Request $request)
    {
        //dd($request->all());
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        $main = About::where('page_type', 6)->first();
        if($main){
                $main->meta_title = $request->get('meta_title');
                $main->meta_description = $request->get('meta_description');

            $main->update();
        }else{
            $main = new About();

            $main->page_type = $request->get('page_type');

            if (!empty($request->input('meta_title'))) {
                $main->meta_title = $request->get('meta_title');
            }
            if (!empty($request->input('meta_description'))) {
                $main->meta_description = $request->get('meta_description');
            }
            $main->slug = '/';
            $main->save();
        }
        //dd($request->all());
        return redirect('admin/slider')->with('success','Успешно Добавлено!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('admin.site.about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(AboutRequest $request, $id)
    {
        $about = (new About())->updateAbout($request, $id);
        if(!empty($request->input('slug'))){
            $about->slug = $request->get('slug');
        }else{
            $about->slug = Str::slug($request->get('title_name'));
        }

        $about->update();


        return redirect('admin/about')->with('success','Успешно Обнавлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(About $about)
    {
        //$about->delete();
        return back();
    }

    public function deleteImg(Request $request)
    {
        //dd($request->all());
        $about = About::first();

        if($request->get('type') == 'block'){
            $about->block_image = NULL;
        }else{
            $about->image = NULL;
        }
        if($about->update()){
            return redirect('admin/about')->with('success','Удалено!');
        }

    }

}
