<?php

namespace AndyFranklin\FaqBundle\Entity;

class Question
{
    private $id;
    private $title;
    private $body;
    private $createdAt;
    private $updatedAt;
    private $ranking;
    private $rating;
    private $published;
    private $slug;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    /**
     * @return mixed
     */
    public function getRanking()
    {
        return $this->ranking;
    }
    /**
     * @param mixed $ranking
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;
    }
    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }
    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }
    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }
    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}