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

    public function __construct($value = null, $unit = null, $unit_filter = [], $decimal_limit = 15)
    {

        $this->value = $value;
        $this->unit = $unit;
        $this->unit_filter = $unit_filter;
        $this->decimal_limit = $decimal_limit;

        $this->input_value = $value;
        $this->input_unit = $unit;
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
        $this->value = $value;
        return $this;
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
     * Calculate a given unit value to other scale unit
     * @param string $to_unit
     * @return float|int
     * @throws ScaleException
     */
    private function scaleUnit(string $to_unit)
    {
        if (!$this->unit){
            throw new ScaleException('A base unit must be set for scale the unit');
        }

        if (!$this->value){
            throw new ScaleException('A value must be set to scale');
        }

        return $this->getFactor($to_unit) / $this->getFactor($this->unit) * $this->value;
    }
}