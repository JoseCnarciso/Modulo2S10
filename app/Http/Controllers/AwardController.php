<?php

namespace App\Http\Controllers;

use App\Mail\SendAwardEmailToClient;
use App\Models\Award;
use App\Models\Client;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AwardController extends Controller
{
    public function getAwards()
    {

        try {
            $date_award = (new DateTime('now'))->format('Y-m-d H:i');

            $awards = Award::query()
                ->where('date_award', '>=', $date_award)
                ->inRandomOrder()
                ->first();

            foreach ($awards as $award) {
                $clients = Client::query()->take(3)->inRandomOrder()->get();

                foreach ($clients as $client) {
                    Mail::to($client->email, $client->name)
                        ->send(new SendAwardEmailToClient($client));
                }
            }
            return $clients;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function index()
    {
        try {
            $awards = Award::all();

            return $awards;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
