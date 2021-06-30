<?php
namespace App\formatos;
use FPDF;
class HojaVida extends FPDF{
   //Cabecera de página

   function Head($y){


      $y = $this->GetY();
      $x = $this->GetX();
      $this->setY($y+20);
      $this->setX($x+10);
      $this->SetFont('Arial','',12);        
      $this->HCell(15,5,utf8_decode("Hola mundo"),0,0,'C');
      

   }

   function Body($y){




   }

}