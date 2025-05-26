<?php namespace App\Models;

use CodeIgniter\Model;

class BatteryModel extends Model
{
    protected $table = 'batteries';
    protected $allowedFields = ['name', 'type', 'voltage', 'capacity', 'price'];
    protected $useTimestamps = true;

    public function getBatteriesWithType()
    {
    return $this->select('batteries.*, battery_types.type_name')
               ->join('battery_types', 'battery_types.id = batteries.type')
               ->findAll();
    }

    public function dtQuery($search = null, $start = 0, $length = 10)
    {
        $builder = $this->builder();
        
        if ($search) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('type', $search)
                ->orLike('voltage', $search)
                ->orLike('capacity', $search)
                ->orLike('price', $search)
                ->groupEnd();
        }

        return $builder->limit($length, $start)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}