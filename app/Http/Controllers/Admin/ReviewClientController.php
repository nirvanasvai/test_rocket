<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewClient;
use Illuminate\Http\Request;

class ReviewClientController extends Controller
{

    public function showReview()
    {
        $reviewClient = ReviewClient::query()->get();
        return view('admin.review.show',compact('reviewClient'));
    }
    public function editReview($id)
    {
        $review = ReviewClient::query()->find($id);
        return view('admin.review.review_client.edit',compact('review'));
    }

    public function updateReview(Request $request, $id)
    {
        $data = ReviewClient::query()->find($id);
        $data->name = $request->get('name');
        $data->review = $request->get('review');
        $data->rating = $request->get('rating');
        $data->status = $request->get('status');

        $data->update();

        return redirect('review_client')->with('success','Успешно Обнавлено!');
    }

    public function createReview(Request $request)
    {
       $val = $request->validate([
            'name'=>'required|max:100',
            'review'=>'required|max:500'
        ]);

       $data = $request->all($val);
        if (ReviewClient::query()->create($data)) {

            return true;
        }
    }

    public function destroyReview($id)
    {
        $call = ReviewClient::query()->find($id);
        $call->query()->delete();

        return back();
    }

}
