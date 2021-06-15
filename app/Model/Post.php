<?php

namespace App\Model;

use App\Helpers\Text;
use \DateTime;

class Post {
    private $id;
    private $title;
    private $slug;
    private $content;
    private $created_at;
    private $comments = [];

    public function getExcerpt() : String {
        if($this->content === null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of content
     */ 
    public function getContent() : string
    {
        return nl2br(htmlentities($this->content));
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at() : DateTime
    {
        return new DateTime($this->created_at);
    }


    /**
     * Get the value of categories
     */ 
    public function getComments()
    {
        return $this->comments;
    }


    /**
     * Get the value of slug
     */ 
    public function getSlug() : ?string
    {
        return $this->slug;
    }
}