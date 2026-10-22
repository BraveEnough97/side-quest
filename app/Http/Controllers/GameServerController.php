<?php

namespace App\Http\Controllers;

//use App\Models\GameServer;
use Illuminate\Http\Request;

class GameServerController extends Controller
{
    // Hard code values for now
    private array $defaultServers = [
        ['id' => 1, 'name' => 'Main CS2 Server', 'game' => 'Counter-Strike 2', 'ip' => '192.168.1.50:27015', 'status' => 'running', 'players' => '12/16'],
        ['id' => 2, 'name' => 'Valheim Casual Cluster', 'game' => 'Valheim', 'ip' => '192.168.1.51:2456', 'status' => 'stopped', 'players' => '0/10'],
        ['id' => 3, 'name' => 'Minecraft Survival', 'game' => 'Minecraft', 'ip' => '192.168.1.52:25565', 'status' => 'running', 'players' => '5/20'],
    ];     

    public function index(Request $request)
    {
        $servers = session('mock_servers', $this->defaultServers);

        return inertia('MainDashboard', [
            'servers' => $servers //GameServer::all() // Passes fresh database records to Vue
        ]);
    }

    public function start(Request $request, $id)
    {
        $servers = session('mock_servers', $this->defaultServers);

        $servers = collect($servers)->map(function ($server) use ($id) {
            if ($server['id'] == $id) {
                $server['status'] = 'running';
                $server['players'] = '1/16';
            }
            return $server;
        })->all();

        $request->session()->put('mock_servers', $servers);

        return redirect()->back(); 
    }

    public function stop(Request $request, $id)
    {
        $servers = session('mock_servers', $this->defaultServers);

        $servers = collect($servers)->map(function ($server) use ($id) {
            if ($server['id'] == $id) {
                $server['status'] = 'stopped';
                $server['players'] = '0/16';
            }
            return $server;
        })->all();

        $request->session()->put('mock_servers', $servers);

        return redirect()->back();
    }

}
