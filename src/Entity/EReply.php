<?php

namespace Entity;
use DateTime;
use JsonSerializable;

/**
 * Class EReply
 * Rapresents a Replay associated an a Review
 */
class EReply implements JsonSerializable {
    /**
     * IDENTIFIERS 
     * @var ?int idReply; the unique identifier of a reply
     */
    private ?int $idReply;

    /**
     * METADATA
     * @var DateTime the creation timestamp of the reply
     */
    private DateTime $dateReply;

    /**
     * @var string the body of the reply
     */
    private String $body;

    /**
     * Constructor for the EReply class with validation checks.
     * 
     * @param int the unique identifier of a reply
     * @param DateTime date of reply
     * @param string the body of the reply
     */

     public function __construct(?int $idReply, DateTime $dateReply, string $body) {
        $this->idReply=$idReply;
        $this->dateReply=$dateReply;
        $this->body=$body;
     }

    /**
     * Gets the unique identifier for the reply.
     *
     * @return int return the id of the reply 
     */
    public function getIdReply(): ?int {
        return $this->idReply;
    }

    /**
     * Sets the unique identifier for the reply.
     *
     * @param int $idReply
     */
    public function setIdReply(?int $idReply): void {
        $this->idReply=$idReply;
    }

    /**
     * Gets the creation timestamp of the reply.
     *
     * @return string The creation timestamp of the reply.
     */
    public function getDateReply(): string {
        return $this->dateReply->format('Y-m-d H:i:s');
    }

    /**
     * Sets the creation timestamp of the reply.
     *
     * @param DateTime $creationTime The creation timestamp of the reply.
     */
    public function setDateReply(DateTime $dateReply): void {
        $this->dateReply = $dateReply;
    }

    /**
     * Gets the body of the reply
     * 
     * @return string body of the reply
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * Sets the body of the reply and check if the body form is empty
     * 
     * @param string $body the text body of the reply. Can't be an empty string or null
     */
    public function setBody(string $body): void {
        $this->body=$body;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array {
        return [
            'idReply' => $this->idReply,
            'dateReply' => $this->dateReply->format('Y-m-d H:i:s'),
            'body' => $this->body,
        ];
    }
}