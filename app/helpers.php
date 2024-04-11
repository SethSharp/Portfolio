<?php

/**
 * Gets the current EB environment config values
 */
if (! function_exists('getCurrentEBEnvironmentConfig')) {
    function getCurrentEBEnvironmentConfig()
    {
        $currentEnv = config('environment.current');

        return config('environment')[$currentEnv];
    }
}
