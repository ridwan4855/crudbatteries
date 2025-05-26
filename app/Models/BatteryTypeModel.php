<?php namespace App\Models;

use CodeIgniter\Model;

class BatteryTypeModel extends Model
{
    protected $table = 'battery_types';
    protected $allowedFields = ['type_name'];
    protected $returnType = 'array';
}