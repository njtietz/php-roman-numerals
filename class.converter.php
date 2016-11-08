<?php

class converter {

	private $roman_numerals = array(
		"M" => 1000,
		"D" => 500,
		"C" => 100,
		"L" => 50,
		"X" => 10,
		"V" => 5,
		"I" => 1
	);

	private $special_numerals = array(
		"CM" => 900,
		"CD" => 400,
		"XC" => 90,
		"XL" => 40,
		"IX" => 9,
		"IV" => 4,
	);

	function fontChange($char = "I", $value = 1) { // default values just in case
		$char = strtoupper($char);
		if (in_array($value, $this->roman_numerals)) {
			$key = array_search($value, $this->roman_numerals);
			$temp_array = array($char => $value);
			$this->roman_numerals = array_merge($temp_array, $this->roman_numerals);
			unset($this->roman_numerals[$key]);
		}
		$this->rebuildSpeicalNumerals();
	}

	function rebuildSpeicalNumerals(){
		$this->special_numerals = array(
			array_search(100, $this->roman_numerals) . array_search(1000, $this->roman_numerals) => 900,
			array_search(100, $this->roman_numerals) . array_search(500, $this->roman_numerals) => 400,
			array_search(10, $this->roman_numerals) . array_search(100, $this->roman_numerals) => 90,
			array_search(10, $this->roman_numerals) . array_search(50, $this->roman_numerals) => 40,
			array_search(1, $this->roman_numerals) . array_search(10, $this->roman_numerals) => 9,
			array_search(1, $this->roman_numerals) . array_search(5, $this->roman_numerals) => 4,
		);
	}

	function convert ($int) {
		$all_numerals = array_merge($this->roman_numerals, $this->special_numerals);
		arsort($all_numerals);
		$output = "";
		while ($int > 0) {
			foreach ($all_numerals as $char => $value) {
				if ($int >= $value) {
					$int -= $value;
					$output .= $char;
					break;
				}
			}
		}
		return $output;
	}

}
