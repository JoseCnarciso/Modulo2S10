<?php

namespace App\Http\Controllers;

use App\Mail\SendAwardEmailToClient;
use App\Models\Award;
use App\Models\Client;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AwardController extends Controller
{
    public function getAwards(){
        $date_award =(new DateTime('now'))->format('Y-m-d H:i');

        $awards = Award::query()
        ->where('date_award', '>=', $date_award)
        ->inRandomOrder()
        ->first();

        foreach($awards as $award){
            $clients = Client::query()->take(3)->inRandomOrder()->get();

            foreach($clients as $client){
                Mail::to($client->email,$client->name)
                ->send(new SendAwardEmailToClient($client));
            }
        }

        return $clients;

    }
}
