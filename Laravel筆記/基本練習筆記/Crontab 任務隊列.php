<?php
    /**
     *  启动调度器
     *
     *  參考來源:
     *  https://learnku.com/docs/laravel/8.x/scheduling/9399
     *
     *  使用这个调度器时，只需要把下面的 Cron 条目添加到你的服务器中。
     *  "* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1"
     *
     *  定义调度
     *  在 App\Console\Kernel 类的 schedule 方法中定义所有的调度任务。
     *
     *  调度频率选项
     *    方法                                  描述
     *    ->cron('* * * * *');                  自定义 Cron 计划执行任务
     *    ->everyMinute();                      每分钟执行一次任务
     *    ->everyTwoMinutes();                  每两分钟执行一次任务
     *    ->everyThreeMinutes();                每三分钟执行一次任务
     *    ->everyFourMinutes();                 每四分钟执行一次任务
     *    ->everyFiveMinutes();                 每五分钟执行一次任务
     *    ->everyTenMinutes();                  每十分钟执行一次任务
     *    ->everyFifteenMinutes();              每十五分钟执行一次任务
     *    ->everyThirtyMinutes();               每三十分钟执行一次任务
     *    ->hourly();                           每小时执行一次任务
     *    ->hourlyAt(17);                       每小时第 17 分钟执行一次任务
     *    ->everyTwoHours();                    每两小时执行一次任务
     *    ->everyThreeHours();                  每三小时执行一次任务
     *    ->everyFourHours();                   每四小时执行一次任务
     *    ->everySixHours();                    每六小时执行一次任务
     *    ->daily();                            每天 0 点执行一次任务
     *    ->dailyAt('13:00');                   每天 13:00 执行一次任务
     *    ->twiceDaily(1, 13);                  每天 01:00 和 13:00 各执行一次任务
     *    ->weekly();                           每周日 00:00 执行一次任务
     *    ->weeklyOn(1, '8:00');                每周一的 08:00 执行一次任务
     *    ->monthly();                          每月第一天 00:00 执行一次任务
     *    ->monthlyOn(4, '15:00');              每月 4 号的 15:00 执行一次任务
     *    ->lastDayOfMonth('15:00');            每月最后一天 15:00 执行一次任务
     *    ->quarterly();                        每季度第一天 00:00 执行一次任务
     *    ->yearly();                           每年第一天 00:00 执行一次任务
     *    ->timezone('America/New_York');       设置时区
     */




























