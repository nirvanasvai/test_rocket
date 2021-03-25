<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Contact;
use App\Models\Social;
use App\Models\About;
use Illuminate\Http\Request;

class InfoShowController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index',
            [
                'contact'=>Contact::query()->get(),
                'socials'=>Social::query()->get(),
                'meta' =>About::where('page_type', 5)->first(),
            ]);
    }
}
