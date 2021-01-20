<?php

namespace App\Http\Controllers;

use App\Generate;
use Barryvdh\DomPDF\Facade as PDF;

class GeneratesController extends Controller
{
    public function printPDF($provinsi)
    {

        if (isset($_GET['pdf'])) {
            $str = str_replace('%20', ' ', $provinsi);
            $data = Generate::where('provinsi', $str)->get();
            $pdf = PDF::loadView('pdf', ['data' => $data]);
            return $pdf->download("data.pdf");
        }

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Data Report Pdf']);
    }
}
