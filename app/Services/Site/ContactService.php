<?php

namespace App\Services\Site;

use App\Models\Banner;
use App\Models\Contact;
use App\Models\About;

class ContactService
{
    public function getALlPagedata()
    {
        $data['contacts'] = Contact::query()->get();
        $data['blogs']= About::query()->orderBy('page_type', 'ASC')->where('page_type', '!=', 6)->where('page_type', '!=', 5)->get();
        $data['sales'] = About::where('page_type', 1)->first();
        $data['advertising_banner'] = Banner::first();
        $data['blog_info'] = About::where('page_type', 5)->first();
        return $data;

    }
}
?>
