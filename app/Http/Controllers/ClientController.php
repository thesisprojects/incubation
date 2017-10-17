<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ClientController extends Controller
{
    public function getClients()
    {
        $clients = Client::paginate(10);
        return view("pages.clients.index")->with([
            'clients' => $clients
        ]);
    }

    public function getCreate()
    {
        return view('pages.clients.create');
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'address' => 'required',
            ]);
            $data = $request->all();
            $data['id'] = Uuid::uuid1();
            $client = new Client($data);
            $client->save();
            return back()->with('status', 'Client created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getEdit($id)
    {
        $client = Client::find($id);
        return view('pages.clients.edit')->with('client', $client);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'address' => 'required',
            ]);
            $data = $request->all();
            $id = $data['id'];
            $client = Client::find($id);
            $client->name = $data['name'];
            $client->address = $data['address'];
            $client->save();
            return back()->with('status', 'Client updated.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
