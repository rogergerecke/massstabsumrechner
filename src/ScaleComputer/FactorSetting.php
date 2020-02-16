<?php


namespace App\ScaleComputer;


class FactorSetting
{
    /**
     * Return the text description for the unit
     * @param string $from_unit
     * @return bool|mixed
     */
    private function getDescription(string $from_unit)
    {
        $store = $this->getStore();

        foreach ($store as $item) {
            if ($item['unit'] == $from_unit) {
                return $item['description'];
            }
        }
        return false;
    }

    /**
     * Return a array list with all factor data
     * @return array
     */
    protected function getStore()
    {
        // Metric
        $factors[] = ['factor' => '1.00000000000000E+0006', 'unit' => 'µm', 'name' => 'Mikrometer', 'description' => 'Mikrometer'];
        $factors[] = ['factor' => '1.00000000000000E+0002', 'unit' => 'cm', 'name' => 'Zentimeter', 'description' => 'Zentimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0003', 'unit' => 'mm', 'name' => 'Millimeter', 'description' => 'Millimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0001', 'unit' => 'dm', 'name' => 'Dezimeter', 'description' => 'Dezimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0000', 'unit' => 'm', 'name' => 'Meter', 'description' => 'Meter'];
        $factors[] = ['factor' => '1.00000000000000E-0003', 'unit' => 'km', 'name' => 'Kilometer', 'description' => 'Kilometer'];

        // American
        $factors[] = ['factor' => '39.37007874015748', 'unit' => 'inch', 'name' => 'zoll', 'description' => 'zoll'];
        $factors[] = ['factor' => '3.28083989501312E+0000', 'unit' => 'foot', 'name' => 'feet', 'description' => 'feet'];
        $factors[] = ['factor' => '4.97095960000000E-0002', 'unit' => 'chain', 'name' => 'chain', 'description' => 'chain'];
        $factors[] = ['factor' => '5.46806649168854E-0001', 'unit' => 'fathom', 'name' => 'fathom', 'description' => 'fathom USA'];
        $factors[] = ['factor' => '6.21371192237334E-0004', 'unit' => 'miles', 'name' => 'miles', 'description' => 'miles'];
        $factors[] = ['factor' => '1.09361329833771E+0000', 'unit' => 'yard', 'name' => 'yard', 'description' => 'yard'];
        $factors[] = ['factor' => '1.98838781515947E-0001', 'unit' => 'rod', 'name' => 'rods', 'description' => 'rods'];

        return $factors;
    }

    /**
     * Return the float value for the unit '4.97095960000000E-0002'
     * @param string $from_unit
     * @return bool|float
     */
    public function getFactor(string $from_unit)
    {
        $store = $this->getStore();

        foreach ($store as $item) {
            if ($item['unit'] == $from_unit) {
                return floatval($item['factor']);
            }
        }
        return false;
    }

    /**
     * Return a array['mm', 'cm', 'dm', 'm'] with all available units
     * @return array|null
     */
    public function getAllUnits()
    {
        $store = $this->getStore();

        $units = null;
        foreach ($store as $item) {
            $units[] = $item['unit'];
        }
        return $units;
    }

    /**
     * Return a array['factor' => '1.00000000000000E+0002', 'unit' => 'cm', 'description' => 'Zentimeter']
     * @param string $from_unit
     * @return array|false
     */
    public function getFactorArrayData(string $from_unit)
    {
        $store = $this->getStore();

        foreach ($store as $item) {
            if ($item['unit'] == $from_unit) {
                return $item;
            }
        }
        return false;
    }
}