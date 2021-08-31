<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\XmlService;

class MainController extends Controller
{
    public function home() 
    {
        $xml = Storage::get('public/import0_1.xml');
        $xmlArray = (new XmlService())->XmlToArray($xml);
        dd($xmlArray);

        return view('home', );
    }
}
