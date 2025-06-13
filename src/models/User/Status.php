<?php

namespace Api\models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $description
 * @property User[] $users
 * @property string $created_at
 * @property string $updated_at
 */
class Status extends Model
{
    const ACTIVE = 1;
    
    const BLOCKED = 2;
    
    const DELETED = 3;
    
    protected $table = 'user_status';
    protected $fillable = ['description'];
    protected $guarded = ['id'];
    public $timestamps = false;
    
    /**
     * Get the users associated with the status.
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_status_id', 'id');
    }
    
}