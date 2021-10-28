<?php namespace Models;

class Career{

    private $careerId;
    private $title;
    private $description;
    private $active = true;

  

    public function getCareerId()
    {
        return $this->careerId;
    }

    public function setCareerId($careerId)
    {
        $this->careerId = $careerId;

        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function __tostring(){
        return "<br>Title: ".$this->title.
               "<br>Description: ".$this->description.
               "<br>Active: ".$this->active;
    }
}
