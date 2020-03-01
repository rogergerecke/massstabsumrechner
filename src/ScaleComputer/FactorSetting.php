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

        // Internationales Einheitensystem
        // SI-Einheiten

        // Metric units
        $factors[] = ['factor' => '1.00000000000000E+0002', 'unit' => 'cm', 'name' => 'Zentimeter', 'description' => 'Zentimeter'];
        $factors[] = ['factor' => '1.00000000000000E+0001', 'unit' => 'dm', 'name' => 'Dezimeter', 'description' => 'Dezimeter'];
        $factors[] = ['factor' => '1.00000000000000E-0001', 'unit' => 'dam', 'name' => 'Dekameter', 'description' => 'Dekameter'];
        $factors[] = ['factor' => '5.24934380000000E+0001', 'unit' => 'Digit', 'name' => 'Digit', 'description' => 'Digit'];
        $factors[] = ['factor' => '1.00000000000000E-0009', 'unit' => 'Gm', 'name' => 'Gigameter', 'description' => 'Gigameter Gm'];
        $factors[] = ['factor' => '1.00000000000000E-0002', 'unit' => 'hm', 'name' => 'Hektometer', 'description' => 'Hektometer hm'];
        $factors[] = ['factor' => '1.00000000000000E-0006', 'unit' => 'Mm', 'name' => 'Megameter', 'description' => 'Megameter'];
        $factors[] = ['factor' => '1.00000000000000E+0000', 'unit' => 'm', 'name' => 'Meter', 'description' => 'Meter m'];
        $factors[] = ['factor' => '1.00000000000000E+0006', 'unit' => 'µm', 'name' => 'Mikrometer', 'description' => 'Mikrometer µm (microns)'];
        $factors[] = ['factor' => '1.00000000000000E-0003', 'unit' => 'km', 'name' => 'Kilometer', 'description' => 'Kilometer'];
        $factors[] = ['factor' => '1.00000000000000E-0004', 'unit' => 'Mm', 'name' => 'Myriameter', 'description' => 'Myriameter'];
        $factors[] = ['factor' => '1.00000000000000E+0003', 'unit' => 'mm', 'name' => 'Millimeter', 'description' => 'Millimeter'];

        // Astronomic units
        $factors[] = ['factor' => '1.88972613392125E+0010', 'unit' => 'a.u.', 'name' => '', 'description' => 'Atomare Längeneinheit'];
        $factors[] = ['factor' => '1.00000000000000E+0010', 'unit' => 'Å', 'name' => 'angstrom', 'description' => 'Angström'];
        $factors[] = ['factor' => '6.68458134467038E-0012', 'unit' => 'AU', 'name' => '', 'description' => 'Astronomische Einheit'];
        $factors[] = ['factor' => '1.00000000000000E+0012', 'unit' => 'bicron', 'name' => 'picometer', 'description' => 'Picometer'];
        $factors[] = ['factor' => '2.73403333333333E-0002', 'unit' => 'fabric', 'name' => 'fabric', 'description' => 'Bolt (US cloth)'];
        $factors[] = ['factor' => '4.55671300000000E-0003', 'unit' => 'cable', 'name' => 'cable', 'description' => 'Cable (US, Survey)'];
        $factors[] = ['factor' => '3.93700790000000E+0003', 'unit' => 'caliber', 'name' => 'Caliber', 'description' => 'Caliber'];

        //Imperial units
        $factors[] = ['factor' => '3.28083990000000E-0002', 'unit' => 'ch', 'name' => 'chain', 'description' => 'Chain (engineer)'];
        $factors[] = ['factor' => '4.97095960000000E-0002', 'unit' => 'ch.gunter', 'name' => 'chain Gunter', 'description' => 'Chain (Gunter)'];
        $factors[] = ['factor' => '3.28083990000000E-0002', 'unit' => 'ch.ramdem', 'name' => 'chain.ramdem', 'description' => 'Chain (Ramden)'];
        $factors[] = ['factor' => '4.97095960000000E-0002', 'unit' => 'ch.us', 'name' => 'ch us survey', 'description' => 'Chain (US, survey)'];
        $factors[] = ['factor' => '2.21872265966754E+0000', 'unit' => 'cubit', 'name' => 'Elle', 'description' => 'Cubits (UK)'];
        $factors[] = ['factor' => '5.46806649168854E-0001', 'unit' => 'fat', 'name' => 'fat', 'description' => 'fathom (US, survey)'];
        $factors[] = ['factor' => '3.28083989501312E+0000', 'unit' => 'ft', 'name' => 'foot', 'description' => 'Feet (international)'];
        $factors[] = ['factor' => '3.28083333333333E+0000', 'unit' => 'ft.us', 'name' => 'foot us', 'description' => 'Feet (US, Survey)'];
        $factors[] = ['factor' => '1.00000000000000E+0015', 'unit' => 'fm', 'name' => 'Enrico Fermi', 'description' => 'Fermi'];
        $factors[] = ['factor' => '4.97096953789867E-0003', 'unit' => 'fur', 'name' => 'Furlong', 'description' => 'Furlong (US, survey)'];
        $factors[] = ['factor' => '9.84251968503937E+0000', 'unit' => 'horses', 'name' => 'horses', 'description' => 'Hand (horses)'];
        $factors[] = ['factor' => '39.37007874015748', 'unit' => 'in', 'name' => 'Zoll', 'description' => 'Zoll (inches)'];
        $factors[] = ['factor' => '1.05702341108135E-0016', 'unit' => '	ly', 'name' => 'Lichtjahre', 'description' => 'Lichtjahre'];
        $factors[] = ['factor' => '5.39956803455724E-0004', 'unit' => 'mi.int.naut', 'name' => 'mile', 'description' => 'Meilen (Int, US nautisch)'];
        $factors[] = ['factor' => '6.21371192237334E-0004', 'unit' => 'mi', 'name' => 'mile', 'description' => 'Meilen (international)'];
        $factors[] = ['factor' => '5.39611820000000E-0004', 'unit' => 'mi.uk.naut', 'name' => 'mile UK nautical', 'description' => 'Meilen (UK nautical)'];
        $factors[] = ['factor' => '6.21369949494949E-0004', 'unit' => 'mi.us', 'name' => 'mile US statute', 'description' => 'Meilen (US statute)'];
        $factors[] = ['factor' => '6.21369949494949E-0004', 'unit' => 'mi.us.sur', 'name' => 'mile US survey', 'description' => 'Meilen (US survey)'];
        $factors[] = ['factor' => '1.00000000000000E+0009', 'unit' => 'mμ', 'name' => 'Millimicron', 'description' => 'millimicron'];
        $factors[] = ['factor' => '1.74978127734033E+0001', 'unit' => 'nail', 'name' => 'nail cloth', 'description' => 'Nail (cloth)'];
        $factors[] = ['factor' => '9.94191920000000E-0003', 'unit' => 'Out', 'name' => 'Out', 'description' => 'Out'];// what is this
        $factors[] = ['factor' => '6.50960296629588E-0002', 'unit' => 'Pace', 'name' => '', 'description' => 'Pace (geometrical)'];
        $factors[] = ['factor' => '1.31233330000000E+0000', 'unit' => 'Pace', 'name' => '', 'description' => 'Pace (US, survey)'];
        $factors[] = ['factor' => '1.31233600000000E+0001', 'unit' => 'Palm', 'name' => '', 'description' => 'Palm'];
        $factors[] = ['factor' => '3.24077648680546E-0017', 'unit' => 'Parsec', 'name' => '', 'description' => 'Parsec'];
        $factors[] = ['factor' => '1.98838781515947E-0001', 'unit' => 'Perch', 'name' => '', 'description' => 'Perch (US survey)'];
        $factors[] = ['factor' => '2.84527560000000E+0003', 'unit' => 'Points', 'name' => '', 'description' => 'Points (Druck)'];
        $factors[] = ['factor' => '1.98838781515947E-0001', 'unit' => 'Pole', 'name' => '', 'description' => 'Pole (US survey)'];
        $factors[] = ['factor' => '1.03561660000000E-0004', 'unit' => 'Range', 'name' => 'Range', 'description' => 'Range (US survey)'];
        $factors[] = ['factor' => '1.98838781515947E-0001', 'unit' => 'rod', 'name' => 'Rods', 'description' => 'Rods'];
        $factors[] = ['factor' => '1.64041990000000E-0001', 'unit' => 'Rope', 'name' => 'Rope', 'description' => 'Rope'];
        $factors[] = ['factor' => '4.37445319335083E+0000', 'unit' => 'Span', 'name' => 'Span', 'description' => 'Span'];
        $factors[] = ['factor' => '1.00000000000000E-0012', 'unit' => 'Spat', 'name' => 'Spat', 'description' => 'Spat'];
        $factors[] = ['factor' => '1.00000000000000E+0012', 'unit' => 'Stigma', 'name' => 'Stigma', 'description' => 'Stigma'];
        $factors[] = ['factor' => '1.00000000000000E+0010', 'unit' => 'Tenthmeter', 'name' => 'Tenthmeter', 'description' => 'Tenthmeter'];
        $factors[] = ['factor' => '3.93700787401575E+0004', 'unit' => 'Thou', 'name' => 'Thou', 'description' => 'Thou'];
        $factors[] = ['factor' => '1.03561660000000E-0004', 'unit' => 'Township', 'name' => 'Township', 'description' => 'Township'];
        $factors[] = ['factor' => '1.09361329833771E+0000', 'unit' => 'yd', 'name' => 'yard', 'description' => 'Schritt international'];
        $factors[] = ['factor' => '1.09361329833771E+0000', 'unit' => 'yd.uk', 'name' => 'yard uk', 'description' => 'Schritt (UK)'];
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