<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\About;
use App\Models\SliderMain;
use App\Services\Admin\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::query()->get();
        return view('admin.site.main.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::user()->role!=2)
            return redirect('admin/service')->with('warning','У вас нет прав в данный раздел!');

            $data = $request->all();
        return view('admin.site.main.service.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ServiceRequest $request,ServiceService $service)
    {

        $service->create($request->validated());
        return redirect('admin/service_page')->with('success','Успешно Добавлено!');
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
    public function edit(Service $service)
    {

        return view('admin.site.main.service.edit',compact('service'));
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
        $main = Service::query()->find($id);
        if (isset($request->image)) {
            $main->image = $request->image->store('/service');
        }
        if (isset($request->main_image)) {
            $main->main_image = $request->main_image->store('/service');
        }

        $main->description = $request->get('description');
        $main->name = $request->get('name');
        $main->description_title = $request->get('description_title');
        $main->update();

        return redirect('admin/service_page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success','Успешно Удалено!');
    }
    public function destroyServ($id)
    {
        $data = Service::findOrFail($id);

        if($data->delete()){
            return redirect('admin/service_page?tab=block-tab')->with('success','Успешно удалено');
        }else{
            return redirect('admin/service_page?tab=block-tab')->with('warning','Ошибка удаления');
        }

    }
}
