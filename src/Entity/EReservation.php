<?php

namespace Entity;

use DateTime;
use JsonSerializable;


enum TimeFrame: string {
    case PRANZO = 'lunch';
    case CENA = 'dinner';
}

/**
 * Class EReservation
 * Represents a reservation in the system.
 */
class EReservation implements JsonSerializable {
    /**
     * IDENTIFIERS
     * @var ?int ReservationId, the Id associated with the reservation
     */
    private ?int $idReservation;

    /**
     * @var ?int UserId, the Id associated with the user
     */
    private ?int $idUser;

    /**
     * @var ?int TableId, the Id associated with the table
     */
    private ?int $idTable;

    /**
     * @var ?int AreaId, the Id associated with the room
     */
    private ?int $idRoom;
    
    /**
     * METADATA
     * @var DateTime creation time of the reservation
     */
    private ?DateTime $creationTime;
    
    /**
     * @var DateTime date of the reservation
     */
    private DateTime $reservationDate;

    /**
     * @var TimeFrame enum, time frame of the reservation
     */
    private ?TimeFrame $timeFrame;

    /**
     * @var string reservation's statement
     */
    private string $state;

    /**
     * @var array array containing the possible states of a reservation
     */
    private const VALID_STATES = ['confirmed', 'approved', 'pending', 'canceled'];

    /**
     * @var float total amount in money of the reservation
     */
    private float $totPrice;

    /**
     * @var int people number in a reservation
     */
    private int $people;

    /**
     * @var string reservtion's comments. Used if the user has any food intolerances to report.
     */
    private string $comment;

    /**
     * @var EExtra[] Array of extras associated with the reservation.
     */
    private ?array $extras = [];

    /**
     * @var string areaName
     */
    private $areaName;

    /**
     * @var string $username
     */
    private $username;

    /**
     * Constructor for the EReservation class with validation checks.
     *
     * @param ?int $idReservation The ID of the reservation.
     * @param ?int $idUser The ID of the user who made the reservation.
     * @param ?int $idTable The ID of the Table reserved.
     * @param ?int $idRoom The ID of the Room reserved.
     * @param ?DateTime $creationTime The creation timestamp of the reservation.
     * @param DateTime $reservationDate The date of the reservation.
     * @param TimeFrame $timeFrame The time frame of a reservation (lunch or dinner)
     * @param string $state The state of the reservation (e.g., confirmed, approved).
     * @param float $totPrice The total price of the reservation.
     * @param int $people people number in a reservation
     * @param string|null $comment any food intolerances to report (can be null)
     * @param ?array array of EExtra object associated to reservation
     */
    public function __construct(
        ?int $idReservation,
        ?int $idUser,
        ?int $idTable,
        ?int $idRoom,
        ?DateTime $creationTime,
        DateTime $reservationDate,
        TimeFrame $timeFrame,
        string $state,
        int $people,
        string $comment,
        ?array $extras = [],
        float $totPrice=0.0
    ) {
        $this->idReservation = $idReservation;
        $this->idUser = $idUser;
        $this->idTable = $idTable;
        $this->idRoom = $idRoom;
        $this->creationTime = $creationTime;
        $this->reservationDate = $reservationDate;
        $this->timeFrame = $timeFrame;
        $this->state = $state;
        $this->people = $people;
        $this->comment = $comment;
        $this->extras = $extras;
        $this->totPrice = $totPrice;
    }

    /**
     * Get the reservation ID.
     *
     * @return ?int The reservation ID.
     */
    public function getIdReservation(): ?int {
        return $this->idReservation;
    }

    /**
     * Set the reservation ID.
     *
     * @param ?int $idReservation The reservation ID.
     */
    public function setIdReservation(?int $idReservation): void {
        $this->idReservation = $idReservation;
    }

    /**
     * Get the user ID associated with the reservation.
     *
     * @return ?int The user ID.
     */
    public function getIdUser(): ?int {
        return $this->idUser;
    }

    /**
     * Set the user ID associated with the reservation.
     *
     * @param ?int $idUser The user ID.
     */
    public function setIdUser(?int $idUser): void {
        $this->idUser = $idUser;
    }

    /**
     * Get the Table ID associated with the reservation.
     *
     * @return ?int The Table ID.
     */
    public function getIdTable(): ?int {
        return $this->idTable;
    }

    /**
     * Set the Table ID associated with the reservation.
     *
     * @param ?int The Table ID.
     */
    public function setIdTable(?int $idTable): void {
        $this->idTable = $idTable;
    }

