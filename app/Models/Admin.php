<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin extends Model implements Authenticatable
{
    use HasFactory, Notifiable, AuthenticatableTrait;

    // Indica que este modelo se relaciona con la tabla 'admins'
    protected $table = 'admins';

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];

    // Para asegurarte de que no se modifique el campo 'id'
    public $timestamps = true;

    // Asegúrate de que la contraseña se cifre
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Implementación de los métodos requeridos por la interfaz Authenticatable

    public function getAuthIdentifierName()
    {
        return 'id'; // El nombre del campo que identifica al usuario
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Devuelve el identificador (id) del admin
    }

    public function getAuthPassword()
    {
        return $this->password; // Devuelve la contraseña cifrada
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Devuelve el token de recordatorio
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Establece el token de recordatorio
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // El nombre del campo de token de recordatorio
    }
}
