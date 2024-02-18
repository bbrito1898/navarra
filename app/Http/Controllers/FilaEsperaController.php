<?php

namespace App\Http\Controllers;

use App\Models\filaEspera;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FilaEsperaController extends Controller
{
    public function statusok() {
        return response()->json(['message' => 'Status 200 OK'], 200);
    }

    public function contagem(){
        // OBTER OS DADOS DA API ATRAVEZ DA FUNÇÃO QUE PEDE OS DADOS A API, LEVA O PARAMETRO PARA DEVOLVER SIMPLESMENTE O ARRAY
        $objeto = $this->getDadosApi(1);

        //VERIFICA SE A VARIAVEL $OBJETO EXISTE
        if(!$objeto){
            return response()->json
            ([
                'error'=>'data not found'
            ]);
        }else{
            return count($objeto);
        }
        
    }

    public function listagemFiltrada(){
        // OBTER OS DADOS DA API ATRAVEZ DA FUNÇÃO QUE PEDE OS DADOS A API, LEVA O PARAMETRO PARA DEVOLVER SIMPLESMENTE O ARRAY
        $objecto = $this->getDadosApi(1);

        // MANIPULAÇÃO DOS DADOS PARA CRIAR UM NOVO CAMPO EM TODOS OS OBJETOS
        foreach ($objecto as $key=>$o){
            $objecto[$key]['previsao_consumo']=$o['quantidade']*5;
        }

        // ORDENAR O ARRAY USANDO UMA FUNÇÃO DE COMPARAÇÃO PERSONALIZADA
        usort($objecto, array($this, 'customSort'));

        return $objecto;

    }

    private function customSort($a, $b) {
        // DEFENIR A PERIORIDADE PARA A CONDIÇÃO DE PAGAMENTO
        $condicaoPrioridades = ["DIN" => 0, "30" => 1, "R60" => 2, "90" => 3, "120" => 4];

        // 50% DE IMPORTANCIA - ORDENAR PELA QUANTIDADE
        $compareQuantidade = $b["quantidade"] - $a["quantidade"];

        // OBTENÇÃO DA PRIORIDADE DA CONDIÇÃO DE PAGAMENTO
        $prioridadeA = isset($condicaoPrioridades[$a["condicao_pagamento"]]) ? $condicaoPrioridades[$a["condicao_pagamento"]] : PHP_INT_MAX;
        $prioridadeB = isset($condicaoPrioridades[$b["condicao_pagamento"]]) ? $condicaoPrioridades[$b["condicao_pagamento"]] : PHP_INT_MAX;

        // CALCULAR A COMPARAÇÃO COM BASE NA PRIORIDADE DA CONDIÇÃO DE PAGAMENTO
        $compareCondicaoPagamento = $prioridadeB - $prioridadeA;

        // 20% DE IMPORTANCIA - ORDENAR PELA DESIGNAÇÃO "PORT"
        $comparePais = ($a["pais"] == "PORT") ? -1 : (($b["pais"] == "PORT") ? 1 : 0);

        // COMBINAÇÃO DAS PRIORIDADES
        return $compareQuantidade * 0.5 + $compareCondicaoPagamento * 0.3 + $comparePais * 0.2;
    }

    // FUNÇÃO QUE VAI BUSCAR OS DADOS DA API
    public function getDadosApi($lindo=null){
        // URL DA API A SER CONSUMIDA
        $url = 'https://pastebin.pl/view/raw/8fced5f8';

        // CRIAÇÃO DE UMA INSTANCIA DO CLIENTE HTTP
        $client = new Client();


        try {
            // TENTATIVA DE LIGAÇÃO A API
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            
            // VERIFICA SE O PARAMETRO LINDO FOI RECEBIDO
            // ESTE PARAMETRO É UTILIZADO PARA DESTINGUIR QUANDO É QUE O PEDIDO É FEITO POR OUTR FUNÇÃO OU NÃO
            // SE FOR O CASO RETORNA SIMPLESMENTE O ARRAY PARA PODER SER TRABALHADO NOUTRO SITIO SENÃO RETORNA A VIEW ABAIXO COM OS DIFERENTES DADOS
            if($lindo){
                return $data;
            }else{
                $importante = $this->listagemFiltrada(1);
                $contagem = $this->contagem(1);
                $status = $this->statusok(1);

                $dados= [
                    'status' => $status,
                    'contagem' => $contagem,
                    'lista' => $data, 
                    'importante' => $importante
                ];
                
                return view('index', $dados);
            }
        }catch (\Exception $e) {
            // RESPOSTA NO CASO DE FALHAR A CONEXÃO A API
            return response()->json([
                'error' => 'Não foi poassivel conectar com API '
            ], 500);
        }
    }















    public function index(Request $req){
        $fila = new filaEspera();

        $fila->cesto=$req->cesto;
        $fila->pais=$req->pais;
        $fila->quantidade=$req->quantidade;
        $fila->condicao_pagamento=$req->condicao_pagamento;

        $data=$fila->save();
        if(!$data){
            return response()->json([
                'status'=>400,
                'error'=>'alguma coisa não funcionou corretamente'
            ]);
        }else{
            return  response()->json([
                'status'=>200,
                'message'=>'Dados salvos corretamente'
            ]);
        }
    }

    
    public function lista(){

        $listas =  filaEspera::all();

        if(isset($listas)){
            return response()->json
            ([
                'listas'=>$listas
            ]);
        }else{
            return response()->json
            ([
                'error'=>'data not found'
            ]);
        }
    }

}
