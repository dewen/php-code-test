<?php

$ssn = '574321673';
function s($i) {
  return [rand(100000000, 999999999), base64_encode($i)];
}
var_dump(s($ssn));