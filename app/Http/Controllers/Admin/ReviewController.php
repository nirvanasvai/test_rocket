<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewClient;
use App\Services\Admin\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::query()->orderBy('id', 'DESC')->get();
        return view('admin.review.show',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.review.create',
            [
                'products'=>Product::query()->get()

            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ReviewRequest $request,ReviewService $service)
    {
        $main = new Review();

        if (isset($request->image)) {
            $main->image = $request->image->store('/review_ava');
        }

        $main->review = $request->get('review');
        $main->name = $request->get('name');
        $main->product_id = $request->get('product_id');
        $main->last_name = $request->get('last_name');
        $main->rating = $request->get('rating');

        $main->save();

        return redirect('admin/review')->with('success','Успешно Добавлено');
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
    public function edit(Review $review)
    {
        return view('admin.review.edit',compact('review'),
            [
                'products'=>Product::query()->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(ReviewRequest $request, $id)
    {
        $main = Review::query()->find($id);
        if (isset($request->image)) {
            $main->image = $request->image->store('/review_ava');
        }
        $main->review = $request->get('review');
        $main->name = $request->get('name');
        $main->product_id = $request->get('product_id');
        $main->last_name = $request->get('last_name');
        $main->rating = $request->get('rating');
        $main->update();

        return redirect('admin/review');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return back();
    }
    public function apiReview(Request $request)
    {
        $requestData = $request->all();
        
        $val = $request->validate([
            'name'=>'required|max:15',
            'email'=>'required|max:100',
            'review'=>'required|max:100',
            'rating'=>'required|max:1',
            'g-recaptcha-response' => 'required'
        ],[
            'name.required'=>'Поле Имя обязательно для заполнения',
            'email.required'=>'Поле e-mail обязательно для заполнения',
            'review.required'=>'Поле отзыв обязательно для заполнения',
            'name.max'=>'Ошибка в поле Имя',
            'email.max'=>'Ошибка в поле E-mail',
            'review.max'=>'Ошибка в поле Отзыв',
            'rating.required' => 'Поставьте оценку',
            'g-recaptcha-response.required' => 'Подтвердите что вы не робот'
        ]);
        $review = new Review();
        $review->name = $requestData['name'];
        $review->last_name = $requestData['last_name'];
        $review->email = $requestData['email'];
        $review->review = $requestData['review'];
        $review->rating = $requestData['rating'];
        $review->product_id = $requestData['id_product'];
        if($review->save()){
            return true;
        } else{
            return false;
        }
    }
}
