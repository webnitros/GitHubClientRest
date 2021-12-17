<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 17.12.2021
 * Time: 20:36
 */

namespace GitHubClientRest\Itilium;


use GitHubClientRest\Helpers\RequestClient;

class Ticket
{
    public static function create(\GitHubClientRest\Itilium\Models\Ticket $Ticket)
    {
        // Тут короче через почту создаем новый тикет
        $Client = new RequestClient();
        $data = [
            'api_key' => getenv('API_KEY'),
            'email' => [
                'subject' => $Ticket->subject(true),
                'body' => $Ticket->body(true),
            ],
            'data' => $Ticket->toArray()
        ];


        try {
            $response = $Client->sendPost(getenv('API_URL') . 'ticket/create', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
            //   $response = $Client->getMsg();
        }

        $res = $Client->toArray();
        return !empty($res['success']);
    }

}