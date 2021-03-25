<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role!=2)
            return redirect('admin/criterion')->with('warning','У вас нет прав в данный раздел!');

        return view('admin.criterion.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=> 'required|max:250',
            'description'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'name.required' => 'Заголовок обязательно для заполнения',
            'name.max' => 'Длина текста Заголовок слишком большой',
            'description.required' => 'Описание блока обязательно для заполнения',
            'image.required' => 'Изображение блока обязательно для заполнения',
            'image.mimes' => 'Проверьте формат изображения для блока',
        ]);
        $requestData = $request->all();
        $data = new Brand();
        $data->name = $requestData['name'];
        $data->description = $requestData['description'];

        if (isset($requestData['meta_title'])) {
            $data->meta_title = $requestData['meta_title'];
        }
        if (isset($requestData['meta_description'])) {
            $data->meta_description = $requestData['meta_description'];
        }

        $data->slug = Str::slug($requestData['name']);
        if(isset($requestData['image'])){
            $data->image = $requestData['image']->store('/brands');
        }
        //dd($data);
        if($data->save()){
            return redirect('admin/criterion')->with('success','Успешно Добавлено');
        }else{
            return redirect('admin/criterion')->with('warning','Ошибка записи');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.criterion.brand.edit',compact('brand'));
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

        $request->validate([
            'name'=> 'required|max:250',
            'description'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'name.required' => 'Заголовок обязательно для заполнения',
            'name.max' => 'Длина текста Заголовок слишком большой',
            'description.required' => 'Описание блока обязательно для заполнения',
            'image.mimes' => 'Проверьте формат изображения для блока',
        ]);
        $requestData = $request->all();
        $data = Brand::find($id);
        $data->name = $requestData['name'];
        $data->description = $requestData['description'];
        $data->slug = Str::slug($requestData['name']);
        if(isset($requestData['image'])){
            $data->image = $requestData['image']->store('/brands');
        }

        $data->meta_title = $requestData['meta_title'];
        $data->meta_description = $requestData['meta_description'];
        $data->update();

        return redirect('admin/criterion')->with('success','Успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back();
    }
}
