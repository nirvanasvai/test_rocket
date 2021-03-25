<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\CallBackUrl;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CallBackController extends Controller
{
    public function createCall(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:25',
            'phone'=>'required',
            'comment'=>'nullable|max:500'
        ]);

        $data = $request->all();
        CallBack::query()->create($data);
        return redirect()->back()->with('success','Ваша заявка успещно принято! В скором времени с вами свяжется наш менеджер');
    }

    public function editCall($id)
    {
        $call = CallBack::query()->find($id);
        return view('admin.call.edit',compact('call'));
    }
    public function editCallUrl($id)
    {
        $call = CallBackUrl::query()->find($id);
        return view('admin.call.callUrl.edit',compact('call'));
    }

    public function updateCall(Request $request, $id)
    {
        $data = CallBack::query()->find($id);
        $data->name = $request->get('name');
        $data->phone = $request->get('phone');
        $data->comment = $request->get('comment');

        $data->update();

        return redirect('admin')->with('success','Успешно Обнавлено!');
    }
    public function updateCallUrl(Request $request, $id)
    {
        $data = CallBackUrl::query()->find($id);
        $data->name = $request->get('name');
        $data->phone = $request->get('phone');
        $data->email = $request->get('email');
        $data->comment = $request->get('comment');

        $data->update();

        return redirect('admin')->with('success','Успешно Обнавлено!');
    }

    public function destroyCall($id)
    {
        $call = CallBack::query()->find($id);
        $call->delete();

        return back()->with('success','Заявка удалена!');
    }
    public function destroyCallUrl($id)
    {

        $call = CallBackUrl::query()->find($id);

        $call->delete();

        return back();
    }

    public function createRequest(Request $request)
    {
        request()->validate([
            'g-recaptcha-response' => 'required',
        ],
        [
            'g-recaptcha-response.required' => 'Подтвердите что вы не робот'
        ]);
        $data = $request->all();
        if($data['type'] == 'product_order'){
            $order = new CallBackUrl();
            $order->name = $data['name'];
            $order->email = $data['email'];
            $order->comment = $data['comment'];
            $order->phone = $data['phone'];
            $order->product_id = $data['product_id'];

            if ($order->save()) {
                return true;
            }

        }if($data['type'] == 'top_order'){

            if(CallBack::query()->create($data)){
                return true;
            }
        }


    }
}
