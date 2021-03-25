<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DescriptionRequest;
use App\Models\Description;
use App\Services\Admin\DescriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $descriptions = Description::query()->get();
        return view('admin.description.index',compact('descriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role!=2)
            return redirect('admin/description')->with('warning','У вас нет прав в данный раздел!');
        return view('admin.description.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,DescriptionService $service)
    {



        $request->validate([
            'title'=> 'required|max:250',
            'main_title'=>'required|max:250',
            'description'=>'required',
            'main_description'=>'required|',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'title.required' => 'Заголовок обязательно для заполнения',
            'main_title.required' => 'Заголовок обязательно для заполнения',
            'title.max' => 'Длина текста Заголовок слишком большой',
            'main_title.max' => 'Длина текста Заголовок слишком большой',
            'description.required' => 'Описание блока обязательно для заполнения',
            'main_description.required' => 'Описание для страниц обязательно для заполнения',
            'image.required' => 'Изображение блока обязательно для заполнения',
            'main_image.required' => 'Изображение для страниц обязательно для заполнения',
            'image.mimes' => 'Проверьте формат изображения для блока',
            'main_image.mimes' => 'Проверьте формат изображения для страниц',
            'icon.required' => 'Иконка для меню обязательно для заполнения',
            'icon.mimes' => 'Проверьте формат иконки',
        ]);
        $requestData = $request->all();
        $data = new Description();
        $data->title = $requestData['title'];
        $data->main_title = $requestData['main_title'];
        $data->description = $requestData['description'];
        $data->main_description = $requestData['main_description'];
        if(isset($requestData['image'])){
            $data->image = $requestData['image']->store('/des');
        }
        if(isset($requestData['main_image'])){
            $data->main_image = $requestData['main_image']->store('/des');
        }
        if(isset($requestData['icon'])){
            $data->icon = $requestData['icon']->store('/des');
        }
        if($data->save()){
            return redirect('admin/partners_page?tab=block-tab')->with('success','Успешно Добавлено');
        }else{
            return redirect('admin/partners_page?tab=block-tab')->with('warning','Ошибка записи');
        }

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
    public function edit(Description $description)
    {
        return view('admin.description.edit',compact('description'));
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
            'title'=> 'required|max:250',
            'main_title'=>'required|max:250',
            'description'=>'required',
            'main_description'=>'required|',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'title.required' => 'Заголовок обязательно для заполнения',
            'main_title.required' => 'Заголовок обязательно для заполнения',
            'title.max' => 'Длина текста Заголовок слишком большой',
            'main_title.max' => 'Длина текста Заголовок слишком большой',
            'description.required' => 'Описание блока обязательно для заполнения',
            'main_description.required' => 'Описание для страниц обязательно для заполнения',
            'image.mimes' => 'Проверьте формат изображения для блока',
            'main_image.mimes' => 'Проверьте формат изображения для страниц',
            'icon.mimes' => 'Проверьте формат иконки',
        ]);
        $requestData = $request->all();

        $data = Description::find($id);
        $data->title = $requestData['title'];
        $data->main_title = $requestData['main_title'];
        $data->description = $requestData['description'];
        $data->main_description = $requestData['main_description'];
        if(isset($requestData['image'])){
            $data->image = $requestData['image']->store('/des');
        }
        if(isset($requestData['main_image'])){
            $data->main_image = $requestData['main_image']->store('/des');
        }
        if(isset($requestData['icon'])){
            $data->icon = $requestData['icon']->store('/des');
        }
        if($data->update()){
            return redirect('admin/partners_page?tab=block-tab')->with('success','Успешно Обнавлено');
        }else{
            return redirect('admin/partners_page?tab=block-tab')->with('warning','Ошибка записи');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Description $description)
    {
        $description->delete();
        return back();
    }
    public function destroyDesc($id)
    {
        $data = Description::findOrFail($id);

        if($data->delete()){
            return redirect('admin/partners_page?tab=block-tab')->with('success','Успешно удалено');
        }else{
            return redirect('admin/partners_page?tab=block-tab')->with('warning','Ошибка удаления');
        }

    }
}
