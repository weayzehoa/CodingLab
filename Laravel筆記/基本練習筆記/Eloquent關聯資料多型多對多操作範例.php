<?php
/* Eloquent 關聯資料操作 多型多對多 (網狀)
多型多對多關聯最複雜且罕見的關係類型，最常見範例就是標記.
例如: 部落格文章上有貼文(Post)和影片(Video)，使用者可以自由標記不同的標籤(Tag)

                    標籤(tags)
                        |
                      屬於
                     belongs
                        |
            標記 --- 標籤樞紐表 --- 標記
           marks     taggables     marks
             |                      |
            文章                   影片
            Posts                 Videos

簡單的說也就是 多型多對多拆開成 多個 一對多關係.
與一般多型差異就是三個資料表由 標籤樞紐表 taggables 將其串聯起來.
*/
/* 
    定義多型關聯，先在tags資料表中新增posts和videos方法，使用morphedByMany()
*/
    class tags extends Model
    {
        public function posts(){
            return $this->morphedByMany(
                PostEloquent::class, 'taggable'
            );
        }
        public function videos(){
            return $this->morphedByMany(
                VideoEloquent::class, 'taggable'
            );
        }
    }
/* 
    這樣就可以定義完成.
*/