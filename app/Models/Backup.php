<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'note',
        'path',
        'status',
        'user_id'
    ];

    public function formatStatus() {
        $statusText = '';
        switch ($this->status) {
            case 0:
                $statusText = '<span class="bg-warning badge">Pendiente</span>';
                break;
            case 1:
                $statusText = '<span class="bg-success badge">Completado</span>';
                break;
            case 2:
                $statusText = '<span class="bg-danger badge">Falló</span>';
                break;
            case 3;
                $statusText = '<span class="bg-secondary badge">Restaurado</span>';
                break;
            default:
                $statusText = '<span class="bg-info badge">Sin estado</span>';
                break;
        }
        return $statusText;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
