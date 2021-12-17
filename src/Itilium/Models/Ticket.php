<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 17.12.2021
 * Time: 20:55
 */

namespace GitHubClientRest\Itilium\Models;


use Parsedown;

class Ticket
{
    private $label = null;
    private $milestone = null;
    private $to;
    private $createdAt;

    public function setExternalUserId($id)
    {
        $this->external_user_id = $id;
        return $this;
    }


    public function createdAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = trim($subject);
        return $this;
    }

    public function setBody($body)
    {
        $this->body = trim($body);
        return $this;
    }


    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function subject($isTo = false)
    {
        $subject = $this->subject;
        if ($isTo) {
            $to = $this->externalUserId();
            $users = null;
            $tms = getenv('FDK_GITHUB_USERS');
            if (!empty($tms)) {
                $tmp = explode(',', $tms);
                if (!empty($tmp)) {
                    foreach ($tmp as $user) {
                        list($id, $lastmane) = explode(':', $user);
                        $users[$id] = $lastmane;
                    }
                }
            }

            if ($users && array_key_exists($to, $users)) {
                $subject .= ' #' . $users[$to];
            };
            $subject .= ' ' . $this->number($isTo);
        }
        return $subject;
    }

    public function body($email = false)
    {

        $body = '';
        if ($email) {
            $milestone = $this->milestone();
            if (!empty($milestone)) {
                $body .= '<h3>' . $milestone . '</h3><br>';
            }
        }
        $Parsedown = new Parsedown();
        $body .= $Parsedown->text($this->body);
        if (empty($body)) {
            $body = $this->subject();
        }
        if ($email) {
            $label = $this->label();
            if (!empty($label)) {
                $body .= '<hr><br>' . implode(',', $label);
            }

            $url = $this->url();
            $body .= '<br>Ссылка на вопрос: ' . $url;
            $number = $this->number($email);
            if (!empty($number)) {
                $body .= '<br>' . $number;
            }

        }
        return $body;
    }

    public function lables()
    {
        return $this->label;
    }

    public function url()
    {
        return $this->url;
    }

    public function number($email = false)
    {
        $number = $this->number;
        if ($email && !empty($number)) {
            $type = $this->type();
            return 'Github #' . $type . ':' . $number;
        }
        return $number;
    }

    public function label()
    {
        return $this->label;
    }

    public function externalUserId()
    {
        return $this->external_user_id;
    }

    public function toArray($email = false)
    {
        return [
            'external_id' => $this->externalId(),
            'external_user_id' => $this->externalUserId(),
            'repository' => $this->repository(),
            'created_at' => $this->createdAt(),
            'state' => $this->state(),
            'type' => $this->type(),
            'number' => $this->number(),
            'url' => $this->url(),
            'label' => $this->label(),
            'subject' => $this->subject($email),
            'body' => $this->body($email),
        ];
    }

    public function externalId()
    {
        return $this->external_id;
    }

    public function setExternaId($id)
    {
        $this->external_id = $id;
        return $this;
    }

    public function setMilestone($milestone)
    {
        $this->milestone = $milestone;
        return $this;
    }

    public function milestone()
    {
        return $this->milestone;
    }

    public function setType(string $string)
    {
        $this->type = $string;
        return $this;
    }

    public function type()
    {
        return $this->type;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function state()
    {
        return $this->state;
    }

    public function repository()
    {

        return $this->repository;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

}