<?php

if (!function_exists('chromium_write_log')) {
    function chromium_write_log($log)
    {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

function findValue(array $array, array $terms, $get_all = false)
{
    $term_count = sizeof($terms);  // cache the element count of $terms
    $results = []; // establish empty array for print_r if no matches are found.
    foreach ($array as $subarray) {
        if (sizeof(array_intersect_assoc($subarray, $terms)) == $term_count) { // qualifying subarray
            if (!$get_all) {
                return $subarray;  // end loop and return the single subarray
            } else {
                $results[] = $subarray;
            }
        }
    }
    return $results;
}
