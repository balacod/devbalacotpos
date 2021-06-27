<?php
namespace App\formatos;
// use FPDF;
use Codedge\Fpdf\Fpdf\Fpdf;
class HojaVida extends Fpdf{
   //Cabecera de página

   function Head($y,$datos){


      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+4);
      $this->setX($x+40);
      $this->SetFont('Arial','b',14);        
      $this->HCell(110,4,utf8_decode("AUTORIZACIÓN PARA PELUQUERIA Y/O BAÑO CANINO O FELINO (V2) "),0,0,'C');

      $this->Image('../public/logovet.jpg',165,$y-4,40,17,'jpg','');
      
      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+5);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $this->HCell(120,4,utf8_decode("Identificación del propietario:"),0,0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+1);
      $this->setX($x);
      $this->SetFont('Arial','B',10);        
      $this->HCell(97,6,utf8_decode("NOMBRE:"),1,0,'L');
      $this->HCell(98,6,utf8_decode("TELEFONO:"),1,0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y);
      $this->setX($x);
      $this->SetFont('Arial','B',10);        
      $this->HCell(97,6,utf8_decode("DIRECCIÓN:"),1,0,'L');
      $this->HCell(98,6,utf8_decode("BARRIO:"),1,0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y-11);
      $this->setX($x+18);
      $this->SetFont('Arial','',8);        
      $this->HCell(100,6,utf8_decode($datos->name.' '.$datos->first_name.' '.$datos->last_name),0,0,'L');
      $this->HCell(40,6,utf8_decode($datos->mobile),0,0,'C');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y);
      $this->setX($x+22);
      $this->SetFont('Arial','',8);        
      $this->HCell(95,6,utf8_decode($datos->city.' '.$datos->state.' '.$datos->zip_code),0,0,'L');
      $this->HCell(90,6,utf8_decode($datos->address_line_1.' '.$datos->address_line_2),0,0,'L');
      

      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+5);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $this->HCell(120,4,utf8_decode("Identificación de la mascota:"),0,0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+1);
      $this->setX($x);
      $this->SetFont('Arial','B',10);        
      $this->HCell(65,6,utf8_decode("NOMBRE:"),1,0,'L');
      $this->HCell(65,6,utf8_decode("ESPECIE:"),1,0,'L');
      $this->HCell(65,6,utf8_decode("RAZA:"),1,0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y);
      $this->setX($x);
      $this->SetFont('Arial','B',10);        
      $this->HCell(65,6,utf8_decode("SEXO:"),1,0,'L');
      $this->HCell(65,6,utf8_decode("EDAD:"),1,0,'L');
      $this->HCell(65,6,utf8_decode("COLOR:"),1,0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y-11);
      $this->setX($x+20);
      $this->SetFont('Arial','',8);        
      $this->HCell(40,6,utf8_decode($datos->nombre),0,0,'L');
      $this->HCell(65,6,utf8_decode($datos->especie),0,0,'C');
      $this->HCell(50,6,utf8_decode($datos->raza),0,0,'C');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y);
      $this->setX($x+20);
      $this->SetFont('Arial','',8);        
      $this->HCell(40,6,($datos->sexo == "H") ? utf8_decode('Hembra') : utf8_decode('Macho') ,0,0,'L');
      $this->HCell(70,6,utf8_decode($datos->edad),0,0,'C');
      $this->HCell(50,6,utf8_decode($datos->color),0,0,'C');

      $this->ln();
      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+1);
      $this->setX($x-1);
      $this->SetFont('Arial','B',10);        
      $this->HCell(23,5,utf8_decode("Tratamiento:"),0,0,'L');
      
      $this->SetFont('Arial','',10);
      if($datos->tratamiento == 1){
         $this->HCell(10,5,utf8_decode("SI"),1,0,'C');
      }else{
         $this->HCell(10,5,utf8_decode("NO"),1,0,'C');
      }

      $this->HCell(10,5,utf8_decode("Cual:"),0,0,'C');
      $this->HCell(55,5,utf8_decode($datos->nombre_tratamiento),'B',0,'L');

      $this->HCell(27,5,utf8_decode("Alérgico (a) a:"),0,0,'C');
      $this->HCell(30,5,utf8_decode($datos->alergico),'B',0,'L');

      $this->HCell(10,5,utf8_decode("Ojos:"),0,0,'C');
      $this->HCell(30,5,utf8_decode($datos->ojos),'B',0,'L');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+1);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $this->HCell(11,5,utf8_decode("Oídos:"),0,0,'L');
      $this->HCell(38,5,utf8_decode($datos->oidos),'B',0,'L');

      $this->HCell(9,5,utf8_decode("Piel:"),0,0,'L');
      $this->HCell(38,5,utf8_decode($datos->piel),'B',0,'L');

      $this->HCell(33,5,utf8_decode("Pulgas y/o Garrapatas:"),0,0,'L');
      $this->HCell(39,5,utf8_decode($datos->pulgas_garrapatas),'B',0,'L');

      $this->HCell(16,5,utf8_decode("Agresivo:"),0,0,'L');
      if($datos->agresivo == 1){
         $this->HCell(10,5,utf8_decode("SI"),1,0,'C');
      }else{
         $this->HCell(10,5,utf8_decode("NO"),1,0,'C');
      }

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+1);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $this->HCell(40,5,utf8_decode("Convive con más mascotas:"),0,0,'L');
      if($datos->sociable == 1){
         $this->HCell(10,5,utf8_decode("SI"),1,0,'C');
      }else{
         $this->HCell(10,5,utf8_decode("NO"),1,0,'C');
      } 

      $this->HCell(15,5,utf8_decode("Collar:"),0,0,'L');
      $this->HCell(70,5,utf8_decode($datos->nombre_collar),'B',0,'L');

      $this->HCell(25,5,utf8_decode("Desparasitado:"),0,0,'L');
      if($datos->desparasitado == 1){
         $this->HCell(10,5,utf8_decode("SI"),1,0,'C');
      }else{
         $this->HCell(10,5,utf8_decode("NO"),1,0,'C');
      }   

   }

   function Body($y,$consultas){

      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+5);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $this->HCell(50,4,utf8_decode("Estilo de Peluqueria y/o Baño:"),0,0,'L');

      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y);
      $this->setX($x-1);
      $this->SetFont('Arial','B',10);        
      $this->HCell(15,5,utf8_decode("HORA"),1,0,'C');
      $this->HCell(20,5,utf8_decode("FECHA"),1,0,'C');
      $this->HCell(101,5,utf8_decode("OBSERVACIONES DE SERVICIO"),1,0,'C');
      $this->HCell(20,5,utf8_decode("PESO"),1,0,'C');
      $this->HCell(40,5,utf8_decode("FIRMA INGRESO"),1,0,'C');

      $this->ln();

      foreach ($consultas as $ket => $consulta) {
      
         $y = $this->GetY();
         $x = $this->GetX();
         $this->setY($y);
         $this->setX($x-1);
         $this->SetFont('Arial','',10);        
         $this->HCell(15,20,$consulta->hora_entrada,1,0,'C');
         $this->HCell(20,20,$consulta->fecha_consulta,1,0,'C');
         $first400 = ""; $first401 = ""; $first402 = "";
         if(strlen($consulta->observaciones) <> 80){
            $first400 = substr($consulta->observaciones, 0, 80);
         }
         if(strlen($consulta->observaciones) <> 140){
            $first401 = substr($consulta->observaciones, 81, 160);
         }
         if(strlen($consulta->observaciones) <> 220){
            $first402 = substr($consulta->observaciones, 161, 240);
         }
         $texto = $first400." \n".$first401." \n".$first402;
         $this->HCell(101,20,utf8_decode($texto),1,0,'L');
         $this->HCell(20,20,$consulta->peso_mascota.' KG',1,0,'C');
         $this->HCell(40,20,'',1,0,'C');   
         $this->ln();      

      }
     
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+5);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $this->HCell(70,4,utf8_decode("Observacions Spa Canino Krizz y sus amigos:"),0,0,'L');

      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y);
      $this->setX($x-1);
      $this->SetFont('Arial','B',10);        
      $this->HCell(15,5,utf8_decode("HORA"),1,0,'C');
      $this->HCell(20,5,utf8_decode("FECHA"),1,0,'C');
      $this->HCell(121,5,utf8_decode("OBSERVACIONES DE SPA CANINO"),1,0,'C');
      $this->HCell(40,5,utf8_decode("FIRMA SALIDA"),1,0,'C');

      $this->ln();


      foreach ($consultas as $ket => $consulta) {
      
         $y = $this->GetY();
         $x = $this->GetX();
         $this->setY($y);
         $this->setX($x-1);
         $this->SetFont('Arial','',10);        
         $this->HCell(15,20,$consulta->hora_salida,1,0,'C');
         $this->HCell(20,20,$consulta->fecha_salida,1,0,'C');
         $first300 = ""; $first301 = ""; $first302 = "";
         if(strlen($consulta->observaciones_salida) <> 70){
            $first300 = substr($consulta->observaciones_salida, 0, 70);
         }
         if(strlen($consulta->observaciones_salida) <> 140){
            $first301 = substr($consulta->observaciones_salida, 71, 160);
         }
         if(strlen($consulta->observaciones_salida) <> 220){
            $first302 = substr($consulta->observaciones_salida, 161, 240);
         }
         $texto2 = $first300." \n".$first301." \n".$first302;
         $this->HCell(121,20,utf8_decode($texto2),1,0,'L');
         $this->HCell(40,20,'',1,0,'C');   
         $this->ln();      

      }
      

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+2);
      $this->setX($x+60);
      $this->SetFont('Arial','B',10);        
      $this->HCell(70,5,utf8_decode("INFORMACIÓN IMPORTANTE"),0,0,'C');

      $this->ln();

      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+7);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $txt = "1. Informamos que en nuestro SPA CANINO son utilizados implementos individuales y desinfectados, puesto que 
   nos interesa de sobre manera disminuir al máximo el riesgo implicado por enfermedades de piel. Además le 
   damos a su mascota “un trato con amor”. ";
      $this->HCell(180,4,utf8_decode($txt),0,0,'L');
      
      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+7);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $txt = "2.  Sabiendo que se trabaja con seres vivos los cuales algunas veces se comportan de una manera inadvertida,
   es posible que se presenten accidentes, en el corte de pelo o herida leve. En dado caso, prestaremos los 
   primeros auxilios o de ser necesario se correrá con los gastos médicos en la clínica veterinaria recomendada. ";
      $this->HCell(180,4,utf8_decode($txt),0,0,'L');


      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+5);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $txt = "3.  Factores de riesgo: EDAD, CARDIOPATÍAS DE BASE, SOBREPESO, HIPERTENSIÓN, HIPOTIROIDISMO, 
   CUAGULOPATÍAS, AGRESIVIDAD, TRATAMIENTOS, INFESTACIONES Y ALERGÍAS.  ";
      $this->HCell(180,4,utf8_decode($txt),0,0,'L');

      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+7);
      $this->setX($x-1);
      $this->SetFont('Arial','',10);        
      $txt = "4.  No se coloca ningún tipo de anestésicos.
   Informando los riesgos ya mencionados así los costos que significan dicha acción, autorizo para que realicen 
   la peluquería y/o baño a mi mascota en la forma señalada, en este mismo acto declaro que si la institución
    cumple lo planteado, no publicaré ni tomaré acciones legales contra la institución ni sus personas.  ";
      $this->HCell(180,4,utf8_decode($txt),0,0,'L');

      $this->ln();
      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+20);
      $this->setX($x+65);
      $this->SetFont('Arial','',10);      
      $this->HCell(70,5,utf8_decode('FIRMA DEL PROPIETARIO O PERSONA ENCARGADA'),'T',0,'C');


   }

}