<?php

class ExceptionHelper {

    public static function registerHandlers() {
        set_error_handler(["ExceptionHelper", "catchError"], E_ERROR | E_PARSE);
        set_exception_handler(["ExceptionHelper", "catchException"]);
        register_shutdown_function(["ExceptionHelper", "catchError"]);
    }

    public static function catchException($exception) {

    }

    public static function catchError() {

    }

}
