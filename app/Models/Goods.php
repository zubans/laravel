<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    /**
     * @param string $tableField
     * @param string $condition
     * @param string|null $columnName
     * @return mixed
     */
    public function getValuesWithCondition(string $tableField, string $condition, string $columnName = null)
    {
        return $this->where($tableField, $condition)->get($columnName)->first();
    }

    public function isRecordExist(string $tableField, string $condition): bool
    {
        return $this->where($tableField, $condition)->count() !== 0;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $weight
     */
    public function setWeight(string $weight): void
    {
        $this->weight = $weight ?? 0;
    }

    /**
     * @param string $value
     */
    public function setQuantityMoscow(string $value): void
    {
        $this->quantity_moscow = $value ?? 0;
    }

    /**
     * @param string $value
     */
    public function setQuantitySpeterburg(string $value): void
    {
        $this->quantity_speterburg = $value ?? 0;
    }

    /**
     * @param string $value
     */
    public function setQuantitySamara(string $value): void
    {
        $this->quantity_samara = $value ?? 0;
    }

    /**
     * @return string
     */
    public function getQuantitySamara(): string
    {
        return $this->quantity_samara;
    }

    /**
     * @param string $value
     */
    public function setQuantityChelyabinsk(string $value): void
    {
        $this->quantity_chelyabinsk = $value;
    }

    /**
     * @return string
     */
    public function getQuantityChelyabinsk(): string
    {
        return $this->quantity_chelyabinsk;
    }

    /**
     * @param int $value
     */
    public function setPriceMoscow(int $value): void
    {
        $this->price_moscow = $value;
    }

    /**
     * @return int
     */
    public function getPriceMoscow(): int
    {
        return $this->price_moscow;
    }

    /**
     * @param int $value
     */
    public function setPriceSpeterburg(int $value): void
    {
        $this->price_speterburg = $value;
    }

    /**
     * @return int
     */
    public function getPriceSpeterburg(): int
    {
        return $this->price_speterburg;
    }

    /**
     * @param int $value
     */
    public function setPriceSamara(int $value): void
    {
        $this->price_samara = $value;
    }

    /**
     * @return int
     */
    public function getPriceSamara(): int
    {
        return $this->price_samara;
    }

    /**
     * @param int $value
     */
    public function setPriceChelyabinsk(int $value): void
    {
        $this->price_chelyabinsk = $value;
    }

    /**
     * @return int
     */
    public function getPriceChelyabinsk(): int
    {
        return $this->price_chelyabinsk;
    }

    /**
     * @param string $value
     */
    public function setUsage(string $value): void
    {
        $this->usage = $value;
    }

    /**
     * @return string
     */
    public function getUsage(): string
    {
        return $this->usage;
    }
}
