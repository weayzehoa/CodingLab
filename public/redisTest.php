<?php
    $redis = new Redis();

    //連線到 Redis
    $redis->connect('127.0.0.1', 6379);
    //$redis->auth('password');
    if ($redis->ping()) {
        echo "Connected to Redis server<br>";
        $redis->set("sessionid", "12345");
        echo "SessionId : ";
        var_dump($redis->get("sessionid"));
    } else {
        echo "Can't connect to server<br>";
    }
