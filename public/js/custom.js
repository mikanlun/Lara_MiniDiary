$(function(){

    /**
     * ウィンドウ上端でグローバルナビゲーションを固定する
     */
    $(window).on('scroll', function(){
        var scrollValue = $(this).scrollTop();
        $('.fixedmenu')
        .trigger('customScroll', {posY: scrollValue});
    });

    $('.fixedmenu')
    .each(function(){
        var $this = $(this);
        $this.data('initial', $this.offset().top);
    })
    .on('customScroll', function(event, object){

        var $this = $(this);

        if($this.data('initial') <= object.posY) {
            //要素を固定
            if(!$this.hasClass('fixed')) {
                var $substitute = $('<div></div>');
                $substitute
                .css({
                    'margin':'0',
                    'padding':'0',
                    'font-size':'0',
                    'height':'0'
                })
                .addClass('substitute')
                .height($this.outerHeight(true))
                .width($this.outerWidth(true));

                $this
                .after($substitute)
                .addClass('fixed')
                .css({top: 0});
            }
        } else {
            //要素の固定を解除
            $this.next('.substitute').remove();
            $this.removeClass('fixed');
        }
    });


    /**
     * スクロールしてページトップに戻る
     */
    var topBtn = $('#page-top');
    topBtn.hide();
    //スクロールが100に達したらボタン表示
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });


    /**
     * ダイアリー日付チェンジ
     */
    $('.slide .prev, .slide .next').on('click', function(e) {
        $this = $(this);
        var key;
        if ($this.is('.prev')) {
            key = 'prev';
        } else {
            key = 'next';
        }
        var changeDate = $this.data('change');
        var nowDate = $this.data('now');
        var displayDate;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url:'/diary/displaydate',
            data:{
                'key': key,
                'changeDate': changeDate,
            },
        })
        .done(function(data){
            if (data.displayDate) {
                if (data == 'error') {
                    alert('ダイアリーの取得に失敗しました。');
                    displayDate = nowDate;
                } else {
                    // ダイアリー有り
                    displayDate = data.displayDate;
                }
            } else {
                // ダイアリー無し
                displayDate = nowDate;
                if (key == 'prev') {
                    alert(displayDate + 'より以前のダイアリーは登録されていません。');
                } else {
                    alert(displayDate + 'より以降のダイアリーは登録されていません。');
                }
            }
            location.href = "/diary?changeDate=" + displayDate;
        })
        .fail(function(){
            alert('ダイアリーの取得に失敗しました。');
            displayDate = nowDate;
            location.href = "/diary?changeDate=" + displayDate;
        });
        // topへ
     });

    /**
     * カレンダー (検索)
     */
    $('#datepicker-default .date').datepicker({
        format: 'yyyy-mm-dd',
        language: 'ja'
    });

    /**
     * カレンダー (一覧 )
     */
    $('#calender')
    .each(function(){
        var $this = $(this);
        var nowDate = $this.siblings().find('a').data('now');
        var nowDates = nowDate.split('-');
        var changeMonth = nowDates[0] + '-' + nowDates[1];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/diary/calendar',
            type:'POST',
            data:{
               'changeMonth': changeMonth,
            },
            datatype: 'html',
        })
        .done(function(data){
            $('#calender').html(data.html);
        })
        .fail(function(){
            alert('カレンダーの作成に失敗しました。');
        });
    });

    /**
     * カレンダー (一覧 : 移動)
     */
    $(document).on('click', '#calender .prev, #calender .next', function() {
        $this = $(this);
        var changeMonth = $this.data('change');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/diary/calendar',
            type:'POST',
            data:{
               'changeMonth': changeMonth,
           },
           datatype: 'html',
        })
        .done(function(data){
            $('#calender').html(data.html);
        })
        .fail(function(){
            alert('カレンダーの作成に失敗しました。');
        });
    });

    /**
     * ダイアリー削除
     */
    $('#delete_image').on('click', function(){
        var $this = $(this);
        if(window.confirm('ダイアリーを削除しますがよろしいですか？')) {
            document.getElementById('delete_submit').submit();
        } else {
            return false;
        }
    });

    /**
     * アカウント削除
     */
    $('#delete_account').on('click', function(){
        var $this = $(this);
        var userName;
        var msg;
        userName = $this.data('user_name');
        msg = userName + ' 様、アカウントを削除しますがよろしいですか？';
        if(window.confirm(msg)) {
            document.getElementById('delete_resign').submit();
        } else {
            return false;
        }
    });


});
