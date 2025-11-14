
<?php

namespace Entity;

use JsonSerializable;
use DateTime;

/**
 * Class EDeliveryItem
 */
class EDeliveryItem implements JsonSerializable {
    /**
     * @var ?int ID dell'item di consegna
     */
    private ?int $idDeliveryItem;

    /**
     * @var EDeliveryReservation La prenotazione di consegna associata all'item.
     */
    protected EDeliveryReservation $reservation;

    /**
     * @var EProduct Il prodotto associato all'item.
     */
    protected EProduct $product;

    /**
     * @var int Quantità dell'item nella prenotazione.
     */
    private int $quantity;

    /**
     * @var float Subtotale dell'item (price * quantity).
     */
    private float $subtotal;

    /**
     * Costruttore.
     *
     * @param ?int   $idDeliveryItem  ID dell'item di consegna
     * @param EDeliveryReservation $reservation La prenotazione di consegna associata all'item
     * @param EProduct        $product       Il prodotto associato all'item
     * @param int          $quantity      Quantità dell'item nella prenotazione
     */
    public function __construct(
        ?int $idDeliveryItem,
        EDeliveryReservation $reservation,
        EProduct $product,
        int $quantity
    ) {
        $this->setIdDeliveryItem($idDeliveryItem);
        $this->setReservation($reservation);
        $this->setProduct($product);
        $this->setQuantity($quantity);

        // Calcola il subtotal automaticamente
        $this->subtotal = $product->getPriceProduct() * $quantity;
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
     * Ottieni la prenotazione di consegna associata all'item.
     *
     * @return EDeliveryReservation La prenotazione di consegna associata all'item
     */
    public function getReservation(): EDeliveryReservation {
        return $this->reservation;
    }

    /**
     * Imposta la prenotazione di consegna associata all'item.
     *
     * @param EDeliveryReservation $reservation La prenotazione di consegna da associare all'item
     */
    public function setReservation(EDeliveryReservation $reservation): void {
        $this->reservation = $reservation;
    }

    /**
     * Ottieni il prodotto associato all'item.
     *
     * @return EProduct Il prodotto associato all'item
     */
    public function getProduct(): EProduct {
        return $this->product;
    }

    /**
     * Imposta il prodotto associato all'item.
     *
     * @param EProduct $product Il prodotto da associare all'item
     */
    public function setProduct(EProduct $product): void {
        $this->product = $product;
    }

    /**
     * Ottieni la quantità dell'item nella prenotazione.
     *
     * @return int Quantità dell'item nella prenotazione
     */
    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * Imposta la quantità dell'item nella prenotazione.
     *
     * @param int $quantity La quantità da impostare
     */
    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;

        // Ricalcola il subtotal automaticamente
        $this->subtotal = $this->product->getPriceProduct() * $quantity;
    }

    /**
     * Ottieni il subtotale dell'item (price * quantity).
     *
     * @return float Subtotale dell'item
     */
    public function getSubtotal(): float {
        return $this->subtotal;
    }

    /**
     * Imposta il subtotale dell'item (price * quantity).
     *
     * @param float $subtotal Il subtotale da impostare
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
            'reservation'   => $this->getReservation()->getIdDeliveryReservation(),
            'product'       => $this->getProduct()->jsonSerialize(),
            'quantity'      => $this->quantity,
            'subtotal'      => $this->subtotal,
        ];
    }
}