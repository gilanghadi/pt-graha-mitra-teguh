<?php

use Carbon\Carbon;

if (!function_exists('formatAge')) {
  function formatAge($date)
  {
    $date = Carbon::parse($date);
    $convertedAge = $date->age;

    return $convertedAge . ' Year ';
  }
}
