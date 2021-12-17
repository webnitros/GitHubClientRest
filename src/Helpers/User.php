<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 17.12.2021
 * Time: 20:48
 */

namespace GitHubClientRest\Helpers;


class User
{

    private $org;
    private $token;

    public function __construct($org, $token)
    {
        $this->org = $org;
        $this->token = $token;
    }

    public function org()
    {
        return $this->org;
    }

    public function token()
    {
        return $this->token;
    }

}