<?php declare(strict_types=1);

namespace App\Tests\Pollutant\DataList;

use App\Air\Measurement\MeasurementInterface;
use App\Entity\Data;
use App\Pollution\DataList\DataList;
use PHPUnit\Framework\TestCase;

class DataListTest extends TestCase
{
    public function testEmptyDataList(): void
    {
        $dataList = new DataList();

        $this->assertCount(6, $dataList->getList());
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_PM10]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_PM25]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_SO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_CO]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_NO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_O3]);
    }

    public function testAddData(): void
    {
        $dataList = new DataList();

        $dataList->addData((new Data())->setPollutant(MeasurementInterface::MEASUREMENT_PM10));

        $this->assertCount(6, $dataList->getList());
        $this->assertCount(1, $dataList->getList()[MeasurementInterface::MEASUREMENT_PM10]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_PM25]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_SO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_CO]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_NO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_O3]);
    }

    public function testAddIdenticalData(): void
    {
        $dataList = new DataList();

        $dataList->addData((new Data())->setPollutant(MeasurementInterface::MEASUREMENT_PM10));
        $dataList->addData((new Data())->setPollutant(MeasurementInterface::MEASUREMENT_PM10));

        $this->assertCount(6, $dataList->getList());
        $this->assertCount(1, $dataList->getList()[MeasurementInterface::MEASUREMENT_PM10]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_PM25]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_SO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_CO]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_NO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_O3]);
    }

    public function testAddNonIdenticallData(): void
    {
        $dataList = new DataList();

        $dataList->addData((new Data())->setId(23)->setPollutant(MeasurementInterface::MEASUREMENT_PM10));
        $dataList->addData((new Data())->setId(42)->setPollutant(MeasurementInterface::MEASUREMENT_PM10));

        $this->assertCount(6, $dataList->getList());
        $this->assertCount(2, $dataList->getList()[MeasurementInterface::MEASUREMENT_PM10]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_PM25]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_SO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_CO]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_NO2]);
        $this->assertEmpty($dataList->getList()[MeasurementInterface::MEASUREMENT_O3]);
    }
}