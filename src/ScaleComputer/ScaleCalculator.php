<?php


namespace App\ScaleComputer;


class ScaleCalculator extends FactorSetting
{
    private $value;

    private $unit;

    private $unit_filter;

    private $decimal_limit;

    private $input_value;

    private $input_unit;

    private $result = [];
    /**
     * @var int
     */
    private $input_value_limit;

    public function __construct($value = null, $unit = null, $unit_filter = [], $input_value_limit = 15, $decimal_limit = 15)
    {

        // over set valid user input
        $this->setValue($value);

        $this->unit = $unit;
        $this->unit_filter = $unit_filter;
        $this->decimal_limit = $decimal_limit;

        $this->input_value = $value;
        $this->input_unit = $unit;
        $this->input_value_limit = $input_value_limit;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     * @return ScaleCalculator
     */
    public function setValue($value)
    {
        $this->value = str_replace(',', '.', $value);
        return $this;
    }

    /**
     * Valid by type integer, float and $this->input_value_limit
     * @param $value
     * @return bool
     */
    public function isValueValid($value)
    {
        // too long 12 < 15
        if (strlen($value) <= $this->input_value_limit) {
            return true;
        }

        // false type
        if (is_float($value) or is_integer($value)) {
            return true;
        }

        return false;
    }

    /**
     * @return null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param null $unit
     * @return ScaleCalculator
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }


    /**
     * Valid by the given units from FactorSetting class
     * @param $unit
     * @return bool
     */
    public function isUnitValid($unit)
    {
        $valid_units = $this->getAllUnits();

        if (!in_array($unit, $valid_units, true)) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getUnitFilter(): array
    {
        return $this->unit_filter;
    }

    /**
     * @param array $unit_filter
     * @return ScaleCalculator
     */
    public function setUnitFilter(array $unit_filter): ScaleCalculator
    {
        $this->unit_filter = $unit_filter;
        return $this;
    }

    /**
     * @return int
     */
    public function getDecimalLimit(): int
    {
        return $this->decimal_limit;
    }

    /**
     * Set Limit of decimal precision .00000
     * @param int $decimal_limit
     * @return ScaleCalculator
     */
    public function setDecimalLimit(int $decimal_limit): ScaleCalculator
    {
        $this->decimal_limit = $decimal_limit;
        return $this;
    }

    /**
     * @return null
     */
    public function getInputValue()
    {
        return $this->input_value;
    }

    /**
     * @param null $input_value
     */
    private function setInputValue($input_value): void
    {
        $this->input_value = $input_value;
    }

    /**
     * @return null
     */
    public function getInputUnit()
    {
        return $this->input_unit;
    }

    /**
     * @param null $input_unit
     */
    private function setInputUnit($input_unit): void
    {
        $this->input_unit = $input_unit;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param array $result
     */
    private function setResult(array $result): void
    {
        $this->result = $result;
    }


    /**
     * Calculate a given unit value to other scale unit
     * @param string $to_unit
     * @return float|int
     * @throws ScaleException
     */
    private function scaleUnit(string $to_unit)
    {
        if (!$this->unit) {
            throw new ScaleException('A base unit must be set for scale the unit');
        }

        // valid the user: value before calculate
        if (!$this->isValueValid($this->value)) {
            echo 'The value is not valid';
        }
        if (!$this->value) {
            throw new ScaleException('A value must be set to scale');
        }

        // valid the user input: unit
        if (!$this->isUnitValid($to_unit)) {
            echo 'input unit not valid';
        }
        if (!$to_unit) {
            throw new ScaleException('A unit must be set for scale the unit');
        }

        // get 1.89897696
        $to_unit = $this->getFactor($to_unit);
        if (!$to_unit) {
            throw new ScaleException('Nothing unit value found in list for calculate to');
        }

        // get 2.467567
        $from_unit = $this->getFactor($this->unit);
        if (!$from_unit) {
            throw new ScaleException('Nothing unit value found in list for calculate from');
        }

        $result = $to_unit / $from_unit * $this->value;

        return round($result, $this->decimal_limit);
    }


    /**
     * @return $this
     * @throws ScaleException
     */
    public function calculateScale()
    {

        // if no output filter set, calculate with all existing unit scale
        if (!$this->unit_filter) {
            $this->unit_filter = $this->getAllUnits();
        }

        // calculate the new output value
        foreach ($this->unit_filter as $unit) {
            $value = ['value' => $this->scaleUnit($unit)];
            $result[] = array_merge($value, $this->getFactorArrayData($unit));
        }

        $this->setResult($result);

        return $this;
    }

}