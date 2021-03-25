<?php

namespace App\Services\Admin;

use App\Models\CallBack;

class AdminService
{
    public function getALlPagedata()
    {
        $data['callback'] = CallBack::query()->get();

        return $data;

    }
}
?>
