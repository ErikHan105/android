package com.softexpert.ujs.davidhood.utils;

import java.util.concurrent.TimeUnit;

public class Utils {
    public static String getFormattedTimeStr(int miliseconds) {
        String str = "";
        str = String.format("%02d:%02d:%02d", TimeUnit.MILLISECONDS.toHours(miliseconds), TimeUnit.MILLISECONDS.toMinutes(miliseconds),
                TimeUnit.MILLISECONDS.toSeconds(miliseconds) - TimeUnit.MINUTES.toSeconds(TimeUnit.MILLISECONDS.toMinutes(miliseconds)));
        return str;
    }
}
