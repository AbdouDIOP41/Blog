<?php
namespace App\Model;
use \DateTime;

class Comment{
    private $id;
    private $pseudo;
    private $title;
    private $content;
    private $created_at;

    /**
     * Get the value of id
     */ 
    public function getId() : ?int 
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(): ? string
    {
        return $this->title;
    }

    /**
     * Get the value of slug
     */ 
    public function getContent() : ? string
    {
        return $this->content;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo() : ? string
    {
        return $this->pseudo;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at() : DateTime
    {
        return new DateTime($this->created_at);
    }
}