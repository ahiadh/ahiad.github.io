<?php
define("LOWER", 0x1);
define("UPPER", 0x2);
define("NUMBER", 0x4);
define("SYMBOL", 0x8);
class PWGenerator 
{
    public function randomPassword($length = 4, $settings = LOWER | UPPER | NUMBER | SYMBOL): string
    {
        $this -> validateLength($settings, $length);
        $password = [...$this -> requiredChars($settings), ...$this -> optionalChars($settings, $length)];
        shuffle($password);
        return join($password);
    }
    
    private function validateLength($settings, $length)
    {
        if ($this -> requiredCharCount($settings) > $length) {
            $errorText = "Length must be at least " . $this -> requiredCharCount($settings) . " chars long";
            throw new Error($errorText);
        }
    }
    
    private function requiredChars($settings): array
    {
        $randomOrdinals = [];
        for ($setting = 1; $setting <= $settings; $setting *= 2)
            if ($settings & $setting) $randomOrdinals[] = $this -> randomOrdinal($this -> getOrdinals($setting));
        return array_map("chr", $randomOrdinals);
    }
    
    private function optionalChars($settings, $length): array
    {
        $allowedOrdinals = $this -> allowedOrdinals($settings);
        $randomOrdinals = [];
        for ($charIndex = $this -> requiredCharCount($settings); $charIndex < $length; $charIndex++)
            $randomOrdinals[] = $this -> randomOrdinal($allowedOrdinals);
        return array_map("chr", $randomOrdinals);
    }
    
    private function requiredCharCount($settings): int
    {
        return substr_count(decbin($settings), "1");
    }
    
    private function allowedOrdinals($settings): array
    {
        $allowedOrdinals = [];
        for ($setting = 1; $setting <= $settings; $setting *= 2)
            if ($settings & $setting) $allowedOrdinals = [...$allowedOrdinals, ...$this -> getOrdinals($setting)];
        return $allowedOrdinals;
    }
    
    private function getOrdinals($requestedIndex): array
    {
        static $ordinalMap = [
            LOWER => [[97, 122]],
            UPPER => [[65, 90]],
            NUMBER => [[48, 57]],
            SYMBOL => [[33, 47], [58, 64], [91, 96], [123, 126]]
        ];
        return $ordinalMap[$requestedIndex];
    }
    
    private function randomOrdinal($ordinalRanges): int
    {
        $ordinals = array_map([$this,"randomFromRange"], $ordinalRanges);
        $ordinalsCount = count($ordinals) - 1;
        $ordinalsRange = [0, $ordinalsCount];
        return $ordinals[$this -> randomFromRange($ordinalsRange)];
    }
    
    private function randomFromRange($range): int
    {
        return random_int($range[0], $range[1]);
    }
}
 
?>
