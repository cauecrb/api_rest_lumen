<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\service_orders;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
class service_ordersController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * função que reotrna a paginaçao de 5 elementos da tabela de service_orders
     */
    public function list(){
        $data = service_orders::paginate(5);
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * cria uma nova service order cadastrando um novo user e retorna o id do novo user guardando no service_order
     */
    public function createUser(request $request){
        $serviceorders = new service_orders();

        $serviceorders->id = $request->id;
        $serviceorders->vehiclePlate = $request->vehiclePlate;
        $serviceorders->entryDateTime = $request->entryDateTime;
        $serviceorders->exitDateTime = $request->exitDateTime;
        $serviceorders->priceType = $request->priceType;
        $serviceorders->price = $request->price;
        $userId = (new usersController())->create($request->userId);
        $serviceorders->userId = $userId->original;
        //return $serviceorders;

        /**
         *  verificação se é uma data valida, caso nao retorna uma mensagem de erro
         */
        if (!date_create_from_format('Y-m-d H:i', $serviceorders->entryDateTime)){
            return response()->json('a data de entrada deve ser informada no formato "AAAA-mm-dd HH:ii"');
        }

        if ($serviceorders->exitDateTime == ""){
            $serviceorders->exitDateTime = "0001-01-01 00:00";
        }

        if (!date_create_from_format('Y-m-d H:i', $serviceorders->exitDateTime)){
            return response()->json('a data de saída deve ser informada no formato "AAAA-mm-dd HH:ii"');
        }

        if ($serviceorders->price == ""){
            $serviceorders->price = '0.00';
        }

        if ( $serviceorders->vehiclePlate == ""){
            return response()->json('a placa não pode estar em branco!');
        }

        if ( $serviceorders->userId == ""){
            return response()->json('o usuario não pode estar em branco!');
        }

        $serviceorders->save();

        return response()->json('ordem de serviço criada com sucesso!');
   }

    /**
     * @param $vehiclePlate
     * @return \Illuminate\Http\JsonResponse
     * retorna os dados da service_orders pela placa
     */
    public function show($vehiclePlate){
        $serviceorders = service_orders::where('vehiclePlate',$vehiclePlate)->first();
        return response()->json($serviceorders);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * cadastra uma nova requisição
     */
    public function new(request $request){
        $serviceorders = new service_orders();

        $serviceorders->id = $request->id;
        $serviceorders->vehiclePlate = $request->vehiclePlate;
        $serviceorders->entryDateTime = $request->entryDateTime;
        $serviceorders->exitDateTime = $request->exitDateTime;
        $serviceorders->priceType = $request->priceType;
        $serviceorders->price = $request->price;
        $serviceorders->userId = $request->userId;

        if (!date_create_from_format('Y-m-d H:i', $serviceorders->entryDateTime)){
            return response()->json('a data de entrada deve ser informada no formato "AAAA-mm-dd HH:ii"');
        }

        if ($serviceorders->exitDateTime == ""){
            $serviceorders->exitDateTime = "0001-01-01 00:00";
        }

        if (!date_create_from_format('Y-m-d H:i', $serviceorders->exitDateTime)){
            return response()->json('a data de saída deve ser informada no formato "AAAA-mm-dd HH:ii"');
        }

        if ($serviceorders->price == ""){
            $serviceorders->price = '0.00';
        }

        if ( $serviceorders->vehiclePlate == ""){
            return response()->json('a placa não pode estar em branco!');
        }

        if ( $serviceorders->userId == ""){
            return response()->json('o usuario não pode estar em branco!');
        }

        $serviceorders->save();

        return response()->json('ordem de serviço criada com sucesso!');
    }

/**    public function dataValidation ($serviceorders){

        if (!date_create_from_format('Y-m-d H:i', $serviceorders->entryDateTime)){
            return response()->json('a data de entrada deve ser informada no formato "AAAA-mm-dd HH:ii"');
        }

        if ($serviceorders->exitDateTime == ""){
            $serviceorders->exitDateTime = "0001-01-01 00:00";
        }

        if (!date_create_from_format('Y-m-d H:i', $serviceorders->exitDateTime)){
            return response()->json('a data de saída deve ser informada no formato "AAAA-mm-dd HH:ii"');
        }

        if ($serviceorders->price == ""){
            $serviceorders->price = '0.00';
        }

        if ( $serviceorders->vehiclePlate == ""){
            return response()->json('a placa não pode estar em branco!');
        }

        if ( $serviceorders->useId == ""){
            return response()->json('o usuario não pode estar em branco!');
        }

        return response()->json($serviceorders);

    } */

    /**
     * @return \Illuminate\Http\JsonResponse
     * encontra e substitui o userId pelo nome correspondente
     */
    public function userIdToName(){

        $list = (new service_ordersController())->list();
        $listArray = array();
        $listArray = json_decode($list->content(), true);
        $ind = 0;

        /**
         * adicionando no array cada elemento com o nome do auserID
         */
        foreach ($listArray['data'] as $element) {

            $userName = (new usersController())->show($element['userId']);
            $userName = $userName->original->name;

            $serviceorders[$ind]['id'] = $element['id'];
            $serviceorders[$ind]['vehiclePlate'] = $element['vehiclePlate'];;
            $serviceorders[$ind]['entryDateTime'] = $element['entryDateTime'];
            $serviceorders[$ind]['exitDateTime'] = $element['exitDateTime'];
            $serviceorders[$ind]['priceType'] = $element['priceType'];
            $serviceorders[$ind]['price'] = $element['price'];
            $serviceorders[$ind]['userName'] = $userName;
            $ind++;
        }

        return response()->json($serviceorders);
    }

/**    public function delete($id){
        $serviceorders = service_orders::find($id);
        $serviceorders->delete();

        return response()->json('usuario deletado com sucesso!');
    }  */
}
