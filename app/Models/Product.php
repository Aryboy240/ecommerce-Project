<?php

//<--
//    Developer: Vatsal Mehta
//    University ID: 220408633
//    Function: Product model with enhanced stock management
//-->

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // Define stock threshold constant
   public const LOW_STOCK_THRESHOLD = 5;
   
   protected $fillable = [
       'name',
       'description',
       'category_id',
       'price',
       'stock_quantity'
   ];

   // Relationship with Category
   public function category()
   {
       return $this->belongsTo(ProductCategory::class, 'category_id');
   }

   // Relationship with Reviews
   public function reviews()
   {
       return $this->hasMany(ProductReview::class);
   }
   
   // Relationship with Order Items
   public function orderItems()
   {
       return $this->hasMany(OrderItem::class);
   }

   // Relationship with Cart Items
   public function cartItems()
   {
       return $this->hasMany(ShoppingCartItem::class);
   }

   // Relationship with Images
   public function images()
   {
       return $this->hasMany(ProductImage::class);
   }
   
   /**
    * Check if the product is in stock
    *
    * @return bool
    */
   public function isInStock()
   {
       return $this->stock_quantity > 0;
   }
   
   /**
    * Check if the product has low stock
    *
    * @return bool
    */
   public function hasLowStock()
   {
       return $this->stock_quantity > 0 && $this->stock_quantity <= self::LOW_STOCK_THRESHOLD;
   }
   
   /**
    * Check if a requested quantity is available
    *
    * @param int $quantity
    * @return bool
    */
   public function hasStock($quantity)
   {
       return $this->stock_quantity >= $quantity;
   }
   
   /**
    * Decrease the stock quantity with validation.
    *
    * @param int $quantity
    * @return bool
    * @throws \InvalidArgumentException
    */
   public function decreaseStock($quantity)
   {
       if ($quantity <= 0) {
           throw new \InvalidArgumentException("Quantity must be positive");
       }
       
       if ($this->stock_quantity < $quantity) {
           return false;
       }
       
       $this->stock_quantity -= $quantity;
       return $this->save();
   }
   
   /**
    * Increment stock quantity
    *
    * @param int $quantity
    * @return bool
    * @throws \InvalidArgumentException
    */
   public function increaseStock($quantity)
   {
       if ($quantity <= 0) {
           throw new \InvalidArgumentException("Quantity must be positive");
       }
       
       $this->stock_quantity += $quantity;
       return $this->save();
   }
   
   /**
    * Get products that are low in stock
    *
    * @return \Illuminate\Database\Eloquent\Collection
    */
   public static function getLowStockProducts()
   {
       return self::where('stock_quantity', '>', 0)
                 ->where('stock_quantity', '<=', self::LOW_STOCK_THRESHOLD)
                 ->get();
   }
   
   /**
    * Get products that are out of stock
    *
    * @return \Illuminate\Database\Eloquent\Collection
    */
   public static function getOutOfStockProducts()
   {
       return self::where('stock_quantity', '<=', 0)->get();
   }
   
   /**
    * Get products by price range
    *
    * @param float $minPrice
    * @param float $maxPrice
    * @return \Illuminate\Database\Eloquent\Collection
    */
   public static function getByPriceRange($minPrice, $maxPrice)
   {
       return self::where('price', '>=', $minPrice)
                 ->where('price', '<=', $maxPrice)
                 ->get();
   }
   
   /**
    * Get the most popular products based on order quantity
    * 
    * @param int $limit
    * @return \Illuminate\Database\Eloquent\Collection
    */
   public static function getMostPopular($limit = 5)
   {
       return self::select('products.*')
           ->selectRaw('SUM(order_items.quantity) as total_sold')
           ->join('order_items', 'products.id', '=', 'order_items.product_id')
           ->join('orders', 'orders.id', '=', 'order_items.order_id')
           ->where('orders.status', '!=', 'cancelled')
           ->groupBy('products.id')
           ->orderByDesc('total_sold')
           ->limit($limit)
           ->get();
   }
}