<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Questionnaire</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="">
    </head>
    <body>
    <table border="0">
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>対象アンケート：
                @foreach ($questions_datas as $questions_data)
                    @if($questions_data->i_question_id == $select_no)
                        {{ $questions_data->c_question_name }}
                    @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2">＜＜回答結果＞＞※有効回答者の結果のみ表示。  </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
    </table>
    <table>
            @foreach($queue as $key => $value)
                @foreach($value as $sub_key => $sub_value) 
                    @if ($sub_key == "no")
                        <tr>
                            <td colspan="12">
                                {{ nl2br(e($sub_value)) }}．
                    @elseif($sub_key == "title")
                                {{ nl2br(e($sub_value)) }}
                            </td>
                        </tr>
                    @elseif ($sub_key == "l1")
                        <tr>
                        <?php $tokei_val = nl2br(e($sub_value)).'：'; ?>
                        <td>{{ nl2br(e($sub_value)) }}:
                        <?php $vol_flg = 0; ?>
                    @elseif($sub_key == "l2"  or $sub_key == "l3" or
                            $sub_key == "l4" or  $sub_key == "l5"  or $sub_key == "l6")
                            @if($sub_value == '')
                                <?php $vol_flg = 1; ?>
                            @else
                                <?php $vol_flg = 0; ?>
                                <?php $tokei_val .= nl2br(e($sub_value)).'：'; ?>
                        <td>{{ nl2br(e($sub_value)) }}:
                            @endif
                    @elseif($sub_key == "l7" or  $sub_key == "l8"  or $sub_key == "l9" or
                            $sub_key == "l10" or $sub_key == "l11" or $sub_key == "l12")
                            @if($sub_value == '')
                                <?php $vol_flg = 1; ?>
                            @else
                                <?php $vol_flg = 0; ?>
                                <?php $tokei_val .= nl2br(e($sub_value)).'：'; ?>
                        <td>{{ nl2br(e($sub_value)) }}:
                            @endif
                    @elseif($sub_key == "v1"  or $sub_key == "v2"  or $sub_key == "v3" or
                            $sub_key == "v4"  or $sub_key == "v5"  or $sub_key == "v6" or
                            $sub_key == "v7"  or $sub_key == "v8"  or $sub_key == "v9" or
                            $sub_key == "v10" or $sub_key == "v11" or $sub_key == "v12")
                            @if(isset($vol_flg))
                                @if($vol_flg == 1)
                                @else
                                    <?php $tokei_val .= nl2br(e($sub_value)).'％　　'; ?>
                        {{ nl2br(e($sub_value)) }}％</td>
                                @endif
                            @endif
                    @else
                        <?php $tokei_val .= nl2br(e($sub_value)); ?>
                    @endif
                @endforeach
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            @endforeach
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>