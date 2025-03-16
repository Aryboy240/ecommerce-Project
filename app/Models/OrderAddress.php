<?php

//<--
//    Developer: Vatsal Mehta
//    University ID: 220408633
//    Function: OrderAddress model for storing shipping and billing information
//-->

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'order_id',
       'type',
       'first_name',
       'last_name',
       'email',
       'phone',
       'address_line1',
       'address_line2',
       'city',
       'state',
       'postal_code',
       'country'
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array
    */
   protected $casts = [
       'order_id' => 'integer',
   ];

   /**
    * Validation rules for addresses.
    *
    * @var array
    */
   public static $rules = [
       'order_id' => 'required|exists:orders,id',
       'type' => 'required|in:shipping,billing',
       'first_name' => 'required|string|max:255',
       'last_name' => 'required|string|max:255',
       'email' => 'nullable|email|max:255',
       'phone' => 'nullable|string|max:20',
       'address_line1' => 'required|string|max:255',
       'address_line2' => 'nullable|string|max:255',
       'city' => 'required|string|max:255',
       'state' => 'nullable|string|max:255',
       'postal_code' => 'required|string|max:20',
       'country' => 'required|string|max:100'
   ];

   /**
    * Get the order that owns the address.
    */
   public function order()
   {
       return $this->belongsTo(Order::class);
   }

   /**
    * Check if this is a shipping address.
    *
    * @return bool
    */
   public function isShipping()
   {
       return $this->type === 'shipping';
   }

   /**
    * Check if this is a billing address.
    *
    * @return bool
    */
   public function isBilling()
   {
       return $this->type === 'billing';
   }

   /**
    * Get full name.
    *
    * @return string
    */
   public function getFullNameAttribute()
   {
       return "{$this->first_name} {$this->last_name}";
   }

   /**
    * Get formatted address.
    *
    * @return string
    */
   public function getFormattedAddressAttribute()
   {
       $address = $this->address_line1;
       
       if ($this->address_line2) {
           $address .= ", {$this->address_line2}";
       }
       
       $address .= ", {$this->city}";
       
       if ($this->state) {
           $address .= ", {$this->state}";
       }
       
       $address .= ", {$this->postal_code}, {$this->country}";
       
       return $address;
   }

   /**
    * Copy address data from an existing address.
    *
    * @param OrderAddress|array $address
    * @return $this
    */
   public function copyFrom($address)
   {
       $data = is_array($address) ? $address : $address->toArray();
       
       // Remove id, order_id, type if they exist
       unset($data['id'], $data['order_id'], $data['created_at'], $data['updated_at']);
       
       foreach ($data as $key => $value) {
           if (in_array($key, $this->fillable)) {
               $this->{$key} = $value;
           }
       }
       
       return $this;
   }
}