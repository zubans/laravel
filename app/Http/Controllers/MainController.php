<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Services\XmlService;
use App\Services\WorkWithBigFilesService;

class MainController extends Controller
{
    public function home()
    {
        return (new WorkWithBigFilesService())->addFileOfGoodsToDataBase();

    }
}

