<?php


namespace App\ScaleComputer;


class ScaleUnit
{
    #
    #  SETTING THE TOOL
    #
    protected $valid_scale_unit = ['1:5','1:10','1:15', '1:25', '1:30', '1:35', '1:50', '1:75','1:1000'];

    protected $valid_units = ['mm', 'cm', 'm', 'km', 'inch', 'zoll', 'fet', 'yeard'];

    const DEFAULT_FROM_UNIT = 'cm';
    const DEFAULT_TO_UNIT = 'zoll';
    const DEFAULT_INPUT_VALUE = 1;

    ###########

    /**
     * The scale unit Masstab 1:50
     * @var string
     */
    protected $scaleUnit = '';

    /**
     * From messure unit
     * von Masseinhaeit
     * @var string
     */
    protected $fromUnit = '';

    protected $inputUnitValue = '';

    /**
     * To messure unit
     * zu Masseinheit
     * @var string
     */
    protected $toUnit = '';

    protected $outputValue;

    public function __construct()
    {
        if (!$this->inputUnitValue) {
            $this->inputUnitValue = self::DEFAULT_INPUT_VALUE;
        }

        if (!$this->fromUnit) {
            $this->fromUnit = self::DEFAULT_FROM_UNIT;
        }

        if (!$this->toUnit) {
            $this->toUnit = self::DEFAULT_TO_UNIT;
        }
    }

    /**
     * @return array
     */
    public function getValidScaleUnit(): array
    {
        return $this->valid_scale_unit;
    }

    /**
     * @return array
     */
    public function getValidUnits(): array
    {
        return $this->valid_units;
    }


    /**
     * @return string
     */
    public function getScaleUnit(): string
    {
        return $this->scaleUnit;
    }

    /**
     * @param string $scaleUnit
     * @return ScaleUnit
     */
    public function setScaleUnit(string $scaleUnit): ScaleUnit
    {
        $this->scaleUnit = $scaleUnit;
        return $this;
    }

    /**
     * @return string
     */
    public function getInputUnitValue(): string
    {
        return $this->inputUnitValue;
    }

    /**
     * @param string $inputUnitValue
     * @return ScaleUnit
     */
    public function setInputUnitValue(string $inputUnitValue): ScaleUnit
    {
        $this->inputUnitValue = $inputUnitValue;
        return $this;
    }


    /**
     * @return string
     */
    public function getFromUnit(): string
    {
        return $this->fromUnit;
    }

    /**
     * @param string $fromUnit
     * @return ScaleUnit
     */
    public function setFromUnit(string $fromUnit): ScaleUnit
    {
        $this->fromUnit = $fromUnit;
        return $this;
    }

    /**
     * @return string
     */
    public function getToUnit(): string
    {
        return $this->toUnit;
    }

    /**
     * @param string $toUnit
     * @return ScaleUnit
     */
    public function setToUnit(string $toUnit): ScaleUnit
    {
        $this->toUnit = $toUnit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutputValue()
    {
        return $this->outputValue;
    }

    /**
     * @param mixed $outputValue
     */
    public function setOutputValue($outputValue): void
    {
        $this->outputValue = $outputValue;
    }


    /**
     * @throws \Exception
     */
    public function execute()
    {

        // get the form input messurit value
        $input = $this->getInputUnitValue();

        // get the scale 1cm * 50 = 50cm
        $scaleValue = $this->createScale();

        // calculate the output
        $output = $input * $scaleValue;

        $this->setOutputValue($output);
    }


    /** Calculate the scale by given scaleunit
     * example 1:50  =  1cm * 50 result 50cm
     * @return float|int
     * @throws \Exception
     */
    public function createScale()
    {


        $value = $this->inputUnitValue;

        //   empty ?
        if (!$this->scaleUnit) {
            throw new \Exception('No valid scale');
        }

        if (!$this->inputUnitValue) {
            throw new \Exception('No valid input value');
        }

        $exp = explode(':', $this->scaleUnit, 2);

        $counter = $exp[0];
        $denominator = (int)$exp[1];

        return $this->inputUnitValue * $denominator;
    }

    public function calculateFromUnitToUnit($fromUnit = '', $toUnit = '', $value = '')
    {

    }

}