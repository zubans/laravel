<?php

namespace App\Services;

use App\Models\Goods;
use Symfony\Component\HttpFoundation\JsonResponse;

class WorkWithBigFilesService implements Fields
{
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

        $result = $this->readBigFile();
        $arr = (new XmlService())->XmlToArray($result['xml']);
        $catalog = $arr[Fields::CATALOG];
        $goodsArr = [];

//        while ($this->fileSize >= $this->offset) {
       
        if ($result['countOfGoods'] === 1) {
            array_push($goodsArr, $catalog[Fields::TOVARS][Fields::TOVAR]);
        } else {
            $goodsArr = $catalog[Fields::TOVARS][Fields::TOVAR];
        }

            foreach ($goodsArr as $item) {
                $goods = new Goods();
                if (!$goods->isRecordExist('code', $item[Fields::COD])) {
                    $goods
                        ->setName(
                            $this->removeClassificatorString($city = $arr[Fields::CLASSOFICATOR][Fields::NAMING])
                        );
                    $goods->setCode($item[Fields::COD]);
                    $goods->setWeight($item[Fields::WES] ?? 0);
                    switch ($city) {
                        case Fields::MOSCOW:
                            $goods->setQuantityMoscow($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            $goods->setPriceMoscow($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            break;
                        case Fields::ST_PETERSBURG:
                            $goods->setPriceSpeterburg($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            $goods->setQuantitySpeterburg($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            break;
                        case Fields::CHELYABINSK:
                            $goods->setPriceChelyabinsk($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            $goods->setQuantityChelyabinsk($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            break;
                        case Fields::SAMARA:
                            $goods->setPriceSamara($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            $goods->setQuantitySamara($item[Fields::RECALCULATION][Fields::PIECE] ?? 0);
                            break;
                        default:
                            break;
                    }
                    $alternatives = [];
                    if (empty($item[Fields::ALTERNATIVES])) {
                        $goods->save();
                        continue;
//                        return new JsonResponse($result['countOfGoods']);
                    }
                    if (array_key_exists(
                        Fields::MARK,
                        $alternative = $item[Fields::ALTERNATIVES][Fields::ALTERNATIVE]
                    )) {
                        $alternatives[0] =
                            $alternative[Fields::MARK] .
                            '-' .
                            $alternative[Fields::MODEL] .
                            '-' .
                            $alternative[Fields::CATEGORY];
                    } else {
                        foreach ($item[Fields::ALTERNATIVES][Fields::ALTERNATIVE] as $key => $alternative) {
                            $alternatives[$key] =
                                serialize($alternative[Fields::MARK]) .
                                '-' .
                                serialize($alternative[Fields::MODEL]) .
                                '-' .
                                serialize($alternative[Fields::CATEGORY]);
                        }
                    }

                    $goods->setUsage(implode('|',$alternatives));
                    $goods->save();
                }
            }
//        }


        return new JsonResponse($result['countOfGoods']);
    }

    /**
     * @return array
     */
    public function readBigFile():array
    {
        $res = '';
        $countOfGoods = $countOfLines = 0;
        $fileImport = fopen(storage_path("public") . "/import0_1.xml", "r");
        $fileOffers = fopen(storage_path("public") . "/offers0_1.xml", "r");




        if ($this->fileSize === 0) {
            $this->fileSize =  filesize(storage_path("public") . "/import0_1.xml");
        }

        fseek($fileImport, $this->offset);

        while(($line = fgets($fileImport)) !== false) {
            $countOfLines++;
            $res .= $line;
            if (strpos($line,"</Товар>")) {
                $countOfGoods++;
            }

            if ($countOfGoods >= 1) {
                break;
            }
        }



        $this->offset = ftell($fileImport);
        fclose($fileImport);
        $res .= Fields::END_TAGS;

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


