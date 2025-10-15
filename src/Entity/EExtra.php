<?php

namespace Entity;
use JsonSerializable;

/**
 * Class EExtra
 * Represents an extra service offered at the location.
 */
class EExtra implements JsonSerializable {
    /**
     * @var int|null The unique identifier for the extra service (managed by the database).
     */
    private ?int $idExtra;

    /**
     * @var string The name of the extra service.
     */
    private string $nameExtra;

    /**
     * @var float The price of the extra service.
     */
    private float $priceExtra;

    /**
     * Constructor for the EUser class with validation checks.
     *
     * @param int|null $idExtra The unique identifier for the extra service (managed by the database).
     * @param string $nameExtra The name of the extra service.
     * @param float $priceExtra The price of the extra service.
     */
    public function __construct(?int $idExtra, string $nameExtra, float $priceExtra) {
        $this->idExtra = $idExtra;
        $this->nameExtra = $nameExtra;
        $this->priceExtra = $priceExtra;
    }

    /**
     * Get the unique identifier for the extra service.
     *
     * @return int|null The unique identifier, or null if not set.
     */
    public function getIdExtra(): ?int {
        return $this->idExtra;
    }

    /**
     * Set the unique identifier for the extra service.
     *
     * @param int|null $idExtra The ID to set.
     */
    public function setIdExtra(?int $idExtra): void {
        $this->idExtra = $idExtra;
    }

    /**
     * Get the name of the extra service.
     *
     * @return string The name of the extra service.
     */
    public function getNameExtra(): string {
        return $this->nameExtra;
    }

    /**
     * Set the name of the extra service.
     *
     * @param string $name The name to set.
     */
    public function setNameExtra(string $name): void {
        $this->nameExtra = $name;
    }

    /**
     * Get the price of the extra service.
     *
     * @return float The price of the extra service in cents.
     */
    public function getPriceExtra(): float {
        return $this->priceExtra;
    }

    /**
     * Set the price of the extra service.
     *
     * @param float $price The price to set.
     */
    public function setPriceExtra(float $price): void {
        $this->priceExtra = $price;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array
    {
        return [
            'idExtra' => $this->idExtra,
            'name' => $this->nameExtra,
            'price' => $this->priceExtra,
        ];
    }
}