<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Services\XmlService;
use App\Services\WorkWithBigFilesService;

class MainController extends Controller
{
    public function home()
    {
//        $xml = Storage::get('public/import0_1.xml');
        $file = (new WorkWithBigFilesService())->readBigFile();
        $xmlArray = (new XmlService())->XmlToArray($file);
        dd($xmlArray);
//        $xmlFiles = Storage::get(App::basePath(). '/storage/public/import0_1.xml');
//        dd($xmlFiles);
//        if (empty($xmlFiles)) {
//            return new JsonResponse('empty file', 403);
//        }
//            foreach($xmlFiles as $file) {
//
//            $xml = Storage::get($file);
//            $xmlArray = (new XmlService())->XmlToArray($xml);
//        }
//        dd($xmlArray);
//
//
//        return view('home' );
    }
}

