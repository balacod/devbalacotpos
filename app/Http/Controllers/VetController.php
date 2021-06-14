<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessLocation;
use App\Contact;
use App\CustomerGroup;
use App\Notifications\CustomerNotification;
use App\PurchaseLine;
use App\Transaction;
use App\User;
use App\Mascota;
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use App\Utils\NotificationUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use DB;
use Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\TransactionPayment;
use Spatie\Activitylog\Models\Activity;

class VetController extends Controller{

    protected $commonUtil;
    protected $contactUtil;
    protected $transactionUtil;
    protected $moduleUtil;
    protected $notificationUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(
        Util $commonUtil,
        ModuleUtil $moduleUtil,
        TransactionUtil $transactionUtil,
        NotificationUtil $notificationUtil,
        ContactUtil $contactUtil
    ) {
        $this->commonUtil = $commonUtil;
        $this->contactUtil = $contactUtil;
        $this->moduleUtil = $moduleUtil;
        $this->transactionUtil = $transactionUtil;
        $this->notificationUtil = $notificationUtil;
    }
    public function index(){

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $input = $request->all();
        $flag = false;
        $mascota = new  Mascota();
        $mascota->cliente_id = $input['idcliente'];
        $mascota->nombre = $input['nombre'];
        $mascota->especie = $input['especie'];
        $mascota->raza = $input['raza'];
        $mascota->edad = $input['edad'];
        $mascota->color = $input['color'];
        $mascota->sexo = $input['sexo'];
        $mascota->tratamiento = (isset($input['tratamiento'])) ? 1:0;
        $mascota->nombre_tratamiento = (isset($input['tratamiento'])) ? $input['nombre_tratamiento'] : '';
        $mascota->alergico = $input['alergico'];
        $mascota->ojos = $input['ojos'];
        $mascota->oidos = $input['oidos'];
        $mascota->piel = $input['piel'];
        $mascota->pulgas_garrapatas = $input['pulgas_garrapatas'];
        $mascota->agresivo = (isset($input['agresivo'])) ? 1 : 0;
        $mascota->sociable = (isset($input['sociable'])) ? 1 : 0;
        $mascota->nombre_collar = $input['collar_nombre'];
        $mascota->desparasitado =(isset($input['desparacitado'])) ? 1 : 0;
        $mascota->status = 1;
        $mascota->created_at = date('Y-m-d h:m:s');
        $result  = $mascota->save();
        if ($result) {
            $flag = true;
        }        
        $output = ['flag' => $flag];
        return $output;
    }
    public function lista(Request $request){

        $input = $request->all();
        $lista = Mascota::where('cliente_id',$input['id'])->where('status',1)->get();
        $output = ['datos' => $lista];
        return $output;

    }
}