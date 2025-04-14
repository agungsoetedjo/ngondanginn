<?php

use Carbon\Carbon;

if (! function_exists('timeAgo')) {
    function timeAgo($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
