<?php


namespace App\ScaleComputer;


class FactorSetting
{
    private function getDescription(string $from_unit)
    {
        $factors = $this->getStore();

        foreach ($factors as $factor) {
            if ($factor['unit'] == $from_unit) {
                return $factor['description'];
            }
        }
        return false;
    }

    protected function getStore()
    {
        // Metric
        $factors[] = ['factor' => '1.00000000000000E+0006', 'unit' => 'µm', 'description' => 'Mikrometer'];
        $factors[] = ['factor' => '1.00000000000000E+0002', 'unit' => 'cm', 'description' => 'Zentimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0003', 'unit' => 'mm', 'description' => 'Millimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0001', 'unit' => 'dm', 'description' => 'Dezimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0000', 'unit' => 'm', 'description' => 'Meter'];
        $factors[] = ['factor' => '1.00000000000000E-0003', 'unit' => 'km', 'description' => 'Kilometer'];

        // American
        $factors[] = ['factor' => '39.37007874015748', 'unit' => 'inch', 'description' => 'Zool'];
        $factors[] = ['factor' => '3.28083989501312E+0000', 'unit' => 'foot', 'description' => 'Feet'];
        $factors[] = ['factor' => '4.97095960000000E-0002', 'unit' => 'chain', 'description' => 'Chain'];
        $factors[] = ['factor' => '5.46806649168854E-0001', 'unit' => 'fathom', 'description' => 'Fathom USA'];
        $factors[] = ['factor' => '6.21371192237334E-0004', 'unit' => 'miles', 'description' => 'Miles'];
        $factors[] = ['factor' => '1.09361329833771E+0000', 'unit' => 'yard', 'description' => 'Yard'];
        $factors[] = ['factor' => '1.98838781515947E-0001', 'unit' => 'rod', 'description' => 'Rods'];

        return $factors;
    }

    public function getFactor(string $from_unit)
    {
        $factors = $this->getStore();

        foreach ($factors as $factor) {
            if ($factor['factor'] == $from_unit) {
                return floatval($factor['factor']);
            }
        }
        return false;
    }
}