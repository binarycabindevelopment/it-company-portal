<?php

namespace App;

use App\Support\Traits\HasClocks;
use App\Support\Traits\HasContact;
use App\Support\Traits\HasPassword;
use App\Support\Traits\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use KilroyWeb\Roles\Traits\HasRole;
use App\Support\Traits\Filterable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRole;
    use HasPassword;
    use Filterable;
    use Sortable;
    use HasContact;
    use HasClocks;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    protected $filterable = [
        'created_at',
        'first_name',
        'last_name',
        'email',
        'role',
        'global',
    ];

    protected $filterableGlobal = [
        'first_name',
        'last_name',
        'email',
        'role',
    ];

    protected $sortable = [
        'created_at',
        'first_name',
        'last_name',
        'email',
        'role',
    ];

    protected $sortFieldDefault = 'id';
    protected $sortOrderDefault = 'DESC';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::attributesGeneratePasswordIfEmpty($attributes);
        $attributes = static::attributesHashPasswordIfExists($attributes);
        $model = $query->create($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes = static::attributesHashPasswordIfExists($attributes);
        return parent::update($attributes, $options);
    }

    public function isCustomer(){
        return $this->roleIn(['customer']);
    }

    public function isAdmin(){
        return $this->roleIn(['admin']);
    }

    public function isEmployee(){
        return $this->roleIn(['admin','employee']);
    }

    public function linkable()
    {
        return $this->hasMany('App\LinkedUser', 'user_id');
    }

    public function getCustomerAttribute(){
        $contactLinkedUsers = $this->linkable()
            ->where('userable_type',\App\Contact::class)
            ->get();
        foreach($contactLinkedUsers as $contactLinkedUser){
            if($contactLinkedUser->userable->contactable_type == \App\Customer::class){
                return $contactLinkedUser->userable->contactable;
            }
        }
        return null;
    }

}