    /**
     * Get the Room ID associated with the reservation.
     *
     * @return ?int The Room ID.
     */
    public function getIdRoom(): ?int {
        return $this->idRoom;
    }

    /**
     * Set the Room ID associated with the reservation.
     *
     * @param ?int The Room ID.
     */
    public function setIdRoom(?int $idRoom): void {
        $this->idRoom = $idRoom;
    }

    /**
     * Get the creation time of the reservation.
     *
     * @return string The creation time.
     */
    public function getCreationTime(): string {
        return $this->creationTime->format('Y-m-d H:i:s');
    }

    /**
     * Set the creation time of the reservation.
     *
     * @param DateTime $creationTime The creation time.
     */
    public function setCreationTime(DateTime $creationTime): void {
        $this->creationTime = $creationTime;
    }

    /**
     * Get the reservation date.
     *
     * @return string The reservation date.
     */
    public function getReservationDate(): string {
        return $this->reservationDate->format('Y-m-d H:i:s');
    }

    /**
     * Set the reservation date.
     *
     * @param DateTime $reservationDate The reservation date.
     */
    public function setReservationDate(DateTime $reservationDate): void {
        $this->reservationDate = $reservationDate;
    }
    
    /**
     * Get the reservation time frame.
     *
     * @return string The reservation time frame.
     */
    public function getReservationTimeFrame(): string {
        return $this->timeFrame?->value;
    }

    /**
     * Set the reservation date.
     *
     * @param DateTime $reservationDate The reservation date.
     */
    public function setReservationTimeFrame(string $timeFrame): void {
        $enum=TimeFrame::tryFrom($timeFrame);
        $this->timeFrame=$enum;
    }

    /**
     * Get the state of the reservation.
     *
     * @return string The reservation state.
     */
    public function getState(): string {
        return $this->state;
    }

    /**
     * Set the state of the reservation.
     *
     * @param string $state The reservation state.
     */
    public function setState(string $state): void {
        $this->state = $state;
    }

    /**
     * Get the total price of the reservation.
     *
     * @return float The total price.
     */
    public function getTotPrice(): float {
        return $this->totPrice;
    }

    /**
     * Set the total price of the reservation.
     *
     * @param float $totPrice The total price.
     */
    public function setTotPrice(float $totPrice): void {
        $this->totPrice = $totPrice;
    }

    /**
     * Calculates the total topay if there are any extras in the Reservation.
     * 
     * @return float, the total amount for the extras.
     */
    public function calculateTotPriceFromExtras(): float {
        $total = 0.0;
        foreach ($this->extras as $extra) {
            $total += $extra->getPriceExtra();
        }
        return $total;
    }

    /**
     * Get the people number of a reservation
     * 
     * @return int the number
     */
    public function getPeople(): int {
        return $this->people;
    }

    /**
     * Set's the people number of a reservation
     * 
     * @param int $people the number
     */
    public function setPeople(int $people): void {
            $this->people = $people;
    }

    /**
     * Get the comment of a reservation
     * 
     * @return string any food intollerance
     */
    public function getComment(): string {
        return $this->comment;
    }

    /**
     * Set's the comment for a reservation
     * 
     * @param string the comment
     */
    public function setComment(string $comment): void {
        $this->comment = $comment;
    }

    /**
     * Get the extras of a reservation
     * 
     * @return array the extras for the reservation
     */
    public function getExtras(): array {
        return $this->extras;
    }

    /**
     * Set's the extras for a reservation
     * 
     * @param array the extras
     */
    public function setExtras(array $extras): void {
        $this->extras = $extras;
    }

    /**
     * Used to get Area name
     */
    public function getAreaName(): string {
        return $this->areaName;
    }

    /**
     * Used to set Area name View Friendly
     */
    public function setAreaName(string $areaName): void {
        $this->areaName=$areaName;
    }

    /**
     * Used to get Username of a reservation
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Used to set Username View Friendly
     */
    public function setUsername(string $username): void {
        $this->username=$username;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array {
        return [
            'idReservation' => $this->idReservation,
            'idUser' => $this->idUser,
            'idTable' => $this->idTable,
            'idRoom' => $this->idRoom,
            'creationTime' => $this->creationTime?->format('Y-m-d H:i:s'),
            'reservationDate' => $this->reservationDate->format('Y-m-d H:i:s'),
            'timeFrame'=> $this->timeFrame?->value,
            'state' => $this->state,
            'totPrice' => $this->totPrice,
            'people' => $this->people,
            'comment' => $this->comment,
            'extras' => array_map(fn($e) => $e->jsonSerialize(), $this->extras)
        ];
    }
}
