
<script>
    // <!-- 側邊選單路徑與瀏覽位置相同時啟動顯示 -->
    (function($) {
        "use strict";
        $(document).ready(function () {
            var url = window.location;
            $('#sidebar a').each(function () {
                if (this.href == url) {
                    $(this).addClass('active');
                    if ($(this).parents('ul').length == 2) {
                        $(this).parent().parent().parent().addClass('menu-open');
                        $(this).parent().parent().parent().children('a').addClass('active');
                    }
                }
            });
        });
    })(jQuery);
</script>
