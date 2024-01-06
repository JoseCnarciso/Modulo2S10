<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    use HttpResponses;

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|required',
                'email' => 'email|required|unique:clients',
                'date_birth' => 'date_format:Y-m-d|required',
                'cpf' => 'string|required|unique:clients',
                'address' => 'string|required'
            ]);

            $client = Client::create($data);

            return $client;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function index(Request $request){
        try {
            $params = $request->query();

            $clients = Client::query();

            if ($request->has('name') && !empty($params['name'])) {
                $clients->where('name', 'ilike', '%' . $params['name'] . '%');
            }
            if ($request->has('cpf') && !empty($params['cpf'])) {
                $clients->where('cpf', 'ilike', '%' . $params['cpf'] . '%');
            }
            if ($request->has('date_birth') && !empty($params['date_birth'])) {
                $clients->where('date_birth', 'ilike', '%' . $params['date_birth'] . '%');
            }

            $result = $clients->get();

            return $result;

        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    public function update($id, Request $request)
    {
        try {
            $client = Client::find($id);

            if (!$client) {
                return $this->error('Cliente não encontrado', Response::HTTP_NOT_FOUND);
            }

            $request->validate([
                'name' => 'string|required',
                'email' => 'email|required|unique:clients,email,' . $id,
                'date_birth' => 'date_format:Y-m-d|required',
                'cpf' => 'string|required|unique:clients,cpf,' . $id,
                'address' => 'string|required',
            ]);

            $data = $request->only(['name', 'email', 'date_birth', 'cpf', 'address']);

            $client->update($data);

            return $this->response('Cliente atualizado com sucesso', Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy($id){

        $client = Client::find($id);

        if (!$client) return $this->error('ID não encontrado', Response::HTTP_NOT_FOUND);

        $client->delete();

        return $this->response('', Response::HTTP_NO_CONTENT);

    }
}
