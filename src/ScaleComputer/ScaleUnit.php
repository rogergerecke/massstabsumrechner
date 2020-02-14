<?php


namespace App\ScaleComputer;


class ScaleUnit
{
    #
    #  SETTING THE TOOL
    #
    protected $valid_scale_unit = ['1:5', '1:10', '1:15', '1:25', '1:30', '1:35', '1:50', '1:75', '1:1000'];

    protected $valid_units = ['mm', 'cm', 'dm', 'm', 'km', 'inch', 'foot', 'yard', 'fathom', 'rod', 'chain'];

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
     */
    public function execute()
    {

        // get the form input messurit value
        $input = $this->getInputUnitValue();

        // get the scale 1cm * 50 = 50cm
        $scaleValue = $this->createScale();

        // calculate the output
        $output = $input * $scaleValue;
        $output = $this->calculateFromUnitToUnit($this->fromUnit, $this->toUnit, $output);

        $factore = $this->getFactors();
        foreach ($this->valid_units as $unit) {
            $result[] = [
                'value' => $this->calculateFromUnitToUnit($this->fromUnit, $unit, $output),
                'unit' => $unit,
                'description' => $this->getFactorDescription($unit)
            ];
        }

        $this->setOutputValue($output);
        $this->setResult($result);
    }


    /** Calculate the scale by given scaleunit
     * example 1:50  =  1cm * 50 result 50cm
     * @return float|int
     * @throws ScaleException
     */
    public function createScale()
    {


        $value = $this->inputUnitValue;

        //   empty ?
        if (!$this->scaleUnit) {
            throw new ScaleException('No valid scale');
        }

        if (!$this->inputUnitValue) {
            throw new ScaleException('No valid input value');
        }

        $exp = explode(':', $this->scaleUnit, 2);

        $counter = $exp[0];
        return (int)$exp[1] * $this->inputUnitValue;
    }


    function calculateFromUnitToUnit($fromUnit, $toUnit, $value = '')
    {

        $to_unit_factor = 0;
        $from_unit_factor = 0;

        // get the calculate factors
        foreach ($this->getFactors() as $factor) {
            if ($factor['unit'] == $toUnit) {
                $to_unit_factor = $factor['factor'];
            }
            if ($factor['unit'] == $fromUnit) {
                $from_unit_factor = $factor['factor'];
            }

        }

        return $to_unit_factor / $from_unit_factor * $value;
    }


    /**
     * Return a array with factor date attributes
     * @return array
     */
    private function getFactors()
    {
        // Metric
        $factors[] = ['factor' => floatval('1.00000000000000E+0006'), 'unit' => 'µm', 'description' => 'Mikrometer'];
        $factors[] = ['factor' => floatval('1.00000000000000E+0002'), 'unit' => 'cm', 'description' => 'Zentimeter'];
        $factors[] = ['factor' => floatval('1.00000000000000E+0003'), 'unit' => 'mm', 'description' => 'Millimeter'];
        $factors[] = ['factor' => floatval('1.00000000000000E+0001'), 'unit' => 'dm', 'description' => 'Dezimeter'];
        $factors[] = ['factor' => floatval('1.00000000000000E+0000'), 'unit' => 'm', 'description' => 'Meter'];
        $factors[] = ['factor' => floatval('1.00000000000000E-0003'), 'unit' => 'km', 'description' => 'Kilometer'];

        // American
        $factors[] = ['factor' => floatval('39.37007874015748'), 'unit' => 'inch', 'description' => 'Zoll'];
        $factors[] = ['factor' => floatval('3.28083989501312E+0000'), 'unit' => 'foot', 'description' => 'Feet'];
        $factors[] = ['factor' => floatval('4.97095960000000E-0002'), 'unit' => 'chain', 'description' => 'Chain'];
        $factors[] = ['factor' => floatval('5.46806649168854E-0001'), 'unit' => 'fathom', 'description' => 'Fathom USA'];
        $factors[] = ['factor' => floatval('6.21371192237334E-0004'), 'unit' => 'miles', 'description' => 'Miles'];
        $factors[] = ['factor' => floatval('1.09361329833771E+0000'), 'unit' => 'yard', 'description' => 'Yard'];
        $factors[] = ['factor' => floatval('1.98838781515947E-0001'), 'unit' => 'rod', 'description' => 'Rods'];

        return $factors;
    }


    /**
     * @param $unit
     * @return bool|mixed
     */
    private function getFactorDescription($unit){
        $factors = $this->getFactors();

        foreach ($factors as $factor){
            if ($factor['unit'] == $unit){
                return $factor['description'];
            }
        }
        return false;
    }

    private function setResult($result)
    {
        $this->result = $result;
    }
}