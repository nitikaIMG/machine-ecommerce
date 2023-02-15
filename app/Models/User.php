<?php

namespace App\Models;

use App\Vars\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'phone_code', 'phone', 'profile_pic', 'email_verified_at',
        'password', 'otp', 'otp_verified_at', 'address_line_1',
        'address_line_2', 'image', 'status', 'seller_verified',
        'country', 'state', 'city', 'latitude', 'longitude', 'remember_token','currency',
        'created_at', 'updated_at','fcm_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_verified_at' => 'datetime',
        'deactivated_till' => 'datetime'
    ];

     public function verifyuser(){
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function getRoleAttribute()
    {
        $role = $this->roles->first();

        return $role ? $role->name : null;
    }

    public function getRoleStrAttribute()
    {
        return __('roles.'.$this->role);
    }

    public function isAdmin()
    {
        return in_array($this->role, [Roles::SUPER_ADMIN, Roles::ADMIN]);
    }

    public function isSeller()
    {
        return in_array($this->role, [Roles::SELLER]);
    }

    public function isCustomer()
    {
        return in_array($this->role, [Roles::CUSTOMER]);
    }

    // currently only one instance to hold seller related data;
    // may change to more than one in future
    public function user_shop()
    {
        return $this->hasOne(UserShop::class, 'user_id');
    }

    public function user_shop_photos()
    {
        return $this->hasManyThrough(UserShopPhoto::class, UserShop::class, 'user_id', 'user_shop_id');
    }

    public function user_shops()
    {
        return $this->hasMany(UserShop::class, 'user_id');
    }

    public function favourite_shops()
    {
        return $this->belongsToMany(UserShop::class, 'user_favourite_shops', 'user_id', 'user_shop_id');
    }

    public function favourite_products()
    {
        return $this->belongsToMany(SellerProduct::class, 'user_favourite_products', 'user_id', 'seller_product_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    public function cart_items()
    {
        return $this->hasManyThrough(CartItem::class, Cart::class, 'user_id', 'cart_id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    public function primary_address()
    {
        return $this->hasOne(UserAddress::class, 'user_id')->primary();
    }

    // customer orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id')->distinct()->noQuotation();
    }

    // customer quotations
    public function quotations()
    {
        return $this->hasMany(Order::class, 'customer_id')->distinct()->quotation();
    }

    // biddings this user has placed on cart items, as a customer
    public function biddings()
    {
        return $this->hasMany(CartItemBidding::class, 'customer_id');
    }

    public function seller_products()
    {
        return $this->hasMany(SellerProduct::class, 'seller_id');
    }

    // orders generated for this seller
    public function seller_orders()
    {
        return $this->belongsToMany(Order::class, OrderSeller::class, 'seller_id', 'order_id')
            ->distinct()
            ->noQuotation();
    }

    // quotations generated for this seller
    public function seller_quotations()
    {
        return $this->belongsToMany(Order::class, OrderSeller::class, 'seller_id', 'order_id')
            ->distinct()
            ->quotation();
    }

    public function seller_biddings()
    {
        return $this->hasMany(CartItemBidding::class, 'seller_id');
    }

    public function scopeNotRole($query, $roles, $guard = null)
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';

            return $this->getRoleClass()->{$method}($role, $guard ?: $this->getDefaultGuardName());
        }, Arr::wrap($roles));

        return $query->whereHas('roles', function (Builder $subQuery) use ($roles) {
            $roleClass = $this->getRoleClass();
            $key = (new $roleClass())->getKeyName();
            $subQuery->whereNotIn(config('permission.table_names.roles').".$key", \array_column($roles, $key));
        });
    }

    public function scopeFullyActive($query)
    {
        return $query->where('status', 1)
            // either mobile or email is verified
            ->where(function($query) {
                $query->whereNotNull('otp_verified_at')
                    ->orWhereNotNull('email_verified_at');
            })
            // not blocked by the admin
            ->where(function($query) {
                $query->whereNull('deactivated_till')
                    ->orWhereDate('deactivated_till', '<', date('Y-m-d'));
            });
    }
    
    /// currently not working
    public function product_categories() {
        return $this->belongsToMany(
            ProductCategory::class,
            'seller_product_categories',
            'user_id',
            'product_category_id'
        );
    }    

    public function settings()
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function booted()
    {
        // static::addGlobalScope('active', function (Builder $builder) {
        //     $builder->where('status', '1');
        // });

        static::addGlobalScope('settings', function(Builder $builder) {
            $builder->with(['settings']);
        });

        static::updated(function(User $user) {
            if( $user->isDirty('longitude') || $user->isDirty('latitude') ) {
                UserShop::clearCache($user);
            }
        });
    }

    public function chat_channels()
    {
        return $this->hasMany(ChatChannel::class, 'user_id');
    }

    public function chat_messages()
    {
        return $this->hasMany(ChatMessage::class, 'user_id', 'id');
    }
}
