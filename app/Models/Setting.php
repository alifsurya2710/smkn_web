<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Helper to get setting value by key
     */
    public static function getByKey($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) return $default;

        switch ($setting->type) {
            case 'boolean':
                return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
            case 'array':
                return json_decode($setting->value, true);
            default:
                return $setting->value;
        }
    }

    /**
     * Helper to set setting value by key
     */
    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        $val = is_array($value) ? json_encode($value) : (string)$value;
        
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $val, 'type' => $type, 'group' => $group]
        );
    }
}
