<?php
/* Eloquent 關聯資料操作 多型 (輻射)
多型關聯允許一個模型在單一關聯從屬一個以上的其他模型，也就是有多個Eloquent類別對應相同的關係。
例如: 上傳照片給員工及商品，如果使用多型關聯，就可以使用photos資料表來存取其他兩個相同關聯(都是多對一)
的另外兩個模型(staffs和products)，最重要是照片模型要有 imageable_id和imageable_type兩個欄位。
imageable_type用來判斷哪一個模型上傳(staffs 或 products)
imageable_id就是對應該type模型的id.
*/
/* 
    定義多型關聯，先在photo模型使用morphTo()
*/
    class Photos extends Model
    {
        public function imageable(){
            return $this->morphTo();
        }
    }
/* 
    然後到其他模型定義，使用morphMany()
*/
    class Staff extends Model
    {
        public function photos(){
            return $this->morphMany(PhotoEloquent::class, 'imageable');
        }
    }
    class Products extends Model
    {
        public function photos(){
            return $this->morphMany(PhotoEloquent::class, 'imageable');
        }
    }