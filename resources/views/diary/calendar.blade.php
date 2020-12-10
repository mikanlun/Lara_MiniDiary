<table>
<tr>
<th class="head"><a class="prev" data-change="{{ $preMonth }}"></a></th>
<th class="headYM">{{ $y }}-{{ $m }}</th>
<th class="head"><a class="next" data-change="{{ $nextMonth }}"></a></th>
</tr>
</table>
<table border="1">
<tr class="bg-info text-white">
    <th>日</th>
    <th>月</th>
    <th>火</th>
    <th>水</th>
    <th>木</th>
    <th>金</th>
    <th>土</th>
</tr>
<tr>
    {{-- 1日の曜日を取得 --}}
    @php
        $wd1 = date("w", mktime(0, 0, 0, $m, 1, $y));
    @endphp

    {{-- その数だけ空のセルを作成 --}}
    @for ($i = 1; $i <= $wd1; $i++)
        <td> </td>
    @endfor

    {{-- 当月の日数を取得 --}}
    @php
        $dd = date('t', strtotime($y . '-' . $m . '-01'));
    @endphp

    {{-- カレンダー作成 --}}
    @for ($d = 1; $d <= $dd; $d++)

        {{-- 日曜：赤色 --}}
        @if(date("w", mktime(0, 0, 0, $m, $d, $y)) == 0)
            @if (array_key_exists ($d , $displayDates))
                <td class='red register'><a href='/diary?changeDate={{ $displayDates[$d] }}'>{{ $d }}</a></td>
            @else
                <td class='red'>{{ $d }}</td>
            @endif
        {{-- 土曜：青色 --}}
        @elseif(date("w", mktime(0, 0, 0, $m, $d, $y)) == 6)
            @if (array_key_exists ($d , $displayDates))
                <td class='blue register'><a href='/diary?changeDate={{ $displayDates[$d] }}'>{{ $d }}</a></td>
            @else
                <td class='blue'>{{ $d }}</td>
            @endif
        {{-- 土日祝以外 --}}
        @else
            @if (array_key_exists ($d , $displayDates))
                <td class='register'><a href='/diary?changeDate={{ $displayDates[$d] }}'>{{ $d }}</a></td>
            @else
                <td>{{ $d }}</td>
            @endif
        @endif

        {{-- 週の始まりと終わりでタグを出力 --}}
        @if (date("w", mktime(0, 0, 0, $m, $d, $y)) == 6)
            {{-- 週を終了 --}}
            </tr>

            {{-- 次の週がある場合は新たな行を準備 --}}
            @if (checkdate($m, $d + 1, $y))
                <tr>
            @endif
        @endif

    @endfor

    {{-- 最後の週の土曜日まで空のセルを作成 --}}
    @php
        $wdx = date("w", mktime(0, 0, 0, $m + 1, 0, $y));
    @endphp

    @for ($i = 1; $i < 7 - $wdx; $i++)
        <td> </td>
    @endfor

    </tr>
</table>
