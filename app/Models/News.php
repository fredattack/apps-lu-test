<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class News extends Model
    {
        use HasFactory,SoftDeletes;
        
        protected $fillable = [ 'title' , 'content' , 'is_published' ];
        
        protected $casts = [
            'created_at' => 'datetime:d/m/Y H:i',
            'updated_at' => 'datetime:d/m/Y H:i',
        ];
    
        public function tags (  )
        {
            return $this->belongsToMany ( Tag::class);
        }
    }
