<?php

namespace Entity;
use DateTime;
use JsonSerializable;

/**
 * Class EReview
 * Represents a review entity with properties.
 */
class EReview implements JsonSerializable {
    /** 
     * IDENTIFIERS
     * @var int|null $idUser The ID of the user who made the review 
     */
    private ?int $idUser;

    /** 
     * @var int|null $idReview The ID of the review 
     */
    private ?int $idReview;

    /**
     * METADATA 
     * @var int $stars The rating given in the review, between 1 and 5 
     */
    private int $stars;

    /**
     * @var string $body The text body of the review 
     */
    private string $body;

    /** 
     * @var DateTime $creationTime The creation timestamp of the review 
     */
    private DateTime $creationTime;

    /** 
     * @var int|null $idReply The ID of the reply, initially it's null, can be changed wit setIdReply 
     */
    private ?int $idReply;

    /**
     * @var null|string $username, the username associated with a review, View friendly
     */
    private ?string $username = null;

    /**
     * @var EReply $reply, the reply associated with a review, View friendly
     */
    private ?EReply $reply=null;

    /**
     * Constructor for the EReview class with validation checks.
     * 
     * @param int|null $idUser The ID of the user who made the review.
     * @param int|null $idReview The ID of the review.
     * @param int $stars The rating given in the review, between 1 and 5.
     * @param string $body The text body of the review.
     * @param DateTime $creationTime The creation timestamp of the review.
     * @param int|null $idReply The ID of the reply if exists
     */
    public function __construct(
        ?int $idUser,
        ?int $idReview,
        int $stars,
        string $body,
        DateTime $creationTime,
        ?int $idReply = null
    ) {
        $this->idUser = $idUser;
        $this->idReview = $idReview;
        $this->stars = $stars;
        $this->body = $body;
        $this->creationTime = $creationTime;
        $this->idReply = $idReply;
    }

    /**
     * Gets the user ID associated with the review.
     *
     * @return int|null The ID of the user who made the review.
     */
    public function getIdUser(): ?int {
        return $this->idUser;
    }

    /**
     * Sets the user ID associated with the review.
     *
     * @param int|null $idUser The ID of the user who made the review.
     */
    public function setIdUser(?int $idUser): void {
        $this->idUser = $idUser;
    }

    /**
     * Gets the ID of the review.
     *
     * @return int|null The ID of the review.
     */
    public function getIdReview(): ?int {
        return $this->idReview;
    }

    /**
     * Sets the ID of the review.
     *
     * @param int|null $idReview The ID of the review.
     */
    public function setIdReview(?int $idReview): void {
        $this->idReview = $idReview;
    }

    /**
     * Gets the ID of the reply if exists
     * 
     * @return int|null The ID of the reply if exists
     */
    public function getIdReply(): ?int {
        return $this->idReply;
    }

    /**
     * Sets the ID of the reply
     * 
     * @param int $idReply The ID of the reply 
     */
    public function setIdReply(?int $idReply): void {
        $this->idReply=$idReply;
    }

    /**
     * Gets the star rating of the review.
     *
     * @return int The star rating of the review.
     */
    public function getStars(): int {
        return $this->stars;
    }

    /**
     * Sets the star rating of the review.
     *
     * @param int $stars The star rating of the review, between 1 and 5.
     */
    public function setStars(int $stars): void {
        $this->stars = $stars;
    }

    /**
     * Gets the text body of the review.
     *
     * @return string The text body of the review.
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * Sets the text body of the review.
     *
     * @param string $body The text body of the review.
     */
    public function setBody(string $body): void {
        $this->body = $body;
    }

    /**
     * Gets the creation timestamp of the review.
     *
     * @return string The creation timestamp of the review.
     */
    public function getCreationTime(): string {
        return $this->creationTime->format('Y-m-d H:i:s');
    }

    /**
     * Sets the creation timestamp of the review.
     *
     * @param DateTime $creationTime The creation timestamp of the review.
     */
    public function setCreationTime(DateTime $creationTime): void {
        $this->creationTime = $creationTime;
    }

    /**
     * Gets the Username associated with a review, View friendly
     * 
     * @return null|string
     */
    public function getUsername(): ?string {
        return $this->username;
    }

    /**
     * Sets the Username associated with a review, View friendly
     * 
     * @param string $username
     */
    public function setUsername(string $username): void {
        $this->username=$username;
    }

    /**
     * Gets the reply associated with a review
     * 
     * @return null|EReply
     */
    public function getReply(): ?EReply {
        return $this->reply;
    }

    /**
     * Sets the reply associated with a review
     * 
     * @param null|EReply
     */
    public function setReply(?EReply $reply): void {
        $this->reply=$reply;
    }
    
    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array {
        return [
            'idUser' => $this->idUser,
            'idReview' => $this->idReview,
            'idReply' => $this->idReply,
            'stars' => $this->stars,
            'body' => $this->body,
            'creationTime' => $this->creationTime->format('Y-m-d H:i:s'),
        ];
    }
}