<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutGalleryRequest;
use App\Models\AboutGallery;
use App\Models\ImageAbout;
use App\Services\Admin\AboutImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;
use Intervention\Image\Facades\Image as ImageInt;
use Illuminate\Support\Str;

class AboutGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = AboutGallery::query()->orderBy('id', 'DESC')->get();
        return view('admin.site.about.gallery.index',compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role!=2)
            return redirect('admin/about')->with('warning','У вас нет прав в данный раздел!');
        return view('admin.site.about.gallery.create',['images'=>ImageAbout::query()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'

        ]);

        if($request->hasfile('image'))
        {

            foreach($request->file('image') as $image)
            {
                $name= Str::random(32).'.'.$image->extension();

                $image->move(public_path().'/images/gallery/', $name);

                $form= new AboutGallery();
                $form->image = $name;
                $form->save();
            }
        }

        return redirect('admin/gallery')->with('success', 'Your images has been successfully Upload.');


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
    public function edit(AboutGallery $gallery)
    {
        return view('admin.site.about.gallery.edit',compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $form = AboutGallery::query()->find($id);
        if($request->image != ''){
            $path = public_path().'/images/gallery/';

            //code for remove old file
            if($form->image != ''  && $form->image != null){
                $file_old = $path.$form->image;
                unlink($file_old);
            }

            //upload new file
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $image->move($path, $filename);

            //for update in table
            $form->update(['image' => $filename]);
        }
        return redirect('admin/gallery')->with('success', 'Успешно Обнавлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutGallery $gallery)
    {
        $gallery->delete();
        return back();
    }
}
