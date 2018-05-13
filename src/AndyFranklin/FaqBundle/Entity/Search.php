<?php

namespace AndyFranklin\FaqBundle\Entity;

class Search
{
    private $id;
    private $query;
    private $count;
    private $createdAt;
    private $updatedAt;
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
    public function getQuery()
    {
        return $this->query;
    }
    /**
     * @param mixed $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }
    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }
    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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