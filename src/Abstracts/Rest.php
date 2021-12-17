<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 17.12.2021
 * Time: 16:01
 */

namespace GitHubClientRest\Abstracts;


use Exception;
use GitHubClientRest\Helpers\User;
use Milo\Github\Api;
use Milo\Github\Helpers;
use Milo\Github\OAuth\Token;
use Parsedown;

abstract class Rest
{
    /* @var Token $token */
    private $token;
    /* @var User $user */
    private $user;

    public function __construct(User $user)
    {
        $this->setUser($user);
    }

    protected function user()
    {
        return $this->user;
    }


    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }


    public function setRepo($name)
    {
        $this->repo = $name;
        return $this;
    }

    public function repo()
    {
        return $this->repo;
    }

    public function setToken()
    {

        return $this;
    }


    public function token()
    {
        if (is_null($this->token)) {
            $this->token = new Token($this->user()->token());
        }
        return $this->token;
    }


    private $params = null;

    public function addParam($field, $value)
    {
        $this->params[$field] = $value;
        return $this;
    }

    protected function request($uri, $method = 'get', $content = null)
    {
        $uri = $this->uri($uri);
        $api = new Api();
        try {
            $api->setToken($this->token());
            if (is_array($this->params)) {
                $api->setDefaultParameters($this->params);
            }
            // $response = $api->get('/issues');

            switch ($method) {
                case 'get':
                    $response = $api->get($uri);
                    break;
                case 'patch':
                    $response = $api->patch($uri, $content);
                    break;
                case 'put':
                    $response = $api->put($uri, $content);
                    break;
                case 'post':
                    $response = $api->post($uri, $content);
                    break;
                default:
                    break;
            }
            $this->params = null;


            if ($response->getCode() !== 200 && $response->getCode() !== 201) {
                return [
                    'success' => false,
                    'code' => $response->getCode(),
                    'data' => Helpers::jsonDecode($response->getContent()),
                ];
            }
            return $api->decode($response);
        } catch (Exception $e) {
            return Helpers::jsonDecode($response->getContent());
        }

    }

    /**
     * Вернет список вопрос учтенных в коммите
     * @param $body
     * @return array
     */
    public function issues($body)
    {
        $body = ' ' . $body;
        preg_match_all('/#(\d+)/', $body, $found);

        $ararys = [];
        if (!empty($found[1])) {
            foreach ($found[1] as $item) {
                $ararys[] = $item;
            }
        }
        return $ararys;
    }


    public function uri($uri)
    {
        $org = $this->user()->org();
        $repa = $this->repo();
        $uri = str_ireplace('{owner}', $org, $uri);
        $uri = str_ireplace('{repo}', $repa, $uri);
        return $uri;
    }

}