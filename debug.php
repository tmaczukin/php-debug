<?php

function d()
{
    $decorate = PHP_SAPI !== 'cli';

    if ($decorate === true) {
        $where = xdebug_get_function_stack();
        $last = $where[count($where) - 3]['function'] === 'ddie' ? 3 : 1;
        $call = $where[count($where) - $last];
        $url= "{$call['file']}:{$call['line']}";

        echo "<div style=\"border: 1px solid #ddd; padding: 5px; margin: 10px auto;\">";
        echo "<a href= \"netbeans://{$url}\" style=\"font-size: 11px; color: #999;padding: 5px; ".
             "margin-bottom: 5px; display: block;\"><span style=\"font-weight: bold;\">";
        echo "DEBUG:</span> {$url}";
        echo "</a>";
    }

    foreach (func_get_args() as $arg) {
        if ($decorate === true) {
            echo "<hr style=\"border-top: 1px dashed #ddd; margin: 5px 0;\"/>";
        }

        var_dump($arg);
    }

    if ($decorate === true) {
        echo "</div>";
    }
}

function ddie()
{
    call_user_func_array('d', func_get_args());
    die;
}
