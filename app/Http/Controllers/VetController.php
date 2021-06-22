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
use App\Consulta;
use App\formatos\HojaVida;
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
        
        if($input['idmas'] != null){
            $id = $input['idmas'];
            $mascota = Mascota::where('id',$id)->first();
            $dataMascota = array(
                'cliente_id' => $input['idcliente'],
                'nombre' => $input['nombre'],
                'especie' => $input['especie'],
                'raza' => $input['raza'],
                'edad' => $input['edad'],
                'color' => $input['color'],
                'sexo' => $input['sexo'],
                'tratamiento' => (isset($input['tratamiento'])) ? 1:0,
                'nombre_tratamiento' => (isset($input['tratamiento'])) ? $input['nombre_tratamiento'] : '',
                'alergico' => $input['alergico'],
                'ojos' => $input['ojos'],
                'oidos' => $input['oidos'],
                'piel' => $input['piel'],
                'pulgas_garrapatas' => $input['pulgas_garrapatas'],
                'agresivo' => (isset($input['agresivo'])) ? 1 : 0,
                'sociable' => (isset($input['sociable'])) ? 1 : 0,
                'nombre_collar' => $input['collar_nombre'],
                'desparasitado' =>(isset($input['desparacitado'])) ? 1 : 0,
                'created_at' => date('Y-m-d h:m:s'),
                'updated_at' => date('Y-m-d h:m:s'),
            );
            
            $result = $mascota->update($dataMascota);
        }else{
            $dataMascota = array(
                'cliente_id' => $input['idcliente'],
                'nombre' => $input['nombre'],
                'especie' => $input['especie'],
                'raza' => $input['raza'],
                'edad' => $input['edad'],
                'color' => $input['color'],
                'sexo' => $input['sexo'],
                'tratamiento' => (isset($input['tratamiento'])) ? 1:0,
                'nombre_tratamiento' => (isset($input['tratamiento'])) ? $input['nombre_tratamiento'] : '',
                'alergico' => $input['alergico'],
                'ojos' => $input['ojos'],
                'oidos' => $input['oidos'],
                'piel' => $input['piel'],
                'pulgas_garrapatas' => $input['pulgas_garrapatas'],
                'agresivo' => (isset($input['agresivo'])) ? 1 : 0,
                'sociable' => (isset($input['sociable'])) ? 1 : 0,
                'nombre_collar' => $input['collar_nombre'],
                'desparasitado' =>(isset($input['desparacitado'])) ? 1 : 0,
                'updated_at' => date('Y-m-d h:m:s'),
            );
            $result = Mascota::create($dataMascota);  
        }        
        
        if ($result) {
            $flag = true;
        }        
        $output = ['flag' => $flag];
        return $output;
    }
    public function show(Request $request){

        $input = $request->all();
        $flag = false;
        $mascota = Mascota::findOrFail($input['id']);
        if (!empty($mascota)) {
            $flag = true;
        }
        $output = ['mascota' => $mascota, 'flag' => $flag];
        return $output;
    }
    public function lista(Request $request){

        $input = $request->all();
        $lista = Mascota::where('cliente_id',$input['id'])->where('status',1)->get();
        $output = ['datos' => $lista];
        return $output;

    }
    public function consultas($id){
        
        $mascota = Mascota::find($id);
        return view('vet.consultas')->with(compact('mascota'));

    }
    public function listaConsultas(Request $request){
        $input = $request->all();
        $lista = Consulta::where('mascota_id',$input['id'])->get();
        $output = ['datos' => $lista];
        return $output;

    }
    public function consulta(Request $request){

        $input = $request->all();
        $flag = false;
        $consulta = new  Consulta();
        $consulta->cliente_id = $input['cliente_id'];
        $consulta->mascota_id = $input['mascota_id'];
        $consulta->fecha_consulta = $input['fecha_consulta'];
        $consulta->titulo_consulta = $input['titulo_consulta'];
        $consulta->peso_mascota = $input['peso_consulta'];
        $consulta->observaciones = $input['observaciones'];
        $result = $consulta->save();
        if ($result) {
            $flag = true;
        }        
        $output = ['flag' => $flag];
        return $output;
    }

    public function hojavida($id){
        
        // dd($id);
        $this->pdf = new HojaVida('P','mm','Legal');
        $this->pdf->SetFont('Arial','B',12);        
        $this->pdf->AddPage();
        $this->pdf->Head(0,$data);
        $this->pdf->Body(50,$detalles);
        $this->pdf->Footer();
        $this->pdf->Output();
        exit;

    }
}