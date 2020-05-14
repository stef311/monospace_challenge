<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    //
    public function getSubscriptionsForUser($id){
        $subscriptions = DB::table('subscriptions')->where('user_id', $id)->get();

        return $subscriptions;
    }

    public function getAllSubscriptions(){
        $subscriptions = DB::table('subscriptions')->get();

        return $subscriptions;
    }
}
