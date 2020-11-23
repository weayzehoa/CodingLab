<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>台北公園資訊 (PDF匯出)</title>
</head>
<style>
    body {
        font-family: 'wt011';
    }

    #css_table {
        display: table;
    }

    .css_tr {
        display: table-row;
    }

    .css_td {
        display: table-cell;
        height: auto;
        word-wrap: break-word;
        word-break: break-all;
        overflow: hidden;
        padding-left: 1em;
        padding-right: 1em;
    }
</style>

<body>
    <h3 class="card-title">台北公園資訊 (PDF匯出)</h3>
    <div id="css_table">
        <div class="css_tr">
            <div class="css_td">公園名稱</div>
            <div class="css_td">英文名稱</div>
            <div class="css_td">類型</div>
            <div class="css_td">行政區</div>
            <div class="css_td">位置</div>
            <div class="css_td">管理單位</div>
        </div>
        @foreach ( $parks as $park )
        <div class="css_tr">
            <div class="css_td" style="width:15%">
                <p style="font-size: 14px">{{ $park->name }}</p>
            </div>
            <div class="css_td" style="width:18%">
                <p style="font-size: 14px">{{ $park->engname }}</p>
            </div>
            <div class="css_td" style="width:8%">
                <p style="font-size: 14px">{{ $park->type }}</p>
            </div>
            <div class="css_td" style="width:8%">
                <p style="font-size: 14px">{{ $park->dist }}</p>
            </div>
            <div class="css_td" style="width:34%">
                <p style="font-size: 14px">{{ $park->location }}</p>
            </div>
            <div class="css_td" style="width:17%">
                <p style="font-size: 14px">{{ $park->unit }}</p>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
