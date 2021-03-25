<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Filter;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\BaseTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requestData = $request->all();
        if(isset($requestData['parent_id'])){
            $categories = Category::where('parent_id', $requestData['parent_id'])->orderBy('parent_id', 'ASC')->get();
            $parent_id = $requestData['parent_id'];
        }else{
            $categories = Category::whereNull('parent_id')->orderBy('parent_id', 'ASC')->get();
            $parent_id = false;
        }

        return view('admin.category.index',compact('categories', 'parent_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $requestData = $request->all();
        $select = NULL;
        if(isset($requestData['parent_id'])){
            $select = $requestData['parent_id'];
        }
        if(Auth::user()->role!=2)
            return redirect('admin/category')->with('warning','У вас нет прав в данный раздел!');
        return view('admin.category.create',
            [
                'categories' => Category::with('childs')->where('parent_id', null)->get(),
                'delimiter'  => '',
                'filters' => Filter::all(),
                'select' => $select,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(isset($data['parent_id'])){
            $parent_catalog = Category::where('parent_id', $data['parent_id'])->first();

            if(!isset($parent_catalog->id)){
                return redirect('/admin/category?parent_id='.$data['parent_id'])
                ->with('warning', 'Нельзя добавить подкатегорию!');
            }
        }
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|numeric',
            'slug' => 'nullable',
            'description'=> 'nullable',
            'description_short'=> 'nullable',
            'title' => 'required'
        ],
        [
            'title.required' => 'Заголовок обязательно для заполнения'
        ]);

        $requestData = $request->all();

        if ($request->file('image')) {
            $image = $request->file('image');
            $name = Str::random(32).'.'.$image->extension();

            $image->move(public_path().'/images/category/', $name);
        }

        $category = new Category();

        $category->title = $requestData['title'];
        $category->image = $requestData['image'];

        if ($requestData['parent_id']) {
            $category->parent_id = $requestData['parent_id'];
        }
        $category->description = $requestData['description'];
        $category->description_short = $requestData['description_short'];

        if (isset($requestData['filters'])) {
            $category->filters = json_encode($requestData['filters']);
        }

        if (isset($requestData['meta_title'])) {
            $category->meta_title = $requestData['meta_title'];
        }
        if (isset($requestData['meta_description'])) {
            $category->meta_description = $requestData['meta_description'];
        }

        $category->slug = Str::slug($requestData['title']);

        $category->save();
        if($category->parent_id != NULL){
            return redirect('admin/category?parent_id='.$category->parent_id)->with('success', 'Категория успешно создана!');
        }else{
            return redirect('admin/category')->with('success', 'Категория успешно создана!');
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
    public function edit(Category $category, Request $request)
    {
        $requestData = $request->all();
        $select = NULL;
        if(isset($requestData['parent_id'])){
            $select = $requestData['parent_id'];
        }
        return view('admin.category.edit',
            [
                'category'   => $category,
                'categories' => Category::where([['id', '!=', $category->id], ['parent_id','=', NULL]])->get(),
                'delimiter'  => '',
                'filters' => Filter::all(),
                'select' => $select,
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|numeric',
            'slug' => 'nullable',
            'description'=> 'nullable',
            'description_short'=> 'nullable',
            'title' => 'required'
        ],
        [
            'title.required' => 'Заголовок обязательно для заполнения'
        ]);

        $requestData = $request->all();
        //dd($requestData);
        $category = Category::find($id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name = Str::random(32).'.'.$image->extension();
            $image->move(public_path().'/images/category/', $name);

            $category->image = $name;
        }

        $category->meta_title = $requestData['meta_title'];
        $category->meta_description = $requestData['meta_description'];


        $category->title = $requestData['title'];
        $category->sub_title = $requestData['sub_title'];

        if ($requestData['parent_id']) {
            if($category->childs()->count() < 1){
                $category->parent_id = $requestData['parent_id'];
            }else {
                return redirect()->back()->with('warning', 'У категории имеются под категории!');
            }
        }

        $category->description = $requestData['description'];
        $category->description_short = $requestData['description_short'];

        if (isset($requestData['filters'])) {
            $category->filters = $requestData['filters'];
        }

        $category->slug = Str::slug($requestData['title']);
        $category->update();
        if($category->parent_id != NULL){
            return redirect('admin/category?parent_id='.$category->parent_id)->with('success', 'Категория успешно обновлена!');
        } else{
            return redirect('admin/category')->with('success', 'Категория успешно обновлена!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $catregory = Category::find($id);
        if($catregory->parent_id){
            $product = Product::where('category_id', $id)->get();
            if(isset($product)){
                return back()
                ->with('warning', 'Сначала необходимо удалить все товары категории!');
            }else{
                if($catregory->delete()){
                    return back()
                    ->with('success', 'Категория удалена!');
                }
            }
        }else{
            $sub_category = Category::where('parent_id', $id)->get();
            if(isset($sub_category[0]->id)){
                return back()
                ->with('warning', 'Сначала необходимо удалить под категории!');
            }else{
                if($catregory->delete()){
                    return back()
                    ->with('success', 'Категория удалена!');
                }
            }
        }
    }
}
