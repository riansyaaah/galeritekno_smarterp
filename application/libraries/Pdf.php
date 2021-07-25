<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
  function __construct()
  {
    parent::__construct();
    $this->Periode = false;
    $this->NamaPerusahaan = false;
    $this->Kop = false;
    $this->JudulReprot = false;
  }

  //Page header
  public function Header()
  {
    // Logo
    //$image_file = K_PATH_IMAGES.'logo_example.jpg';
    //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->Write(0, $this->Kop, '', 0, 'C', true, 0, true, false, 0);
    $this->SetFont('dejavusans', 'B', 8);
    $this->Write(0, $this->NamaPerusahaan, '', 0, 'C', true, 0, false, false, 0);
    $this->SetFont('dejavusans', 'B', 15);
    $this->Write(0, $this->JudulReprot, '', 0, 'C', true, 0, false, false, 0);
    $this->SetFont('dejavusans', 'B', 8);
    $this->Write(0, $this->Periode, '', 0, 'C', true, 0, false, false, 0);
    $this->SetFont('dejavusans', 'B', 8);

    $this->SetFont('helvetica', 'R', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    //$this->Cell(0, 20, 'PT ARUNDAYA TEKNOLOGI', 0, false, 'C', 0, '', 0, false, 'M', 'M');
  }

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'R', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}
