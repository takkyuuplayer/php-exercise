<?php

declare(ticks=1);

// tick イベントごとにコールされる関数
function tick_handler()
{
    echo "tick_handler() called\n";
}

register_tick_function('tick_handler');
$a = 1;
