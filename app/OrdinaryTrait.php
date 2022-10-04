<?php

namespace App;

use App\Models\DownloadQuota;
use DB;

trait OrdinaryTrait
{
    public function crateDownloadQuota($user)
    {
        DownloadQuota::create([
            'user_id' => $user->id,
            'quota' => 50,
        ]);
    }


}