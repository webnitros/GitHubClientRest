<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 17.12.2021
 * Time: 20:44
 */

namespace GitHubClientRest\Commands;


use GitHubClientRest\Helpers\User;

class Issues
{

    public static function getList(\GitHubClientRest\Github\Issues $Handler, $params = null)
    {
        $Client = $Handler
            ->addParam('filter', 'created')
            ->addParam('sort', 'created')
            ->addParam('direction', 'asc');


        if (!empty($params)) {
            foreach ($params as $k => $param) {
                $Client->addParam($k, $param);
            }
        }
        $issues = $Client->getList();
        $arrays = [];
        foreach ($issues as $issue) {
            // Для кого создать наряды
            $user = $issue->user;
            $label = [];
            if (!empty($issue->labels)) {
                foreach ($issue->labels as $la) {
                    $label[] = $la->name;
                }
            }

            $id = $issue->id;
            $data = [
                'external_id' => $id,
                'external_user_id' => $user->id,
                'created_at' => $issue->created_at,
                'repository' => $issue->repository->name,
                'number' => $issue->number,
                'label' => $label,
                'subject' => $issue->title,
                'body' => $issue->body,
                'state' => $issue->state,
                'milestone' => !empty($issue->milestone) ? $issue->milestone->title : '',
                'url' => $issue->html_url,
                'comments' => $issue->comments,
            ];

            $arrays[] = $data;
        }
        return $arrays;
    }
}