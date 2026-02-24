<?php
// in protected/components/MyConsoleApplication.php

class MyConsoleApplication extends CConsoleApplication {

    public function displayError($code, $message, $file, $line)
    {
        echo "PHP Error[$code]: $message\n";
        echo "in file $file at line $line\n";

        if (YII_DEBUG) debug_print_backtrace();
    }
}