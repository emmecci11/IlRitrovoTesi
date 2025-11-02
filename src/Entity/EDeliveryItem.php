<?php

namespace Entity;

use JsonSerializable;

/**
 * Class EDeliveryItem
 */
class EDeliveryItem implements JsonSerializable {
    /**
     * @var int ID dell'item di consegna
     */
    private ?int $idDeliveryItem;

    /**
     * @var int ID della prenotazione di consegna
     */
    protected int $idDeliveryReservation;

    /**
     * @var int ID del prodotto (relazionato con EProduct)
     */
    private int $idProduct;

    /**
     * @var float Quantità dell'item di consegna
     */
    private int $quantity;

    /**
     * @var float Totale dell'item di consegna
     */
    protected float $subtotal;

    /**
     * Costruttore.
     *
     * @param ?int   $idDeliveryItem  ID dell'item di consegna
     * @param int   $idDeliveryReservation  ID della prenotazione di consegna
     * @param int   $idProduct      ID del prodotto (relazionato con EProduct)
     * @param int $quantity       Quantità dell'item di consegna
     * @param float $subtotal       Totale dell'item di consegna
     */
    public function __construct(?int $idDeliveryItem, int $idDeliveryReservation, int $idProduct, int $quantity, float $subtotal) {
        $this->setIdDeliveryItem($idDeliveryItem);
        $this->setIdDeliveryReservation($idDeliveryReservation);
        $this->setIdProduct($idProduct);
        $this->setQuantity($quantity);
        $this->setSubtotal($subtotal);
    }

    /**
     * Ottieni l'ID dell'item di consegna.
     *
     * @return int ID dell'item di consegna
     */
    public function getIdDeliveryItem(): ?int {
        return $this->idDeliveryItem;
    }

    /**
     * Imposta l'ID dell'item di consegna.
     *
     * @param int   $idDeliveryItem  ID dell'item di consegna
     */
    public function setIdDeliveryItem(?int $idDeliveryItem): void {
        $this->idDeliveryItem = $idDeliveryItem;
    }

    /**
     * Ottieni l'ID della prenotazione di consegna.
     *
     * @return int ID della prenotazione di consegna
     */
    public function getIdDeliveryReservation(): int {
        return $this->idDeliveryReservation;
    }

    /**
     * Imposta l'ID della prenotazione di consegna.
     *
     * @param int   $idDeliveryReservation  ID della prenotazione di consegna
     */
    public function setIdDeliveryReservation(int $idDeliveryReservation): void {
        $this->idDeliveryReservation = $idDeliveryReservation;
    }

    /**
     * Ottieni l'ID del prodotto (relazionato con EProduct).
     *
     * @return int ID del prodotto
     */
    public function getIdProduct(): int {
        return $this->idProduct;
    }

    /**
     * Imposta l'ID del prodotto (relazionato con EProduct).
     *
     * @param int   $idProduct  ID del prodotto
     */
    public function setIdProduct(int $idProduct): void {
        $this->idProduct = $idProduct;
    }

    /**
     * Ottieni la quantità dell'item di consegna.
     *
     * @return float Quantità dell'item di consegna
     */
    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * Imposta la quantità dell'item di consegna.
     *
     * @param float $quantity  Quantità dell'item di consegna
     */
    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    /**
     * Ottieni il totale dell'item di consegna.
     *
     * @return float Totale dell'item di consegna
     */
    public function getSubtotal(): float {
        return $this->subtotal;
    }

    /**
     * Imposta il totale dell'item di consegna.
     *
     * @param float $subtotal  Totale dell'item di consegna
     */
    public function setSubtotal(float $subtotal): void {
        $this->subtotal = $subtotal;
    }

    /**
     * Ottieni le proprietà dell'oggetto come array associativo.
     *
     * @return array Associative array di proprietà dell'oggetto.
     */
    public function jsonSerialize(): array {
        return [
            'idDeliveryItem' => $this->idDeliveryItem,
            'idDeliveryReservation' => $this->idDeliveryReservation,
            'idProduct'      => $this->idProduct,
            'quantity'       => $this->quantity,
            'subtotal'       => $this->subtotal,
        ];
    }
}