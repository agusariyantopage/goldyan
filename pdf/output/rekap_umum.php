<?php
session_start();
include '../../koneksi.php';
$tanggal_awal=$_GET['awal'];
$tanggal_akhir=$_GET['akhir'];

//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        //$this->Cell(0, 10, '-- Dicetak Pada : '.date('Y-m-d H:i:s').' -- Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $fhtml = '
            <table class="tblFooter" cellpadding="5">
                <tr>
                    <td>
                    Dicetak Pada : '.date('d-m-Y H:i:s').'
                    </td>
                    <td align="right">
                    Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'
                    </td>                    
                </tr>
            </table>
          ';
          
          $this->writeHTML($fhtml, true, false, true, false, '');
    }
}
// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Ariyanto');
$pdf->SetTitle('Rekapitulasi Umum');
$pdf->SetSubject('Rekapitulasi Umum');
$pdf->SetKeywords('Rekapitulasi Umum');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page

$pdf->AddPage();


// create some HTML content
$html = '<p style="text-align: center;"><strong>Rekapitulasi Transaksi</strong></p>
<table style="width:100%;">    
    <tr>
        <td>Tanggal Awal</td>
        <td>: '.$tanggal_awal.' </td>
        <td>Tanggal Akhir</td>
        <td>: '.$tanggal_akhir.'</td>
    </tr>
</table>
<br>    
<table style=" border-collapse: collapse;" border="1">

    <tr>      
    <th align="center" style="width:5%;">#</th>
    <th align="center" style="width:15%;">Waktu Transaksi</th>
    <th align="center" style="width:23%;">Mitra</th>
    <th align="center" style="width:17%;">Area</th>
    <th align="center" style="width:15%;">Metode Bayar</th>
    <th align="center" style="width:15%;">Jumlah</th>
    <th align="center" style="width:15%;">Subtotal</th>
    </tr>

<tbody>';

$sql="select jadwal.*,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status!='Pending' and (tanggal BETWEEN '$tanggal_awal' and '$tanggal_akhir') order by diubah_pada";
$query=mysqli_query($koneksi,$sql);
$no=0;
$grandtotal=0;
while($kolom=mysqli_fetch_array($query)){
    $sub=$kolom['jumlah']*$kolom['harga'];
    $no++;
    $html.='
        <tr>
            <td>'.$no.'</td>
            <td>'.date('d-m-Y H:i:s',strtotime($kolom['diubah_pada'])).'</td>
            <td>'.$kolom['nama_client'].'</td>
            <td>'.$kolom['regional'].'</td>
            <td>'.$kolom['metode_bayar'].'</td>
            <td align="right">'.number_format($kolom['jumlah'],2).' x '.number_format($kolom['harga']).'</td>            
            <td align="right">'.number_format($sub).'</td>
        </tr>
        ';
}        

$html.='
</tbody>
</table>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$nama_file="rekapitulasi_umum_".date('Y_m_d_H_i_s').".pdf";
$pdf->Output($nama_file, 'I');

//============================================================+
// END OF FILE
//============================================================+
