<!DOCTYPE html>
<html>
    <head>
        <title>バルクインサートTest</title>
 

 
        <style>
 
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
    
                <div class="title">CSVテスト（バルクインサート）</div>
 
                <h4>CSVファイルを選択してください</h4>
                <div class="row">
                    <div class="col-md-6">
                    ■手順
 
                    1. CSVで保存します。
 
                    2. ファイルを選択し読み込んでください。
 <BR>
 <BR>
実装<BR>
・ SplFileObject<BR>
・バルクインサート<BR>
 <BR>
                    </div>
                </div>
                
                <form action="import" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="csv_file" id="csv_file"><BR>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-success">保存</button>
                    </div>
                </form>
 
            </div>
        </div>
    </body>
</html>