<?php

namespace App\Services;

use App\Models\Goods;
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

    /**
     * @var int
     */
    private $fileSize = 0;

    public function addFileOfGoodsToDataBase()
    {
        $goods = new Goods();
        $result = $this->readBigFile();
        $arr = (new XmlService())->XmlToArray($result['xml']);
        $catalog = $arr['Каталог'];
        while ($this->fileSize >= $this->offset) {
            $goodsArr = $result['countOfGoods'] === 1 ? $catalog['Товары']['Товар'] : $catalog['Товары']['Товар'][0];

            foreach ($goodsArr as $item) {
                if (!$goods->isRecordExist('code', $goodsArr['Код'])){
                    $goods->setName($this->removeClassificatorString( $city = $arr['Классификатор']['Наименование']));
                    $goods->setCode($item['Код']);
                    $goods->setWeight($item['Вес']);
                    switch ($city):
                        case "Москва":
                            $goods->setQuantityMoscow();

                    $goods->quantity_moscow = 'name';
                    $goods->quantity_speterburg = 'name';
                    $goods->quantity_samara = 'name';
                    $goods->quantity_chelyabinsk = 'name';
                    $goods->price_moscow = 2;
                    $goods->price_speterburg = 3;
                    $goods->price_samara = 4;
                    $goods->price_chelyabinsk = 5;
                    $goods->usage = 'name';
                    $goods->save();
                }
            }
        }






        $goods->setName($arr['Каталог']['Наименование']);//  todo change to классификатор
        $goods->code = 1;
        $goods->weight = 'name';
        $goods->quantity_moscow = 'name';
        $goods->quantity_speterburg = 'name';
        $goods->quantity_samara = 'name';
        $goods->quantity_chelyabinsk = 'name';
        $goods->price_moscow = 2;
        $goods->price_speterburg = 3;
        $goods->price_samara = 4;
        $goods->price_chelyabinsk = 5;
        $goods->usage = 'name';
        $goods->save();
        return 'ok';
    }

    /**
     * @return array
     */
    public function readBigFile():array
    {
        $res = '';
        $countOfGoods = $countOfLines = 0;
        $file = fopen(storage_path("public") . "/import0_1.xml", "r");

        if ($this->fileSize === 0) {
            $this->fileSize =  filesize(storage_path("public") . "/import0_1.xml");
        }

        fseek($file, $this->offset);

        while(($line = fgets($file)) !== false) {
            $countOfLines++;
            $res .= $line;
            if (strpos($line,"</Товар>")) {
                $countOfGoods++;
            }

            if ($countOfGoods >= 2) {
                break;
            }
        }



        $this->offset = ftell($file);
        fclose($file);
        $res .= self::END_TAGS;

        return [
            'xml'        => $res,
            'countOfGoods' =>$countOfGoods,
        ];
    }

    private function removeClassificatorString(string $string): string
    {
        return substr(substr($string, 28), 0, -1);
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


