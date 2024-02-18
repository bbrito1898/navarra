<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $url = 'https://pastebin.pl/view/raw/8fced5f8';

        $client = new Client();

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            
            $lista = collect($data);
            $listaPaginada = collect($data)->paginate(10);

            return view('home', ['lista' => $listaPaginada]);

            return $data;
            // echo $data;
            // return response()->json(['data' => $data], 200);
        }catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi poassivel conectar com API '
            ], 500);
        }

        // return view('home');
    }
}
