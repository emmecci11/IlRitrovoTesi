<?php

namespace Entity;
use JsonSerializable;

/**
 * Class EArea
 * Represents the user with their main properties.
 */
class EArea implements JsonSerializable {
    /**
     * METADATA
     * @var string area's name
     */
    private string $areaName;

    /**
     * @var int max guests in a specific area
     */
    private int $maxGuests;

    /**
     * Constructor for the EUser class with validation checks.
     *
     * @param string $name area's name
     * @param int $maxGuests max number of guests (can't be negative).
     */
    public function __construct(string $areaName, int $maxGuests) {
        $this->areaName = $areaName;
        $this->maxGuests = $maxGuests;
    }

    /**
     * Gets area's name.
     *
     * @return string area's name.
     */
    public function getAreaName(): string {
        return $this->areaName;
    }

    /**
     * Sets area's name.
     *
     * @param string $name area's name.
     */
    public function setAreaName(string $name): void {
        $this->areaName = $name;
    }

    /**
     * Gets max number of guests
     *
     * @return int max guests
     */
    public function getMaxGuests(): int {
        return $this->maxGuests;
    }

    /**
     * Sets max number of guests.
     *
     * @param int $maxGuests max guests.
     */
    public function setMaxGuests(int $maxGuests): void {
        $this->maxGuests = $maxGuests;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties..
     */
    public function jsonSerialize(): array {
        return [
            'name' => $this->areaName,
            'maxGuests' => $this->maxGuests,
        ];
    }
}
