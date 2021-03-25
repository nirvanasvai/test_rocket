<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\FilterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::query()->get();

        return view('admin.filters.index',compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filters.create',[
            'filter'=>[],
            'filters'=>[],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =$request->all();
        //dd($data);
        $filter = new Filter();
        $filter->title = $data['title'];
        $filter->save();

        if (isset($data['title_item'])) {
            foreach ($data['title_item'] as $items) {
                $child = new FilterItem();
                $child->title_item = $items;
                $child->filter_id = $filter->id;
                $child->save();
            }
        }
        return redirect('admin/filters');
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        return view('admin.filters.edit',compact('filter'));
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
        $data = $request->all();
        $filter  = Filter::find($id);
        $filter ->title = $data['title'];
        $filter ->update();
        //dd($data['title_item']);
        if (isset($data['title_item'])) {
            foreach ($data['title_item'] as $items) {
                $child = FilterItem::where('title_item', $items)->first();
                if(!$child){
                   $child = new FilterItem();
                    $child->title_item = $items;
                    $child->filter_id = $filter->id;
                    $child->save();
                }

            }
        }

        return redirect('admin/filters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filter  = Filter::find($id);
        $filter ->delete();
        //dd($data['title_item']);
        if (isset($data['title_item'])) {
            foreach ($data['title_item'] as $items) {
                $child = FilterItem::where('title_item', $items)->first();
                if(!$child){
                   $child = new FilterItem();
                    $child->title_item = $items;
                    $child->filter_id = $filter->id;
                    $child->delete();
                }

            }
        }

        return redirect('admin/filters')->with('success', 'Удалено!');
    }

    public function apiFilter(Request $request)
    {
        $data = $request->all();
        $filter = FilterItem::find($data['id']);
        $filter->title_item = $data['name'];
        $filter->update();
        return true;
    }
}
