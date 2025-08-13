<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;

class QRCodeController extends Controller
{
    public function gerarQrCode($slug)
    {

        $qrcode = QRCode::url(url("/s/{$slug}"))
            ->setSize(8)
            ->setMargin(2);

        return response($qrcode->png(), 200)
            ->header('Content-Type', 'image/png');
    }
}
