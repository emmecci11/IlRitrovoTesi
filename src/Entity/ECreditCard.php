<?php

namespace Entity;
use DateTime;
use JsonSerializable;

/**
 * Class ECreditCard
 * Represents a credit card entity with relevant details.
 */
class ECreditCard implements JsonSerializable {
    /**
     * IDENTIFIER
     * @var int|null The unique identifier for the credit card, managed by the database.
     */
    private ?int $idCreditCard;

    /**
     * @var int|null The ID of the user associated with the credit card (optional).
     */
    private ?int $idUser;

    /**
     * METADATA
     * @var string The credit card number.
     */
    private string $number;

    /**
     * @var DateTime The expiration date of the credit card.
     */
    private DateTime $expiration;

    /**
     * @var int The CVV (Card Verification Value) of the credit card.
     */
    private int $cvv;

    /**
     * @var string The type of the credit card (e.g., Visa, MasterCard).
     */
    private string $type;

    /**
     * PERSONAL_INFORMATION
     * @var string The name of the cardholder.
     */
    private string $holder;

    /**
     * Constructor for the ECreditCard class with validation checks.
     *
     * @param ?int|null $idCreditCard The unique identifier for the credit card (optional).
     * @param ?int|null $idUser The ID of the user associated with the credit card (optional).
     * @param string $number The credit card number.
     * @param DateTime $expiration The expiration date of the credit card.
     * @param int $cvv The CVV of the credit card.
     * @param string $type The type of the credit card (e.g., Visa, MasterCard).
     * @param string $holder The cardholder's name.
     */
    public function __construct(
        ?int $idCreditCard,
        string $holder,
        string $number,
        int $cvv,
        DateTime $expiration,
        string $type,
        ?int $idUser
    ) {
        $this->idCreditCard = $idCreditCard;
        $this->holder = $holder;
        $this->number = $number;
        $this->cvv = $cvv;
        $this->expiration = $expiration;
        $this->type = $type;
        $this->idUser = $idUser;
    }

    /**
     * Gets the unique identifier for the credit card.
     *
     * @return int|null The ID of the credit card or null if not set.
     */
    public function getIdCreditCard(): ?int {
        return $this->idCreditCard;
    }

    /**
     * Sets the unique identifier for the credit card.
     *
     * @param int|null $idCreditCard The ID to set.
     */
    public function setIdCreditCard(?int $idCreditCard): void {
        $this->idCreditCard = $idCreditCard;
    }

    /**
     * Gets the ID of the user associated with the credit card.
     *
     * @return int|null The user ID or null if not set.
     */
    public function getIdUser(): ?int {
        return $this->idUser;
    }

    /**
     * Sets the ID of the user associated with the credit card.
     *
     * @param int|null $idUser The user ID to set.
     */
    public function setIdUser(?int $idUser): void {
        $this->idUser = $idUser;
    }

    /**
     * Gets the credit card number.
     *
     * @return string The credit card number.
     */
    public function getNumber(): string {
        return $this->number;
    }

    /**
     * Sets the credit card number.
     *
     * @param string $number The credit card number to set.
     */
    public function setNumber(string $number): void {
        $this->number = $number;
    }

    /**
     * Gets the expiration date of the credit card.
     *
     * @return string The expiration date. (string because PHP can't print DateTime object)
     */
    public function getExpiration(): string {
        return $this->expiration->format('Y-m-d');
    }

    /**
     * Sets the expiration date of the credit card.
     *
     * @param DateTime $expiration The expiration date to set.
     */
    public function setExpiration(DateTime $expiration): void {
        $this->expiration = $expiration;
    }

    /**
     * Gets the CVV of the credit card.
     *
     * @return int The CVV of the credit card.
     */
    public function getCvv(): int {
        return $this->cvv;
    }

    /**
     * Sets the CVV of the credit card.
     *
     * @param int $cvv The CVV to set.
     */
    public function setCvv(int $cvv): void {
        $this->cvv = $cvv;
    }

    /**
     * Gets the type of the credit card (e.g., Visa, MasterCard).
     *
     * @return string The type of the credit card.
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * Sets the type of the credit card.
     *
     * @param string $type The type of the credit card (e.g., Visa, MasterCard).
     */
    public function setType(string $type): void {
        $this->type = $type;
    }

    /**
     * Gets the cardholder's name.
     *
     * @return string The cardholder's name.
     */
    public function getHolder(): string {
        return $this->holder;
    }

    /**
     * Sets the cardholder's name.
     *
     * @param string $holder The cardholder's name to set.
     */
    public function setHolder(string $holder): void {
        $this->holder = $holder;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array {
        return [
            'idCreditCard' => $this->idCreditCard,
            'idUser' => $this->idUser,
            'number' => $this->number,
            'expiration' => $this->expiration->format('Y-m-d'),
            'cvv' => $this->cvv,
            'type' => $this->type,
            'holder' => $this->holder,
        ];
    }
}
