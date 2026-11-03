<?php

namespace App\Http\Controllers;

//use App\Models\GameServer;
use App\Services\GameServer;
use Illuminate\Http\Request;

class GameServerController extends Controller
{
    protected GameServer $gameFunctions;

    public function __construct(GameServer $gameFunctions)
    {
        $this->gameActions = $gameFunctions;
    }

    public function index(Request $request)
    {
        $servers = session('mock_servers', $this->gameActions->gameList());

        return inertia('MainDashboard', [
            'servers' => $servers //GameServer::all() // Passes fresh database records to Vue
        ]);
    }

    public function start(Request $request, $id)
    {

        $servers = session('mock_servers', $this->gameActions->gameList());

        $updatedServers = $this->gameActions->startServer($servers, $id);

        session()->put('mock_servers', $updatedServers);

        return redirect()->back(); 
    }

    public function stop(Request $request, $id)
    {
        $servers = session('mock_servers', $this->gameActions->gameList());

        $updatedServers = $this->gameActions->stopServer($servers, $id);

        session()->put('mock_servers', $updatedServers);

        return redirect()->back();
    }

}
