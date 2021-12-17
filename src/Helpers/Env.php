<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 14.09.2021
 * Time: 10:35
 */

namespace GitHubClientRest\Helpers;

use Symfony\Component\Dotenv\Dotenv;
use Throwable;

class Env
{
    public static function loadFile(string $file): ?string
    {
        try {
            $dotenv = new Dotenv(true);
            $dotenv->loadEnv($file);

            return null;
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }
}