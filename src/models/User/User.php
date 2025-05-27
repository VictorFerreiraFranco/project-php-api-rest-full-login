<?php

namespace Api\models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $user_status_id
 * @property int $debug
 * @property Status $status
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'user_status_id', 'debug'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    /**
     * Retorna o status do usuário
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    
    /**
     * Retorna se o debug está ativo
     * @return bool
     */
    public function isDebug(): bool
    {
        return ($this->debug ?? 0) == 1;
    }
}