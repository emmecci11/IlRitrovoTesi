<?php

namespace Entity;
require_once 'EArea.php';

/**
 * Class ERoom
 * Represents a room entity that extends the EPArea class.
 */
class ERoom extends EArea
{
    /**
     * @var ?int Room ID, can be null if not assigned.
     */
    private ?int $idRoom;

    /**
     * @var float Tax (price) for reserve the room.
     */
    private float $tax;

    /**
     * EUser constructor.
     *
     * @param ?int $idRoom Room ID, can be null.
     * @param string $areaName room's name
     * @param int $maxGuests max number of guests (can't be negative).
     * @param float $tax price for reserve the room
     */
    public function __construct(
        ?int $idRoom,
        string $areaName,
        int $maxGuests,
        float $tax
    ) {
        parent::__construct( $areaName, $maxGuests);
        $this->idRoom = $idRoom;
        $this->tax = $tax;
    }

    /**
     * Gets the room ID.
     *
     * @return ?int Room ID or null if not assigned.
     */
    public function getIdRoom(): ?int
    {
        return $this->idRoom;
    }

    /**
     * Sets the room ID.
     *
     * @param ?int $idRoom Room ID to set, can be null.
     */
    public function setIdRoom(?int $idRoom): void
    {
        $this->idRoom = $idRoom;
    }

    /**
     * Get the price of the tax.
     *
     * @return float The price of the tax.
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * Set th price of the tax.
     *
     * @param float $tax The price of the tax.
     */
    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

    /**
     * Serializes the object for JSON encoding.
     *
     * @return array The JSON-serializable data.
     */
    public function jsonSerialize(): array
    {
        return [
            'idRoom' => $this->idRoom,
            'name' => $this->getAreaName(),
            'maxGuests' => $this->getMaxGuests(),
            'tax' => $this->getTax(),
        ];
    }
}