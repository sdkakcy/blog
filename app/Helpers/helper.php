<?php

use Carbon\Carbon;

if (!function_exists('formatDatetime')) {
    function formatDatetime($datetime, $format = 'j M Y, H:i')
    {
        return Carbon::parse($datetime)->translatedFormat($format);
    }
}
