<?php

namespace Entity;
use DateTime;
use JsonSerializable;

/**
 * @var StatoPagamento Limited set of values that StatoPagamento can assume
 */
enum StatoPagamento: string {
    case COMPLETATO = 'completed';
    case IN_ATTESA = 'pending';
    case FALLITO = 'failed';
    case ANNULLATO = 'canceled';
}

/**
 * Class EPayment
 * Represents a Payment with their main properties.
 */
class EPayment implements JsonSerializable {
    /**
     * IDENTIFIERS
     * @var ?int Payment Id, the Id of the payment
     */
    private ?int $idPayment;

    /**
     * @var int the Id of a specific credit card
     */
    private int $idCreditCard;

    /**
     * @var int the Id of a specific reservation
     */
    private int $idReservation;

    /**
     * METADATA
     * @var float the amount of the payment
     */
    private float $total;

    /**
     * @var DateTime the creation time of the payment
     */
    private DateTime $creationTime;

    /**
     * @var StatoPagamento actual state of the payment
     */
    private StatoPagamento $state;
    
    /**
     * Constructor for the EPayment class with validation checks.
     *
     * @param int|null $idPayment The ID of the payment, or null if not yet created.
     * @param int $idCreditCard The ID of the associated credit card.
     * @param int $idReservation The ID of the associated reservation.
     * @param float $total The total amount to be paid.
     * @param DateTime $creationTime The creation time of the payment.
     * @param StatoPagamento $state The state of the payment (e.g., completed, pending).
     */
    public function __construct(
        ?int $idPayment,
        int $idCreditCard,
        int $idReservation,
        float $total,
        DateTime $creationTime,
        StatoPagamento $state
    ) {
        $this->idPayment = $idPayment;
        $this->idCreditCard = $idCreditCard;
        $this->idReservation = $idReservation;
        $this->total = $total;
        $this->creationTime = $creationTime;
        $this->state = $state;
    }

    /**
     * Get the ID of the payment.
     *
     * @return int|null The ID of the payment, or null if not set.
     */
    public function getIdPayment(): ?int {
        return $this->idPayment;
    }

    /**
     * Set the ID of the payment.
     *
     * @param int|null $idPayment The ID of the payment, or null to unset.
     */
    public function setIdPayment(?int $idPayment): void {
        $this->idPayment = $idPayment;
    }

    /**
     * Get the ID of the associated credit card.
     *
     * @return int|null The ID of the associated credit card, or null if not set.
     */
    public function getIdCreditCard(): ?int {
        return $this->idCreditCard;
    }

    /**
     * Set the ID of the associated credit card.
     *
     * @param int|null $idCreditCard The ID of the associated credit card, or null to unset.
     */
    public function setIdCreditCard(?int $idCreditCard): void {
        $this->idCreditCard = $idCreditCard;
    }

    /**
     * Get the ID of the associated reservation.
     *
     * @return int The ID of the associated reservation.
     */
    public function getIdReservation(): int {
        return $this->idReservation;
    }

    /**
     * Set the ID of the associated reservation.
     *
     * @param int $idReservation The ID of the associated reservation.
     */
    public function setIdReservation(int $idReservation): void {
        $this->idReservation = $idReservation;
    }

    /**
     * Get the total amount to be paid.
     *
     * @return float The total amount.
     */
    public function getTotal(): float {
        return $this->total;
    }

    /**
     * Set the total amount to be paid.
     *
     * @param float $total The total amount.
     */
    public function setTotal(float $total): void {
        $this->total = $total;
    }

    /**
     * Get the creation time of the payment.
     *
     * @return string The creation time.
     */
    public function getCreationTime(): string {
        return $this->creationTime->format('Y-m-d H:i:s');
    }

    /**
     * Set the creation time of the payment.
     */
    public function setCreationTime(DateTime $creationTime): void {
        $this->creationTime = $creationTime;
    }

    /**
     * Get the payment state.
     *
     * @return StatoPagamento The payment state.
     */
    public function getState(): string {
        return $this->state->value;
    }

    /**
     * Set the payment state.
     *
     * @param string $state The payment state to set.
     */
    public function setState(string $state): void {
        $enum=StatoPagamento::tryFrom($state);
        $this->state=$enum;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array {
        return [
            'idPayment' => $this->idPayment,
            'idCreditCard' => $this->idCreditCard,
            'idReservation' => $this->idReservation,
            'total' => $this->total,
            'creationTime' => $this->creationTime->format('Y-m-d H:i:s'),
            'state' => $this->state->value,
        ];
    }
}
