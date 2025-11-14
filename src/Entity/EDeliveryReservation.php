
<?php

namespace Entity;

use JsonSerializable;
use DateTime;

/**
 * Class EDeliveryReservation
 */
class EDeliveryReservation implements JsonSerializable {
    /**
     * @var ?int ID della prenotazione di consegna
     */
    private ?int $idDeliveryReservation;

    /**
     * @var EUser L'utente associato alla prenotazione di consegna.
     */
    protected EUser $user;

    /**
     * @var array Prodotti nella prenotazione di consegna.
     */
    private array $items = [];

    /**
     * @var string Numero di telefono dell utente
     */
    protected string $userPhone;

    /**
     * @var string Indirizzo dell utente
     */
    protected string $userAddress;

    /**
     * @var int N. indirizzo dell utente (in base a un sistema di codice postale)
     */
    protected int $userNumberAddress;

    /**
     * @var DateTime Ora desiderata per la consegna
     */
    private DateTime $wishedTime;

    /**
     * Costruttore.
     *
     * @param ?int   $idDeliveryReservation  ID della prenotazione di consegna
     * @param EUser    $user            L'utente associato alla prenotazione di consegna
     * @param array     $items           Prodotti nella prenotazione di consegna
     * @param string   $userPhone      Numero di telefono dell utente
     * @param string   $userAddress    Indirizzo dell utente
     * @param int      $userNumberAddress  N. indirizzo dell utente (in base a un sistema di codice postale)
     * @param DateTime $wishedTime     Ora desiderata per la consegna
     */
    public function __construct(
        ?int $idDeliveryReservation,
        EUser $user,
        string $userPhone,
        string $userAddress,
        int $userNumberAddress,
        DateTime $wishedTime,
        array $items = []
    ) {
        $this->setIdDeliveryReservation($idDeliveryReservation);
        $this->setUser($user);
        $this->setUserPhone($userPhone);
        $this->setUserAddress($userAddress);
        $this->setUserNumberAddress($userNumberAddress);
        $this->setWishedTime($wishedTime);
        $this->setItems($items);
    }

    /**
     * Ottieni l'ID della prenotazione di consegna.
     *
     * @return int ID della prenotazione di consegna
     */
    public function getIdDeliveryReservation(): ?int {
        return $this->idDeliveryReservation;
    }

    /**
     * Imposta l'ID della prenotazione di consegna.
     *
     * @param int   $idDeliveryReservation  ID della prenotazione di consegna
     */
    public function setIdDeliveryReservation(?int $idDeliveryReservation): void {
        $this->idDeliveryReservation = $idDeliveryReservation;
    }

    /**
     * Ottieni l'utente associato alla prenotazione di consegna.
     *
     * @return EUser L'utente associato alla prenotazione di consegna
     */
    public function getUser(): EUser {
        return $this->user;
    }

    /**
     * Imposta l'utente associato alla prenotazione di consegna.
     *
     * @param EUser $user L'utente da associare alla prenotazione di consegna
     */
    public function setUser(EUser $user): void {
        $this->user = $user;
    }

    /**
     * Ottieni i prodotti nella prenotazione di consegna.
     *
     * @return array Prodotti nella prenotazione di consegna
     */
    public function getItems(): array {
        return $this->items;
    }

    /**
     * Imposta i prodotti nella prenotazione di consegna.
     *
     * @param array $items Array dei prodotti da associare alla prenotazione di consegna
     */
    public function setItems(array $items): void {
        $this->items = $items;
    }

    /**
     * Aggiungi un prodotto alla prenotazione di consegna.
     *
     * @param EDeliveryItem $item Il prodotto da aggiungere alla prenotazione di consegna
     */
    public function addItem(EDeliveryItem $item): void {
        $this->items[] = $item;
    }

    /**
     * Rimuovi un prodotto dalla prenotazione di consegna.
     *
     * @param EDeliveryItem $item Il prodotto da rimuovere dalla prenotazione di consegna
     */
    public function removeItem(EDeliveryItem $item): void {
        $this->items = array_filter($this->items, fn ($i) => $i !== $item);
    }

    /**
     * Ottieni il numero di telefono dell utente.
     *
     * @return string Numero di telefono dell utente
     */
    public function getUserPhone(): string {
        return $this->userPhone;
    }

    /**
     * Imposta il numero di telefono dell utente.
     *
     * @param string $userPhone  Numero di telefono dell utente
     */
    public function setUserPhone(string $userPhone): void {
        $this->userPhone = $userPhone;
    }

    /**
     * Ottieni l'indirizzo dell utente.
     *
     * @return string Indirizzo dell utente
     */
    public function getUserAddress(): string {
        return $this->userAddress;
    }

    /**
     * Imposta l'indirizzo dell utente.
     *
     * @param string $userAddress  Indirizzo dell utente
     */
    public function setUserAddress(string $userAddress): void {
        $this->userAddress = $userAddress;
    }

    /**
     * Ottieni il N. indirizzo dell utente (in base a un sistema di codice postale).
     *
     * @return int N. indirizzo dell utente
     */
    public function getUserNumberAddress(): int {
        return $this->userNumberAddress;
    }

    /**
     * Imposta il N. indirizzo dell utente (in base a un sistema di codice postale).
     *
     * @param int   $userNumberAddress  N. indirizzo dell utente
     */
    public function setUserNumberAddress(int $userNumberAddress): void {
        $this->userNumberAddress = $userNumberAddress;
    }

    /**
     * Ottieni l'ora desiderata per la consegna.
     *
     * @return DateTime Ora desiderata per la consegna
     */
    public function getWishedTime(): DateTime {
        return $this->wishedTime;
    }

    /**
     * Imposta l'ora desiderata per la consegna.
     *
     * @param DateTime $wishedTime  Ora desiderata per la consegna
     */
    public function setWishedTime(DateTime $wishedTime): void {
        $this->wishedTime = $wishedTime;
    }

    /**
     * Ottieni le proprietà dell'oggetto come array associativo.
     *
     * @return array Associative array di proprietà dell'oggetto.
     */
    public function jsonSerialize(): array {
        return [
            'idDeliveryReservation' => $this->idDeliveryReservation,
            'user'             => $this->getUser()->jsonSerialize(),
            'items'           => array_map(fn ($item) => $item->jsonSerialize(), $this->getItems()),
            'userPhone'      => $this->userPhone,
            'userAddress'    => $this->userAddress,
            'userNumberAddress' => $this->userNumberAddress,
            'wishedTime'     => $this->wishedTime,
        ];
    }
}