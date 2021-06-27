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
use App\formatos\HojaVidaMascota;
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
use App\Utils\ProductUtil;

class VetController extends Controller{

    protected $commonUtil;
    protected $contactUtil;
    protected $transactionUtil;
    protected $moduleUtil;
    protected $notificationUtil;
    protected $productUtil;
    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(
        ProductUtil $productUtil,
        Util $commonUtil,
        ModuleUtil $moduleUtil,
        TransactionUtil $transactionUtil,
        NotificationUtil $notificationUtil,
        ContactUtil $contactUtil
    ) {
        $this->productUtil = $productUtil;

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
    public function alta(Request $request){

        $input = $request->all();
        $flag = false;
        $consulta = Consulta::where('id',$input['idConsulta'])->first();
        
        $dataAlta = array(
            'observaciones_salida' => $input['observaciones_alta'],
            'fecha_salida' => $input['fecha_alta'],
            'hora_salida' => $input['hora_alta'],
            'status_consulta' => 2,
            // 'fecha_salida' => date('Y-m-d'),
        );
        
        $result = $consulta->update($dataAlta);
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
        $lista = Consulta::where('mascota_id',$input['id'])->where('status_consulta',1)->get();
        $output = ['datos' => $lista];
        return $output;

    }
    public function listaConsultasAlta(Request $request){
        $input = $request->all();
        $lista = Consulta::where('mascota_id',$input['id'])->where('status_consulta',2)->get();
        $output = ['datos' => $lista];
        return $output;
    }
    public function consulta(Request $request){

        $input = $request->all();
        $file_name = null;

        if(isset($_FILES['archivo'])){
            $file = $input['archivo'];
            if ($file->getSize() <= config('constants.document_size_limit')) {
                $new_file_name = time() . '_' . mt_rand() . '_' . $file->getClientOriginalName();
                if ($file->storeAs('/vet', $new_file_name)) {
                    $file_name = $new_file_name;
                }
            }
        }
        
        $input['archivo'] = ($file_name != null) ? $filename : ''; 

        $flag = false;
        $consulta = new  Consulta();
        $consulta->cliente_id = $input['cliente_id'];
        $consulta->mascota_id = $input['mascota_id'];
        $consulta->hora_entrada = $input['hora'];
        $consulta->fecha_consulta = $input['fecha_consulta'];
        $consulta->titulo_consulta = $input['titulo_consulta'];
        $consulta->peso_mascota = $input['peso_consulta'];
        $consulta->observaciones = $input['observaciones'];
        $consulta->archivo_adjunto = $input['archivo'];
        $result = $consulta->save();
        if ($result) {
            $flag = true;
        }        
        $output = ['flag' => $flag];
        return $output;
    }

    public function hojavida($id){

        $datos = DB::table('mascota AS m')->select("c.name", "c.first_name", "c.last_name", "c.mobile", "c.address_line_1", "c.address_line_2", "c.city", "c.state",  "c.zip_code", "m.*")
                    ->join('contacts as c', 'c.id','=','m.cliente_id')
                    ->join('business AS b', 'b.id','=','c.business_id')
                    ->where('m.id',$id)
                    ->get();        
        $consulta = DB::table('mascota AS m')->select("c.*")
                    ->join('mascota_consulta AS c', 'c.mascota_id','=','m.id')
                    ->where('m.id',$id)
                    ->get();

        $this->pdf = new HojaVidaMascota('P','mm','Legal');
        $this->pdf->SetFont('Arial','B',12);        
        $this->pdf->AddPage();
        $this->pdf->Head(0,$datos[0]);
        $this->pdf->Body(50,$consulta);
        $this->pdf->Footer();
        $this->pdf->Output();
        exit;

    }
    public function hojaconsulta($consulta_di){

        $datos = DB::table('mascota AS m')->select("c.name", "c.first_name", "c.last_name", "c.mobile", "c.address_line_1", "c.address_line_2", "c.city", "c.state",  "c.zip_code", "m.*")
                    ->join('contacts as c', 'c.id','=','m.cliente_id')
                    ->join('business AS b', 'b.id','=','c.business_id')
                    ->join('mascota_consulta AS mc', 'mc.mascota_id','=','m.id')
                    ->where('mc.id',$consulta_di)
                    ->get();        
        $consulta = DB::table('mascota AS m')->select("c.*")
                    ->join('mascota_consulta AS c', 'c.mascota_id','=','m.id')
                    ->where('c.id',$consulta_di)
                    ->get();

        $this->pdf = new HojaVida('P','mm','Legal');
        $this->pdf->SetFont('Arial','B',12);        
        $this->pdf->AddPage();
        $this->pdf->Head(0,$datos[0]);
        $this->pdf->Body(50,$consulta);
        $this->pdf->Footer();
        $this->pdf->Output();
        exit;
    }
}