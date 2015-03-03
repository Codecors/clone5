<?php

namespace G6\FriendsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $postId;

    /**
     * @var string
     */
    private $postContent;

    /**
     * @var \DateTime
     */
    private $postDate;

    /**
     * @var integer
     */
    private $likes;

    /**
     * @var \G6\FriendsBundle\Entity\User
     */
    private $username;


    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set postContent
     *
     * @param string $postContent
     * @return Post
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Get postContent
     *
     * @return string 
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return Post
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     * @return Post
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return integer 
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set username
     *
     * @param \G6\FriendsBundle\Entity\User $username
     * @return Post
     */
    public function setUsername(\G6\FriendsBundle\Entity\User $username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return \G6\FriendsBundle\Entity\User 
     */
    public function getUsername()
    {
        return $this->username;
    }
}
