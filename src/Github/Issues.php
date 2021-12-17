<?php
/**
 * Получение списка вопросов
 * @link https://docs.github.com/en/rest/reference/issues
 */

namespace GitHubClientRest\Github;


use GitHubClientRest\Abstracts\Rest;

class Issues extends Rest
{
    public function getList()
    {
        return $this->request('orgs/{owner}/issues');
    }

    public function open($id)
    {
        return $this->update($id, [
            'state' => 'open'
        ]);
    }

    public function closed($id)
    {
        return $this->update($id, [
            'state' => 'closed'
        ]);
    }


    public function get($id)
    {
        return $this->request("repos/{owner}/{repo}/issues/{$id}");
    }

    public function update($id, array $content)
    {
        return $this->request("repos/{owner}/{repo}/issues/{$id}", 'patch', $content);
    }


    public function create(string $title, string $body)
    {
        $data = [
            'title' => $title,
            'body' => $body,
        ];
        return $this->request("/repos/{owner}/{repo}/issues", 'post', $data);
    }

}