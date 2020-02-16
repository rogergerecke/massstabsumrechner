<?php


namespace App;


use App\ScaleComputer\ScaleCalculator;

/**
 * Project bezogenne individiuele klasse für Maßstabsrechner
 * Class ScaleUnit
 * @package App
 */
class ScaleUnit
{
    #
    #  SETTING THE TOOL
    #
    const DEFAULT_SCALE_UNIT = '1:5';
    protected array $valid_scale_unit = ['1:5', '1:10', '1:15', '1:25', '1:30', '1:35', '1:50', '1:75', '1:1000'];
    protected array $valid_units = ['mm', 'cm', 'dm', 'm', 'km', 'inch', 'foot', 'yard', 'fathom', 'rod', 'chain'];

    const DEFAULT_FROM_UNIT = 'cm';
    const DEFAULT_TO_UNIT = 'inch';
    const DEFAULT_INPUT_VALUE = 1;
    const DEFAULT_OUTPUT_VALUE = 'Ergebnis Ausgabe';

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
    private $result;

    private $value;
    /**
     * @var ScaleCalculator
     */
    private ScaleCalculator $calculator;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    private function setValue($value): void
    {
        $this->value = $value;
    }


    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }


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

        if (!$this->outputValue) {
            $this->outputValue = self::DEFAULT_OUTPUT_VALUE;
        }

        if (!$this->scaleUnit) {
            $this->scaleUnit = self::DEFAULT_SCALE_UNIT;
        }


        $this->calculator = new ScaleCalculator($this->inputUnitValue, $this->fromUnit, $this->valid_units);
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
     * @throws ScaleException
     * @throws ScaleComputer\ScaleException
     */
    public function execute()
    {

        // get the scale 1cm * 50 = 50cm
        $value = $this->createScale();

        $this->calculator
            ->setUnit($this->fromUnit)
            ->setValue($value)
            ->setUnitFilter($this->valid_units)
            ->calculateScale();

        // full result array
        $this->setResult($this->calculator->getResult());
    }


    /** Calculate the scale by given scaleunit
     * example 1:50  =  1cm * 50 result 50cm
     * @return float|int
     */
    public function createScale()
    {
        // todo add * $exp[0]
        $exp = explode(':', $this->scaleUnit, 2);
        return (int)$exp[1] * $this->inputUnitValue;
    }

    private function setResult($result)
    {
        $this->result = $result;
    }
}