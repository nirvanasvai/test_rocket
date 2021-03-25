<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Services\Admin\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use voku\helper\ASCII;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::query()->where('page_type', 0)->get();
        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $data = $request->all();
        if(Auth::user()->role!=2)
            return redirect('admin/blog')->with('warning','У вас нет прав в данный раздел!');
        return view('admin.blog.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request,BlogService $service)
    {
       
        $val = $request->validate([
            'description'         => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'      => 'nullable|max:250',
            'name'      => 'nullable|max:250',
            'slug'               => 'nullable',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'page_type' => 'nullable'
        ]);

        $main = new Blog();

        if (isset($request->image)) {
            $main->image = $request->image->store('/blog');
        }

        if (isset($request->icon)) {
            $main->icon = $request->icon->store('/blog');
        }

        $main->description = $request->get('description');
        $main->name = $request->get('name');
        $main->title = $request->get('title');
        
        if (isset($request->page_type)) {
            $main->page_type = $request->get('page_type');
        }

        $main->slug = $request->get('slug');
        $main->save();
        if (isset($request->page_type)) {
            return redirect('admin/blog/'.$main->id.'/edit?page_type='.$request->get('page_type'))->with('success','Успешно Добавлено!');
        }else{
            return redirect('admin/blog')->with('success','Успешно Добавлено!');
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
        
    public function edit(Blog $blog, Request $request)
    {
        $data = $request->all();
        return view('admin.blog.edit',compact('blog', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(BlogRequest $request, $id)
    {
        $main = Blog::query()->find($id);
        if (isset($request->image)) {
            $main->image = $request->image->store('/blog');
        }

        if (isset($request->icon)) {
            $main->icon = $request->icon->store('/blog');
        }

        $main->description = $request->get('description');
        $main->name = $request->get('name');
        $main->title = $request->get('title');
        
        $main->slug = $request->get('slug');

        $main->update();

        if(isset($request->page_type)){
            return redirect('admin/blog/'.$main->id.'/edit?page_type=1')->with('seccess', 'Успешно!');
        }else{
            return redirect('admin/blog');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}
