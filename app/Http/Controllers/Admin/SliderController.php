<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\SliderMain;
use App\Models\About;
use App\Services\Admin\SliderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = SliderMain::query()->get();
        $meta = About::where('page_type', 6)->first();
        return view('admin.site.main.slider.index',compact('sliders','meta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role!=2)
            return redirect('admin/slider')->with('warning','У вас нет прав в данный раздел!');
        return view('admin.site.main.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(SliderRequest $request,SliderService $service)
    {
        $service->create($request->validated());
        return redirect('admin/slider')->with('success','Успешно Добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(SliderMain $slider)
    {
        return view('admin.site.main.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $main = SliderMain::query()->find($id);

        if (isset($request->image)) {
            $main->image = $request->image->store('/slider');
        }

        $main->description = $request->get('description');
        $main->title = $request->get('title');
        if($request->input('url')){
            $main->url = $request->get('url');
        }
        $main->update();

        return redirect('admin/slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderMain $slider)
    {
        $slider->delete();
        return back();
    }
    public function banner(Request $request)
    {

        $main = SliderMain::query()->find($id);

        if (isset($request->image)) {
            $main->image = $request->image->store('/slider');
        }
    }
}
