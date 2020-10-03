<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title>Webスプレッドシート</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="./jexcel/jexcel.css" type="text/css" />
    <script src="./jexcel/jexcel.js"></script>
    <link rel="stylesheet" href="./jexcel/jsuites.css" type="text/css" />
    <script src="./jexcel/jsuites.js"></script>
</head>
<body>
<h1>スプレッド（テスト）</h1>
{!! Form::open(['route' => 'excelout', 'name' => 'id_form1']) !!}
<div id="spreadsheet" style="height: 200px;"></div>
<script>
    var directions = [ '選択１' ,'選択2','選択3','選択4','選択5'];  

    var addresslist=[
        {"id": "534000000", "name": "あああ"}, 
        {"id": "553000000", "name": "いいい"}, 
        {"id": "554000000", "name": "ううう"}, 
        {"id": "550000000", "name": "えええ"}, 
        {"id": "552000000", "name": "おおお"}, 
        {"id": "999999999", "name": "その他"}]

    var spreadsheetdata = [
      {"direction": "選択2","targetdate": "2019-12-08",  "destination": "534000000", "distance": 13.1, "transportation": "ドロップ１", "fare": 1, "dailyallowance": 2, "stayallowance": 3, "adjustmentamount": 4,"total":"=f1+g1+H1+I1", "remarks": "普通のTEXT"}, 
      {"direction": "選択3","targetdate": "2019-12-09",  "destination": "999999999", "distance": 13.1, "transportation": "ドロップ３", "fare": 1, "dailyallowance": 2, "stayallowance": 3, "adjustmentamount": 4,"total":"=f2+g2+h2+i2", "remarks": ""}]

    var transportations = ['ドロップ１', 'ドロップ２','ドロップ３'];



    var trexplist = jexcel(document.getElementById('spreadsheet'),{
        data: spreadsheetdata,
        minSpareRows: 3,
        columns: [
            { type: 'dropdown'    , title:'A列：選択項目'    , width:74  , source:directions },
            { type: 'calendar'    , title:'B列：日付'    , width:120 , options: { format:'YYYY/MM/DD' } },
            { type: 'autocomplete', title:'C列：オートコンプリート'  , width:200 , align: 'left', source: addresslist, multiple:false },
            { type: 'numeric'     , title:'D列：数字'    , width:100 , align: 'right' ,mask:'#,##.0' },
            { type: 'dropdown'    , title:'E列：ドロップダウン', width:120 , align: 'left', source:transportations },
            { type: 'numeric'     , title:'F列：数値'    , width:80  , align: 'right' ,mask:'#,##'},
            { type: 'numeric'     , title:'G列：数値'    , width:80  , align: 'right' ,mask:'#,##'},
            { type: 'numeric'     , title:'H列：数値'  , width:80  , align: 'right' ,mask:'#,##'},
            { type: 'numeric'     , title:'I列：数値'  , width:80  , align: 'right' ,mask:'#,##'},
            { type: 'text'        , title:'J列：合計'    , width:100 , align: 'right' ,mask:'#,##'},
            { type: 'text'        , title:'K列：備考'    , width:200 , align: 'left' },
        ]
    });
</script>
<input name="textBox1" id="id_textBox1" type="text" value="あああ">
<div>
{!! Form::submit('登録', ['class' => "btn btn-primary btn-block btn-success"]) !!}
{!! Form::close() !!}
</dev>
<br><br><br><br><br>
<dev>
    <select id="myselectbox" onchange="myfunc()">
        <option value="" selected>選択...</option>
        <option value="1">テスト１</option>
        <option value="2">テスト２</option>
        <option value="3">テスト３</option>
        </select>
 
    <script>
        function myfunc() {
        
            var index = document.getElementById("myselectbox").selectedIndex;
            var value = document.getElementById("myselectbox").value;
            
            console.log("You have selected" + value+ ", with index "+index);
        }
    </script>
</dev>
<br><br><br><br><br>
<a class="nav-link" href="{{ action('DocumentController@downloadPdf') }}#contact">PDFテスト</a>
</body>
</html>