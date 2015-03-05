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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comment;

    /**
     * @var \G6\FriendsBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add comment
     *
     * @param \G6\FriendsBundle\Entity\Comment $comment
     * @return Post
     */
    public function addComment(\G6\FriendsBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \G6\FriendsBundle\Entity\Comment $comment
     */
    public function removeComment(\G6\FriendsBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \G6\FriendsBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\G6\FriendsBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \G6\FriendsBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
