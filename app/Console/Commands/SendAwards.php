<?php

namespace App\Console\Commands;

use App\Mail\SendAwardEmailToClient;
use App\Models\Award;
use App\Models\Client;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class SendAwards extends Command
{
    protected $signature = 'app:send-awards';


    protected $description = 'Envia email de prêmios para clientes';


    public function handle()
    {
        try {

            $currentDateTime = now()->format('Y-m-d H:i');

            $nearestAward = Award::query()

                // EXTRACT(EPOCH FROM ...): Esta parte extrai a parte de época (timestamp) de uma expressão temporal.
                // Busca o sorteio mais próximo da data atual.
                ->orderByRaw("ABS(EXTRACT(EPOCH FROM (date_award - '$currentDateTime'::timestamp)))")
                ->first();

            if ($nearestAward) {

                $clients = Client::query()->take($nearestAward->amount)->inRandomOrder()->take(2)->get();

                foreach ($clients as $client) {
                    Mail::to($client->email, $client->name)
                        ->send(new SendAwardEmailToClient($client, $nearestAward, 'email'));
                }
            }
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
