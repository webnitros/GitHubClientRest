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

    public function subject()
    {
        return $this->subject;
    }

    public function body()
    {

        return $this->body;
    }

    public function lables()
    {
        return $this->label;
    }

    public function url()
    {
        return $this->url;
    }

    public function number()
    {
        return $this->number;

    }

    public function label()
    {
        return $this->label;
    }

    public function externalUserId()
    {
        return $this->external_user_id;
    }

    public function toArray()
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
            'subject' => $this->subject(),
            'body' => $this->body(),
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