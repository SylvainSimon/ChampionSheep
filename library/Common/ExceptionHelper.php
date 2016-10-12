<?php

class ExceptionHelper {

    public static function registerHandlers() {
        set_error_handler(["ExceptionHelper", "catchError"], E_ERROR | E_PARSE);
        set_exception_handler(["ExceptionHelper", "catchException"]);
        register_shutdown_function(["ExceptionHelper", "catchError"]);
    }

    public static function catchException($exception) {
        var_dump($exception);
    }

    public static function catchError() {

        $error = error_get_last();
        if ($error !== null) {
            if ($error["type"] == 1) {
                var_dump($error);
            }
        }
    }

}
