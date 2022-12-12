<?php

declare(strict_types=1);

$foo = [
        "foo" => 1,
];

$bar = [
  "bar" => 1,
];

eval("\$str = \"foo\";");

//

if (count($foo) == 1) {
}

?>
<html></html>
