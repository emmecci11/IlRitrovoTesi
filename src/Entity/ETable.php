<?php

namespace Entity;
require_once 'EArea.php';
/**
 * Class ETable
 * Represents the table with their main properties.
 */
 class ETable extends EArea {
    /**
     * IDENTIFIERS
     * @var int idTable
     */
    private ?int $idTable;

    /**
     * Constructor for the EUser class with validation checks.
     *
     * @param int $idTable table's ID 
     */
    public function __construct(?int $idTable, string $areaName, int $maxGuests) {
        parent::__construct($areaName, $maxGuests);
        $this->idTable=$idTable;
    }

    /**
     * Get's the table's ID
     * 
     * @return ?int table's ID
     */
    public function getIdTable(): ?int {
        return $this->idTable;
    }

    /**
     * Sets Table's ID.
     *
     * @param ?int table's ID.
     */
    public function setIdTable(?int $idTable): void {
        $this->idTable = $idTable;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties..
     */
    public function jsonSerialize(): array {
        return [
            "idTable" => $this->idTable,
            'name' => $this->getareaName(),
            'maxGuests' => $this->getMaxGuests()
        ];
    }
 }