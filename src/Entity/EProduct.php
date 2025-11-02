<?php

namespace Entity;
use JsonSerializable;


enum ProductType: string {
    case PIZZA = 'PIZZA';
    case BIBITA = 'BIBITA';
}

/**
 * Class EProduct
 */
class EProduct {
    /**
     * @var ?int ID del prodotto
     */
    private ?int $idProduct;

    /**
     * @var string Nome del prodotto
     */
    protected string $name;

    /**
     * Enum che rappresenta il tipo di prodotto.
     */
    protected ProductType $ProductType;

    /**
     * @var float Prezzo del prodotto
     */
    private float $price;

    /**
     * Costructor
     * 
     * @param ?int idProduct
     * @param string name
     * @param ProductType $ProductType
     * @param float price
     */
    public function __construct(?int $idProduct, string $name, ProductType $ProductType, float $price) {
        $this->idProduct=$idProduct;
        $this->name=$name;
        $this->ProductType=$ProductType;
        $this->price=$price;
    }

    /**
     * Ottieni l'ID del prodotto.
     *
     * @return int ID del prodotto
     */
    public function getIdProduct(): ?int {
        return $this->idProduct;
    }

    /**
     * Imposta l'ID del prodotto.
     *
     * @param int   $idProduct  ID del prodotto
     */
    public function setIdProduct(int $idProduct): void {
        $this->idProduct = $idProduct;
    }

    /**
     * Ottieni il nome del prodotto.
     *
     * @return string Nome del prodotto
     */
    public function getNameProduct(): string {
        return $this->name;
    }

    /**
     * Imposta il nome del prodotto.
     *
     * @param string $name  Nome del prodotto
     */
    public function setNameProduct(string $name): void {
        $this->name = $name;
    }

    /**
     * Ottieni il tipo di prodotto
     */
    public function getProductType(): string {
        return $this->ProductType?->value;
    }

    /**
     * Imposta il tipo di prodotto
     * 
     * @param string $type Tipo del prodotto
     */
    public function setProductType(string $ProductType): void {
        $enum=ProductType::tryFrom($ProductType);
        $this->ProductType=$enum;
    }


    /**
     * Ottieni il prezzo del prodotto.
     *
     * @return float Prezzo del prodotto
     */
    public function getPriceProduct(): float {
        return $this->price;
    }

    /**
     * Imposta il prezzo del prodotto.
     *
     * @param float $price  Prezzo del prodotto
     */
    public function setPriceProduct(float $price): void {
        $this->price = $price;
    }

    /**
     * Ottieni le proprietà dell'oggetto come array associativo.
     *
     * @return array Associative array di proprietà dell'oggetto.
     */
    public function jsonSerialize(): array {
        return [
            'idProduct' => $this->idProduct,
            'name'      => $this->name,
            'ProductType' => $this->ProductType->value,
            'price'     => $this->price,
        ];
    }
}