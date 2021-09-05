<?php

namespace App\Services;

use App\Services\XmlService;

class WorkWithBigFilesService
{

    const END_TAGS = "</Товары>
	</Каталог>
</КоммерческаяИнформация>";

    /**
     * @var int
     */
    private $offset = 0;

    public function addFileOfGoodsToDataBase()
    {
        $this->readBigFile();
    }

    /**
     * @return string
     */
    public function readBigFile():string
    {
        $res = '';
        $countOfGoods = $countOfLines = 0;
        $file = fopen(storage_path("public") . "/import0_1.xml", "r");
        fseek($file, $this->offset);

        while(($line = fgets($file)) !== false) {
            $countOfLines++;
            $res .= $line;
            if (strpos($line,"</Товар>")) {
                $countOfGoods++;
            }

            if ($countOfGoods >= 1) {
                break;
            }
        }

        $this->offset = ftell($file);
        fclose($file);
        $res .= self::END_TAGS;

        dd($this->offset, $countOfLines);
        return $res;
    }

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


}


