<?php

/**
 * Used to help find how you get to a particular point in code.
 * 
 * @param bool $completeTrace
 *
 * @return string
 */
function getCallingFunctionName($completeTrace = false)
{
    $trace = debug_backtrace();

    if ($completeTrace) {
        $str = '';

        foreach ($trace as $caller) {
            // Skip trace output on the current tracing function
            if ($caller['function'] == __FUNCTION__) {
                continue;
            }

            #echo "Caller:<pre>" . print_r($caller, true) . "</pre>\n"; die();
            $str .= " -- Called by {$caller['function']}";

            if (isset($caller['line'])) {
                $str .= " on line {$caller['line']}";
            }

            if (isset($caller['class'])) {
                $str .= " From Class {$caller['class']}\n";
            }
        }
    }
    else {
        $caller = $trace[3];
        $str = "Called by {$caller['function']}";

        if (isset($caller['line'])) {
            $str .= " on line {$caller['line']}";
        }

        if (isset($caller['class'])) {
            $str .= " From Class {$caller['class']}";
        }
    }

    return "$str\n";
}
