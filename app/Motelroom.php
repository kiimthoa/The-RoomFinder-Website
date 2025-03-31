<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motelroom extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;
    
    protected $table = "motelrooms";
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'area',
        'address',
        'images',
        'latlng',
        'phone',
        'category_id',
        'district_id',
        'user_id',
        'approve',
        'count_view'
    ];

    protected $casts = [
        'images' => 'array',
        'latlng' => 'array',
        'price' => 'integer',
        'area' => 'integer',
        'approve' => 'boolean',
        'count_view' => 'integer'
    ];
    
    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }
    
    public function reports(){
        return $this->hasMany(Reports::class, 'id_motelroom');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    // API Resource Methods
    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'area' => $this->area,
            'address' => $this->address,
            'images' => $this->images,
            'latlng' => $this->latlng,
            'phone' => $this->phone,
            'approve' => $this->approve,
            'count_view' => $this->count_view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => $this->category,
            'user' => $this->user,
            'district' => $this->district,
            'reports' => $this->reports
        ];
    }
}
