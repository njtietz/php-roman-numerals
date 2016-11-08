<?php

require_once('class.converter.php');
$converter = new converter();
$converter->fontChange("*", 1);
$converter->fontChange("$", 5);
echo $converter->convert(rand(1, 1000)); // L*$ instead of LIV
