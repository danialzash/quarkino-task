<?php

namespace App\Models;

use App\Exceptions\OrderExceptions\NotEnoughQuantityException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'cost',
        'available_quantity',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->update([
            'name' => $name,
        ]);

        return $this;
    }

    public function setBrand(?string $brand): self
    {
        $this->update([
            'brand' => $brand,
        ]);

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand ?? null;
    }

    public function setCost(int $cost): self
    {
        $this->update([
            'cost' => $cost,
        ]);

        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @throws NotEnoughQuantityException
     */
    public function setAvailableQuantity(int $quantity): self
    {
        if ($quantity < 0) {
            throw new NotEnoughQuantityException('Not Enough Quantity');
        } else {
            $this->update([
                'available_quantity' => $quantity,
            ]);

            return $this;
        }
    }

    /**
     * @return int
     */
    public function getAvailableQuantity(): int
    {
        return $this->available_quantity;
    }

    /**
     * Decrease number of bought products from available quantity
     * @param int $boughtCount
     * @return $this
     */
    public function decreaseQuantity(int $boughtCount): self
    {
        $this->decrement('available_quantity', $boughtCount);

        return $this;
    }

    public function increaseQuantity(int $addedQuantity): self
    {
        $this->increment('available_quantity', $addedQuantity);

        return $this;
    }

}
