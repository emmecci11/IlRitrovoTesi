<?php

namespace Foundation;

use Entity\EProduct;
use Entity\ProductType;
use Exception;

/**
 * Class FProduct to manage products in the database.
 */
class FProduct {

    /**
     * Name of the table associated with the product entity in the database.
     */
    protected const TABLE_NAME = 'product';

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_NAME_FIELD="The 'name' field is required and must be a string.";
    protected const ERR_DUPLICATE_PRODUCT='A product with this name already exists.';
    protected const ERR_NUMERIC_PRICE="The 'price' field is required and must be numeric.";
    protected const ERR_NEGATIVE_PRICE="The 'price' field must be a non-negative value.";
    protected const ERR_MISSING_ID= "Unable to retrieve the ID of the inserted product";
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the product.';
    protected const ERR_RETRIVE_PRODUCT='Failed to retrive the inserted product.';
    protected const ERR_PRODUCT_NOT_FOUND = 'The product does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_ALL_PRODUCT = 'Error loading all products: ';

    /**
     * Create a product in the database.
     *
     * @param EProduct $product The EProduct object to store.
     * @return bool True if the operation was successful, otherwise False.
     * @throws Exception If there is an error during the create operation.
     */
    public function create(EProduct $product): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($product);
        self::validateProductData($data);
        try {
            //Product insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Retrive the last inserted ID
            $createdId=$db->getLastInsertedId();
            if ($createdId==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            //Retrive the inserted product by number to get the assigned idProduct
            $storedProduct = $db->load(self::TABLE_NAME, 'idProduct', $createdId);
            if ($storedProduct === null) {
                throw new Exception(self::ERR_RETRIVE_PRODUCT);
            }
            //Assign the retrieved ID to the object
            $product->setIdProduct((int)$createdId);
            //Return the id associated with this product
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a specific product from the database by IDproduct.
     *
     * @param int $idProduct The ID of the Product to read.
     * @return EProduct|null The Product object if found, null otherwise.
     */
    public function read(int $idProduct): ?EProduct {
        $db=FDatabase::getInstance();
        $result=$db->load(self::TABLE_NAME, 'idProduct', $idProduct);
        return $result ? $this->arrayToEntity($result): null;
    }

    /**
     * Reads a product from the database by name.
     *
     * @param string $nameProduct The name of the product to search for.
     * @return EProduct|null The Product object if found, null otherwise.
     */
    public static function readByName(string $nameProduct): ?EProduct {
        $db = FDatabase::getInstance();
        $result = $db->load(self::TABLE_NAME, 'name', $nameProduct);
        if (!$result) {
            return null;
        }
        // Temporary instance
        $tmp = new self();
        return $tmp->arrayToEntity($result);
    }

    /**
     * Updates a product in the database.
     *
     * @param EProduct $product The Product object to update.
     * @return bool True if the update was successful, false otherwise.
     * @throws Exception If there is an error during the update operation.
     */
    public function update(EProduct $product): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($product->getIdProduct())) {
            throw new Exception(self::ERR_PRODUCT_NOT_FOUND);
        }
        $data = [
            'name' => $product->getNameProduct(),
            'ProductType' => $product->getProductType(),
            'price' => $product->getPriceProduct(),
        ];
        self::validateProductData($data, $product->getIdProduct());
        if (!$db->update(self::TABLE_NAME, $data, ['idProduct' => $product->getIdProduct()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a product from the database.
     *
     * @param int $idProduct The ID of the product.
     * @return bool True if the product was successfully deleted, otherwise False.
     */
    public static function delete(int $idProduct): bool {
        $db=FDatabase::getInstance();
        return $db->delete(self::TABLE_NAME, ['idProduct' => $idProduct]);
    }

    /**
     * Retrieves all products.
     *
     * @return EProduct[] An array of all Product objects.
     * @throws Exception If there is an error during the retrieval operation.
     */
    public function readAll(): array {
        try {
            $db = FDatabase::getInstance(); // Get the singleton instance
            $results = $db->loadMultiples(self::TABLE_NAME); // Use the loadMultiples method to load the data
            return array_filter(array_map([$this, 'arrayToEntity'], $results));
        } catch (Exception $e) {
            error_log(self::ERR_ALL_PRODUCT . $e->getMessage());
            return [];
        }
    }

    /**
     * Checks if a product exists in the database.
     *
     * @param int $idProduct The ID of the product.
     * @return bool True if the product exists, otherwise False.
     */
    public static function exists(string $idProduct): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idProduct' => $idProduct]);
    }

    /**
     * Validates the data for creating or updating a product.
     *
     * @param array $data The data array containing 'name' and 'price'.
     * @throws Exception If required fields are missing or invalid.
     */
    public static function validateProductData(array $data, ?int $currentId=null): void {
        // Validate 'name'
        if (empty($data['name']) || !is_string($data['name'])) {
            throw new Exception(self::ERR_NAME_FIELD);
        }
        //Checks for duplicates (exlude current ID if editing)
        $existing = self::readByName($data['name']);
        if ($existing !== null && $existing->getIdProduct()!==$currentId) {
            throw new Exception(self::ERR_DUPLICATE_PRODUCT);
        }
        // Validate 'price'
        if (!isset($data['price']) || !is_numeric($data['price'])) {
            throw new Exception(self::ERR_NUMERIC_PRICE);
        }
        //Check for negative prices
        if ($data['price'] < 0) {
            throw new Exception(self::ERR_NEGATIVE_PRICE);
        }
    }

    /**
     * Creates an instance of EProduct from the given data.
     *
     * @param array $data The data array containing product information.
     * @return EProduct The created Product object.
     * @throws Exception If required fields are missing.
     */
    public function arrayToEntity(array $data): EProduct {
        $requiredFields = ['idProduct', 'name', 'ProductType', 'price'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new EProduct(
            isset($data['idProduct']) ? (int)$data['idProduct'] : null,
            $data['name'],
            ProductType::from($data['ProductType']),
            $data['price']
        );
    }

    /**
     * Converts a Product object into an associative array for the database.
     *
     * @param EProduct $product The product object to convert.
     * @return array The product data as an array.
     */
    public function entityToArray(EProduct $product): array {
        return [
            'idProduct' => $product->getIdProduct(),
            'name' => $product->getNameProduct(),
            'ProductType' => $product->getProductType(),
            'price' => $product->getPriceProduct()
        ];
    }
}