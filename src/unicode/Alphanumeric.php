<?php

namespace Valid\Unicode;

class Alphanumeric {
  function createUrlFragmentMB($title) {
    // Replace anything non-alphanumeric or non-underscore with hyphen.
    $title = mb_ereg_replace('[\W]+', '-', trim($title));
    // Remove any non-alphanumeric or non-hyphen characters. 
    $title = mb_ereg_replace('[^\w\d\-]', '', $title);
    return mb_strtolower(trim($title, "-"));
  }
}
