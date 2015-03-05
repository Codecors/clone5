<?php

namespace G6\FriendsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $commentId;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $likes;

    /**
     * @var \DateTime
     */
    private $commentDate;

    /**
     * @var \G6\FriendsBundle\Entity\User
     */
    private $user;

    /**
     * @var \G6\FriendsBundle\Entity\Post
     */
    private $post;


    /**
     * Get commentId
     *
     * @return integer 
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     * @return Comment
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
     * Set commentDate
     *
     * @param \DateTime $commentDate
     * @return Comment
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;

        return $this;
    }

    /**
     * Get commentDate
     *
     * @return \DateTime 
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * Set user
     *
     * @param \G6\FriendsBundle\Entity\User $user
     * @return Comment
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

    /**
     * Set post
     *
     * @param \G6\FriendsBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\G6\FriendsBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \G6\FriendsBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}
