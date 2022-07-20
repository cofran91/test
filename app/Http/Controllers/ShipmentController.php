<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list()
    {
        $shipments = Shipment::all();
        return view('list', compact('shipments'));
    } 

    public function status($id)
    {
        $shipment = Shipment::where('id', $id)->first();
        $dataSend[ 'idShipping' ] = $shipment->guide;
        $statu = $this->sendPetition('shippings/currentStatus', $dataSend)["messages"];

        return view('status', compact('shipment', 'statu'));
    } 

    public function send()
    {
        $cities = $this->sendPetition('cities')['data']->Ciudades;
        return view('send', compact('cities'));
    }

    public function shipment(Request $request)
    {
        $messages = [
            'peopleCity.required' => 'La ciudad es obligatoria',
            'peopleReceiver.required' => 'El nombre de quien recibe es obligatorio',
            'peopleIdentification.required' => 'La cedula es obligatoria',
            'peopleIdentification.numeric' => 'La cedula debe ser de tipo numerico',
            'peopleIdentification.min' => 'La cedula debe tener minimo 7 digitos',
            'peopleEmail.required' => 'El nombre de quien recibe es obligatorio',
            'peopleEmail.email' => 'El email debe ser un email',
            'peoplePhone.required' => 'El celular es obligatorio',
            'peoplePhone.numeric' => 'El celular es de tipo numerico',
            'peoplePhone.size' => 'El celular debe ser de 10 digitos',
            'declaredValue.required' => 'El valor declarado es obligatorio',
            'declaredValue.numeric' => 'El valor declarado es de tipo numerico',
            'amountToReceive.required' => 'El valor a recibir es obligatorio',
            'amountToReceive.numeric' => 'El valor a recibir es de tipo numerico',
            'address.required' => 'La dirección es obligatoria'
       ];

        $validate = Validator::make( $request->all(), [
            'peopleCity' => 'required',
            'peopleReceiver' => 'required',
            'peopleIdentification' => 'required|numeric|min:7',
            'peopleEmail' => 'required|email',
            'peoplePhone' => 'required|numeric|min:10',
            'declaredValue' => 'required|numeric',
            'amountToReceive' => 'required|numeric',
            'address' => 'required'
        ], $messages );

        if( $validate->fails() ){

            $errors = $validate->errors()->all();
                
            return redirect()->route( 'send' )
            ->withInput()
            ->withErrors( $errors );
        }

        try{
            foreach ($request->all() as $key => $value) {
                if (isset($value) && $key != "_token") {
                    $dataSend[ $key ] = $value;
                }
            }
            $dataSend['branch'] = 18;

            $shipment = $this->sendPetition('v2/shippings/new', $dataSend);

            if ($shipment["error"]) {
                $validate->errors()->add( 'Ocurrio un error', "Ocurrio un error. Intentelo mas tarde" );
                $errors = $validate->errors()->all();
                return redirect()->route( 'send' )
                ->withInput()
                ->withErrors( $errors );
            };

            $request['guide'] = $shipment['data']->Guia;
            
            DB::beginTransaction();
            $shipmentSave = new Shipment;

            if( $shipmentSave->create($request->all()) ){

                DB::commit();

                return redirect()->route( 'list' );
            }
            else{
                DB::rollback();

                $validate->errors()->add( 'Ocurrio un error', "Dato incorrecto" );
                $errors = $validate->errors()->all();

                return redirect()->route( 'send' )
                ->withInput()
                ->withErrors( $errors );
            }
        }
        catch( Throwable $e ){

            DB::rollback();

            $validate->errors()->add( 'Ocurrio un error', "Vuelve a intentarlo" );
            $errors = $validate->errors()->all();

            return redirect()->route( 'send' )
            ->withInput()
            ->withErrors( $errors );
        }
    }  

    public function sendPetition($endpoint, $data = '')
    {
        $url = 'https://sandbox.entregalo.co/api/'.$endpoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000); //timeout in seconds

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'token: DeTZn0S2y78PRlppnF0u48jl3viRUxul7dSsWA5WssexQykxq4s128r2jgqwKDO1SnZiQIpqrabHBiMM')
        );

        $response = curl_exec($ch);
        curl_close($ch);
        $arrRequests = explode("\r\n\r\n", $response);
        $body = end($arrRequests);
        $bodynew = json_decode($body);
        $array = (array) $bodynew;

        return $array;
    }  
}
