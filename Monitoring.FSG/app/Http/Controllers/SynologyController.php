<?php
/*
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SynologyController extends Controller
{
    private function loginSynology($nas_ip, $user, $password)
    {
        $client = new Client();
        $response = $client->get("http://$nas_ip:5000/webapi/auth.cgi", [
            'query' => [
                'api' => 'SYNO.API.Auth',
                'version' => '6',
                'method' => 'login',
                'account' => $user,
                'passwd' => $password,
                'session' => 'Core',
                'format' => 'sid'
            ],
            'verify' => false,
        ]);
        
        $data = json_decode($response->getBody(), true);
        return $data['data']['sid'] ?? null;
    }

    private function getStatus($nas_ip, $sid)
    {
        $client = new Client();
        $response = $client->get("http://$nas_ip:5000/webapi/entry.cgi", [
            'query' => [
                'api' => 'SYNO.Core.System.Utilization',
                'version' => '1',
                'method' => 'get',
                '_sid' => $sid
            ],
            'verify' => false,
        ]);
        
        return json_decode($response->getBody(), true)['data'] ?? null;
    }

    public function index(Request $request)
    {
        $nas_list = $request->input('nas_list', []);

        $results = [];
        foreach ($nas_list as $nas) {
            try {
                $sid = $this->loginSynology($nas['ip'], $nas['user'], $nas['password']);
                $data = $this->getStatus($nas['ip'], $sid);
                $results[] = ['ip' => $nas['ip'], 'data' => $data];
            } catch (\Exception $e) {
                $results[] = ['ip' => $nas['ip'], 'error' => $e->getMessage()];
            }
        }
       return response()->json($results);
    }
} 
    */
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use GuzzleHttp\Client;
    class SynologyController extends Controller
{
    private function loginSynology($nas_ip, $user, $password)
    {
        $client = new Client();
        $response = $client->get("http://$nas_ip:5000/webapi/auth.cgi", [
            'query' => [
                'api' => 'SYNO.API.Auth',
                'version' => '6',
                'method' => 'login',
                'account' => $user,
                'passwd' => $password,
                'session' => 'Core',
                'format' => 'sid'
            ],
            'verify' => false,
        ]);
        
        $data = json_decode($response->getBody(), true);
        return $data['data']['sid'] ?? null;
    }

    private function getStorageInfo($nas_ip, $sid)
    {
        $client = new Client();
        $response = $client->get("http://$nas_ip:5000/webapi/entry.cgi", [
            'query' => [
                'api' => 'SYNO.Storage.CGI',
                'version' => '1',
                'method' => 'getInfo',
                '_sid' => $sid
            ],
            'verify' => false,
        ]);
        
        return json_decode($response->getBody(), true)['data'] ?? null;
    }
    private function getStatus($nas_ip, $sid)
    {
        $client = new Client();
        $response = $client->get("http://$nas_ip:5000/webapi/entry.cgi", [
            'query' => [
                'api' => 'SYNO.Core.System.Utilization',
                'version' => '1',
                'method' => 'get',
                '_sid' => $sid
            ],
            'verify' => false,
        ]);
        
        return json_decode($response->getBody(), true)['data'] ?? null;
    }
    
    public function index(Request $request)
    {
        $nas_list = $request->input('nas_list', []);

        $results = [];
        foreach ($nas_list as $nas) {
            try {
                $sid = $this->loginSynology($nas['ip'], $nas['user'], $nas['password']);
                $data = $this->getStorageInfo($nas['ip'], $sid);
                $results[] = ['ip' => $nas['ip'], 'data' => $data];
            } catch (\Exception $e) {
                $results[] = ['ip' => $nas['ip'], 'error' => $e->getMessage()];
            }
        }
       return response()->json($results);
    }
} 