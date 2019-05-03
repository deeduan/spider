<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UExcel
{
    public $spreadsheet;

    public function __construct($file_name)
    {
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_name);
        require_once '../vendor/autoload.php';
    }

    /**
     * 获取asin
     *
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function asin()
    {
        return $this->spreadsheet
            ->getActiveSheet()
            ->getCell('A2')
            ->getFormattedValue();
    }

    /**
     * 获取关键词
     *
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function getKeyWords()
    {
        $total = $this->spreadsheet->getActiveSheet()->toArray();
        // 计算有多少列
        $count = count($total);

        $range = "B2:B{$count}";
        // 读取多列到一个数组
        $dataArray = $this->spreadsheet->getActiveSheet()->rangeToArray(
                $range,
                NULL,
                TRUE,
                TRUE,
                false
        );

        $data = [];

        foreach ($dataArray as $value) {
            $data[] = $value[0] ?? false;
        }

        // 去除数组中等于false的字段
        return array_filter($data);
    }

    /**
     * 设置广告排名
     *
     * @param $data
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function setAdRange($data)
    {
        // 设置多列
        $rowArray = $data;
        $columnArray = array_chunk($rowArray, 1);
        $this->spreadsheet
            ->getActiveSheet()
            ->fromArray($columnArray, NULL, 'E2');
    }

    /**
     * 设置自然排名
     *
     * @param $data
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function setNaturalRange($data)
    {
        // c2
        // 设置多列
        $rowArray = $data;
        $columnArray = array_chunk($rowArray, 1);
        $this->spreadsheet
            ->getActiveSheet()
            ->fromArray($columnArray, NULL, 'C2');
    }

    /**
     * 设置广告排名连接
     *
     * @param $data
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function setAdUrl($data)
    {
        // f2
        // start 2
        $start = 2;
        foreach ($data as $key => $value) {
            $pos = $start + $key;
            $position = "F{$pos}";
            $this->spreadsheet->getActiveSheet()->setCellValue($position, $value);
            $this->spreadsheet->getActiveSheet()->getCell($position)->getHyperlink()->setUrl($value);
        }
    }

    /**
     * 设置自然连接
     *
     * @param $data
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function setNaturalUrl($data)
    {
        $start = 2;
        foreach ($data as $key => $value) {
            $pos = $start + $key;
            $position = "D{$pos}";
            $this->spreadsheet->getActiveSheet()->setCellValue($position, $value);
            $this->spreadsheet->getActiveSheet()->getCell($position)->getHyperlink()->setUrl($value);
        }
    }

    /**
     * 保存文件到excel
     *
     * @param $file_name
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function saveExcel($file_name)
    {
        // 如果有同名的文件 - 删除之
        if (file_exists($file_name)) {
            unlink($file_name);
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($file_name);
    }

}
