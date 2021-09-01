<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\XmlService;

class MainController extends Controller
{
    public function home() 
    {
        $xmlFiles = Storage::files('public');
        foreach($xmlFiles as $file) {

            $xml = Storage::get($file);
            $xmlArray = (new XmlService())->XmlToArray($xml);
        }
        dd($xmlArray);
        

        return view('home', );
    }
}

// public function read_file($file)
// {
//     $fp = fopen($file, 'r');

//     while(($line = fgets($fp)) !== false)
//         yield $line;

//     fclose($fp);
// }  

// public function upload(Request $request){
//             set_time_limit(0);
//             ini_set('MAX_EXECUTION_TIME', 36000);
//             $file = Input::file('file');
//             $filePath = $file->getRealPath();

//             foreach(read_file($filePath) as $line)
//             {
//                << DO THE DATABASE OPERATION >>
//             }

//       return redirect()->back()->with('success', 'File uploaded successfully');
//     }
