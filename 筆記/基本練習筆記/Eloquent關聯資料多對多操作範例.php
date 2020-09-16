<?php
/* Eloquent 關聯資料操作 多對多 (星狀)
多對多是比較複雜的關聯，最常見範例就是商品跟訂單之間的關係，一個訂單紀錄許多商品且
一個商品也可以被許多訂單所記錄.且通常也會在兩者之間多對多的關聯上產生屬性，例如單價和數量
還有當時所訂購的單價(因為價格有可能會漲降價，所以不能使用商品價格屬性)
*/
/* 
如果要建立多對多關係，需要先定義在Porducts的關係:
*/
class Products extends Model
{
    public function orders(){
        return $this->belongsToMany(OrderEloquent::class);
    }
}
/* 
且要在 Orders 定義反向的多對多關係但其實是一模一樣的
*/
class Orders extends Model
{
    public function products(){
        return $this->belongsToMany(ProductEloquent::class);
    }
}
/* 
    如此一來就可以了嗎?? 不!!
    因為多對多關係在實務上不能有多對多這樣的關係，必須拆開來成多個一對多關係
    因為你不能在單一個Product上有一個order_id外來鍵，然後也不能在單一Order上
    有一個product_id，所以必須要有另一個樞紐表格來連接兩者.

    Products --->  Order_Product  <--- Orders
                    |       |
                    V       V
                   單價    數量

    這個樞紐表預設命名規範是將兩個表格名稱按照字母順序放在一起並由底線來分隔
    如此一來此範例樞紐表就叫做 order_product 且該表必須有兩個外來鍵 order_id
    與 product_id.

    此時需用 migrate 建立樞紐資料表，除了命名為 order_product 外，需要有額外
    四個欄位，order_id , product_id , qty 和 price.
*/
/* 
    當然多對多關聯也是可以自訂參數如下:
*/
    $this->belongsToMany(
        ProductEloquent::class, //關聯模型
        'order_product', //樞紐表名稱
        'order_id', //此模型外鍵名稱
        'product_id' //要加入的關聯模型外鍵名稱
    );
/*
    可以使用下方方式來存取相關資料
*/
    $order = OrderEloquent::first();
    $order->products->each(function($product)){
        //Do something
    }
    $product = ProductEloquent::first();
    $product->orders->each(function($order)){
        //Do something
    }
/* 
    從Order方取Product資料, 對應SQL語法如下
    SELECT * from orders where order.id = 2 limit;
    SELECT product.*, order_product.order_id as pivot_order_id, order_product.product_id as pivot_product_id
    from products INNER JOIN order_product ON products.id = order_product.product_id where order_product.order_id = 2;
*/
/* 
    如果想要附加關係
*/
    $order = OrderEloquent::find(1);
    $product = ProductEloquent::find(5);
    $order->product()->save($product, [
        'price' => '30',
        'qty' => '5'
    ]);
/* 
    對應SQL語法如下:
    SELECT * from orders where orders.id = 1 limit 1;
    SELECT * from products where products.id = 5 limit 1;
    INSERT into order_product ('order_id','product_id','price','qty') value(1,5,'30','5');
*/
/* 
    另外可以使用更方便的方法 attach()和deattach()直接傳遞id值來取代傳遞模型
*/
    $order = OrderEloquent::find(2);
    $order->products()->attach(1);
    $order->products()->attach(2,['price' => '40', 'qty' => '4']);
    $order->products()->attach([3,4,5]);
    $order->products()->attach([
        6 => ['price' => '30', 'qty' => '2'],
        7 => ['price' => '70', 'qty' => '5'],
    ]);
    $order->products()->deattach(1);
    $order->products()->deattach([2,3]);
    $order->products()->deattach();
/* 
    對應SQL語法如下:
    SELECT * from order where order.id = 2 limit 1;
    INSERT INTO 'order_product' ('order_id','product_id') value(2,1);
    INSERT INTO 'order_product' ('order_id','price','product_id','qty') value(2,'40', 1, '4');
    INSERT INTO 'order_product' ('order_id','product_id') value(2,3), (2,4), (2,5);
    INSERT INTO 'order_product' ('order_id','price','product_id','qty') value(2, '30', 6, '2'), (2,'70', 7, '5');
    DELETE from order_product where order_id = 2 AND product_id IN (1);
    DELETE from order_product where order_id = 2 AND product_id IN (2,3);
    DELETE from order_product where order_id = 2;
*/
/* 
    樞紐表格中紀錄price與qty若想要從樞紐表中取得資料或者附加時間戳記例如: create_at
    可以定義關聯時這樣做:
*/
    public function products(){
        return $this->belongsToMany(ProductEloquent::class)
        ->withTimestamps()
        ->withPivot('price','qty');
    }
/* 
    透過關聯來取得實例時會多一個pivot特性，代表樞紐表格中引入的
    如此一來才可以取得樞紐表格中資訊
*/
    $order = OrderEloquent::find(2);
    $order->products->each(function($product){
        echo $product->pivot->price;
        echo $product->pivot->qty;
        echo $product->pivot->create_at;
    });
/* 
    對應的SQL如下:
    SELECT products.*, orders_product.order_id as pivot_order_id, order_product.product_id as pivot_product_id
    order_prodcut.price as pivot_price, order_product.qty as pivot_qty, order_product.create_at as pivot_create_at
    from products INNER JOIN order_product ON products.id = order_product.product_id where order_product.order_id = 2;
*/
/* 
    若只想修改樞紐表中的紀錄可以使用updateExistingPivot()
*/
    $order->products->updateExistingPivot($productID,[
        'price' => '40',
        'qty' => '7',
    ]);
/* 
    假設$productID = 5;
    對應SQL如下:
    UPDATE order_product set price = '40', qty = '7' where order_id = 2 and product_id = 5;
*/
/* 
    若要有效率的替換關係，例如原本商品5號可能是綁定訂單1號與4號
    可以使用sync()函式，可以直接中斷商品編號5的所有關係，然後重新建立對商品5號的新關係
*/
    $order = OrderEloquent::find(2);
    $order->products()->sync([1,2,3]);
    // 或者加上傳送樞紐表格的資料參數
    $order->products()->sync([
        1=>['price' => '99', 'qty' => '2'],
        2,
        3
    ])
/* 
    如此一來商品編號1,2,3三個商品將會中斷之前與其他訂單關聯，
    只會對訂單2號產生關連.
*/