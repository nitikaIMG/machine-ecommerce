<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    protected $fillable = ['user_id',
        'name', 'email', 'phone', 'address_1',
        'address_2', 'country', 'state', 'city', 'is_primary',
        'latitude', 'longitude','zip',
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', 1);
    }

    public function getAddressAttribute()
    {
        $address = $this->address_1 ?? '';

        if( $this->address_2 ) {
            $address .= ", {$this->address_2}";
        }
        if( $this->city ) {
            $address .= ", {$this->city}";
        }
        if( $this->state ) {
            $address .= ", {$this->state}";
        }
        if( $this->zip ) {
            $address .= ", {$this->zip}";
        }
        if( $this->country ) {
            $address .= ", {$this->country}";
        }

        return ltrim($address, ', ');
    }
}
