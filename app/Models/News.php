<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    
    class News extends Model
    {
        use HasFactory;
        
        protected $fillable = [ 'title' , 'content' , 'is_published' ];
//        protected $dates = [ 'created_at' , 'updated_at' ];
        protected $casts = [
            'created_at' => 'datetime:d/m/Y H:i',
            'updated_at' => 'datetime:d/m/Y H:i',
        ];
     
        
    }
