<?php

namespace App;

trait NumberFormattingTrait
{
    protected function formatNumber($num)
    {
        $suffixes = ["", "K", "M", "B", "T"];
        $suffixIndex = 0;

        while ($num >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $num /= 1000;
            $suffixIndex++;
        }

        return round($num, 1) . $suffixes[$suffixIndex];
    }
}
