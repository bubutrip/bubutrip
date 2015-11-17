<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="google-site-verification" content="" />
    <meta name="description" content="BuBuTrip 1歲了，感謝粉絲們的支持！11.12-11.30會員揪好友全台知名親子飯店任你住！">
    <meta name="keywords" content="BuBuTrip、親子自駕旅遊網、BuBuTrip、親子住宿體驗券、宜蘭‧蘭城晶英酒店、清境‧黃慶果園民宿、台南‧Cozzi 和逸商旅 " />
    <meta name="url" content="http://www.bubutrip.com.tw/" />
    <meta property="og:locale" content="zh_TW" />
    <meta property="og:site_name" content="BuBuTrip週年慶" />
    <meta property="og:title" content="BuBuTrip週年慶" />
    <meta property="og:url" content="http://www.bubutrip.com.tw/" />
    <meta property="og:type" content="Website" />
    <meta property="og:description" content="BuBuTrip 1歲了，感謝粉絲們的支持！11.12-11.30會員揪好友全台知名親子飯店任你住！" />
    <title>BuBuTrip週年慶</title>
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script type="text/javascript">var console = { log: function() {} };</script><![endif]-->
    <!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
    <link rel="shortcut icon" href="<?=imgurl?>/event/2015Anniversary/resources/images/favicon.ico">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script>
    !window.jQuery && document.write('<script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery-1.8.1.min.js"><\/script>')
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/modernizr.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/utils.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.fancybox.pack.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.placeholder.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/app.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/jqtransform.css" />
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/main.js"></script>
    <script type="text/javascript" src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.jqtransform.js"></script>
    <script language="javascript">
    $(function() {
        $('#reg-form').jqTransform({
            imgPath: '<?=imgurl?>/event/2015Anniversary/resources/images/img/'
        });
    });
    </script>
</head>

<body>
    <!--<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/logo.png"></a></div>-->
    <div id="copyright">©2015 BuBuTrip. All rights reserved.</div>
    <div id="contents" class="register">
        <h2><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_titile.gif"></h2>
        <div class="registerSquirrel"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_squirrel.gif"></div>  
        <form name="reg-form" id="reg-form" action="/event/server_api/serviceapi.php?model=WebApi&function=reg_user" method="post">
            <div class="form">
                <!--    account fields  -->
                <div class="account">
                    <div class="rowElem">
                        <label class="label short" for="reg-email"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t1.gif" alt="會員帳號"></label>
                        <div class="field"><input type="text" name="email" id="reg-email" placeholder="請輸入E-mail" maxlength="90"></div>
                    </div>
                    <div class="rowElem">
                        <label class="label short" for="reg-passwd"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t2.gif" alt="會員密碼"></label>
                        <div class="field"><input type="password" name="passwd" id="reg-passwd" maxlength="20"></div>
                    </div>
                    <div class="rowElem">
                        <label class="label" for="reg-passwd2"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t3.gif" alt="再次確認密碼"></label>
                        <div class="field"><input type="password" name="passwd2" id="reg-passwd2" maxlength="20"></div>
                    </div>
                    <div class="rowElem">
                        <label class="label short" for="reg-name"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t4.gif" alt="你的暱稱"></label>
                        <div class="field"><input type="text" name="name" id="reg-name" maxlength="32"></div>
                    </div>                
                <!--    profile fields  -->
                    <div class="rowElem">
                        <label class="label short" for="reg-area_no"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t5.gif" alt="居住縣市"></label>
                        <div class="field">
                            <select name="area_no" id="reg-area_no">
                                <option value="">請選擇</option>
                                <option value="1">北北基</option>
                                <option value="2">桃竹苗</option>
                                <option value="3">宜蘭</option>
                                <option value="4">中彰投</option>
                                <option value="5">雲嘉南</option>
                                <option value="6">高雄</option>
                                <option value="7">屏東</option>
                                <option value="8">花東</option>
                                <option value="9">離島</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="other">
                    <div class="rowElem item1">
                        <label class="label" for><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t6.gif" alt="家中小孩年紀"></label>
                        <div class="field">
                            <label class="lbbn"><input type="checkbox" name="age_group_bit[]" value="1"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t7.gif" alt="0-1歲"></label>
                            <label class="lbbn"><input type="checkbox" name="age_group_bit[]" value="2"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t8.gif" alt="1-3歲"></label>
                            <label class="lbbn" style="margin-right:0;"><input type="checkbox" name="age_group_bit[]" value="4"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t9.gif" alt="3歲以上"></label>
                        </div>
                    </div>
                    <div class="rowElem item2">
                        <label class="label" for><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t10.gif" alt="你喜歡的旅遊地區"></label>
                        <div class="field">
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="1"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t11.gif" alt="北北基"></label>
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="2"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t12.gif" alt="桃竹苗"></label>
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="4"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t13.gif" alt="宜蘭"></label>
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="8"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t14.gif" alt="中彰投"></label>
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="16"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t15.gif" alt="雲嘉南"></label>
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="32"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t16.gif" alt="高雄"></label>
                            <label class="lbbn"><input type="checkbox" name="travel_area_bit[]" value="64"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t17.gif" alt="屏東"></label>
                            <label class="lbbn" style="margin-right:0;"><input type="checkbox" name="travel_area_bit[]" value="128"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t18.gif" alt="花東"></label>
                        </div>
                    </div>
                    </div>
                <div class="rowElem tosMomer"><input type="checkbox" name="agree"> <img src="<?=imgurl?>/event/2015Anniversary/resources/images/register_t19.gif" alt="我已詳盡閱讀並同意"> <a class="green" id="btn-tos-member" href="#tos-member"></a></div>
                <div class="rowElem submitBtn"><input type="button" class="submit" /></div>
                <input type="hidden" name="ajax" value="">
                <input type="hidden" name="com_key" value="<?=( !empty( $_GET['com_key'] ) )?$_GET['com_key']:''?>">
        </form>
    </div>
    <div class="checkBox confirmbox" id="confirmbox">
        <a href="#" class="checkCloseBtn"></a>
        <a href="#" class="bn-action hide">我知道了</a>
    </div>

    <div class="modal confirmbox" id="tos-member">
        <div class="modal-inner">
            <div class="modal-title">
                歡迎您加入 BuBuTrip 會員！
            </div>
            <div class="modal-content sosume">
                <p>以下條款為和泰汽車股份有限公司及其所屬BuBuTrip團隊( 以下稱 "BuBuTrip團隊 " )藉由BuBuTrip網站提供您服務的同時，您必須了解的相關事項。為保障您的權益及讓您合法使用網站上的服務，請於註冊成為會員前詳細閱讀本會員條款之內容。當您填寫各項資料，並加入BuBuTrip會員， 即表示您可使用BuBuTrip團隊所提供之網站服務，並視為您已同意並遵守本網站之會員規範及相關之法律規定。</p>
                <h3>遵守會員規範及法律規定</h3>
                <p>當您註冊成為會員後，可使用BuBuTrip網站提供的服務。當會員使用BuBuTrip網站服務時，視為會員同意接受本會員條款及所有注意事項之拘束，並同意遵守中華民國相關法規及一切國際網際網路規定與慣例。</p>
                <h3>會員資料提供及其修改與刪除</h3>
                <p>基於BuBuTrip團隊所提供之各項服務，您同意於註冊時提供正確詳實之個人資料，您所登錄之資料事後有變更時，應隨時於線上更新之，或<a href="mailto:BUBUTRIP@mail.hotaimotor.com.tw">來信通知</a>，表明您有意修改、刪除個人資料或給予個人資料複本的要求，我們即會按您的要求辦理。您提供之個人資料若有填寫不實，或原登錄之資料已過時而未更新，BuBuTrip團隊保留隨時終止您的會員資格及使用各項服務資格之權利。如有任何虛假或冒用他人名義登錄，您應自負法律責任。如果您提供之個人資料違反或破壞BuBuTrip服務宗旨，BuBuTrip團隊保留隨時終止您的會員資格及使用各項服務資格之權利。</p>
                <h3>會員行為紀錄</h3>
                <p>為提供您更貼心更友善的網站服務，我們將於您登入會員後記錄您瀏覽BuBuTrip網站的動線，以作為改善網站服務的參考依據。</p>
                <h3>隱私權保護</h3>
                <p>BuBuTrip團隊同意在未獲得會員書面（含電子郵件）同意以前，不對外揭露您於本站登錄或留存之個人資料，惟下列情況除外： 應司法機關或其他有權機關基於法定程序之提出要求；或會員有任何違反本會員條款之情形， BuBuTrip團隊合理懷疑有不法情事發生時，得主動將您的相關資料提供檢警調機關調查處理。對於您所登錄或留存之個人資料，您同意接受BuBuTrip之「隱私權保護」聲明 ( 請參閱「BuBuTrip隱私權保護聲明」 ) 。</p>
                <h3>會員條款之修改</h3>
                <p>BuBuTrip團隊保留隨時修改本會員條款之權利， 修正後之會員條款將於BuBuTrip網站相關網頁公告，並自公告之日起即時生效，不另作個別的通知。若您於網站公告修改或變更會員條款後繼續使用BuBuTrip網站 (http://www.bubutrip.com.tw) 所提供之服務，將視為您已閱讀並同意接受該等修改或變更。如果您不同意本會員條款的內容，您應立即通知BuBuTrip團隊並停止使用BuBuTrip網站服務。</p>
                <h3>服務中止與修改</h3>
                <p>BuBuTrip團隊保留隨時中止或更改各項服務內容，或終止任一會員帳戶服務之權利。無論任何情形，就中止或更改服務或終止會員帳戶服務之決定，BuBuTrip團隊對會員或第三人均不負任何賠償或補償責任。 您應瞭解並同意，BuBuTrip網站可能因公司、其他協力廠商或相關電信業者網路系統、軟硬體設備之故障或失靈或人為操作上之疏失而全部或部份中斷、暫時無法使用、遲延、或造成資料傳輸或儲存上之錯誤、或遭第三人侵入系統篡改或偽造變造資料等，BuBuTrip團隊對此均不負任何賠償責任。</p>
                <p>您瞭解BuBuTrip提供網站上的服務與資訊供會員使用，但不對任何服務或資訊傳送的遲延、儲存的故障以及任何資訊的刪除等利用服務或資訊之障礙負任何責任。</p>
                <h3>保管及通知義務</h3>
                <p>您有義務妥善保管在BuBuTrip網站註冊之帳號與密碼，並於每次使用完BuBuTrip網站所提供之服務後確實登出，以防他人盜用。您應為以此組帳號與密碼登入BuBuTrip網站後所進行之一切行為負責。為維護您自身權益，請勿將帳號與密碼洩露或提供予第三人知悉，或出借或轉讓他人使用，若因您保管疏失，而導致帳號、密碼遭他人非法使用時，BuBuTrip團隊將不負任何賠償責任。若您發現帳號或密碼遭人非法使用或有任何異常破壞使用安全之情形時，應立即通知BuBuTrip團隊， 若因未及時通知BuBuTrip團隊以致無法有效防止或修護時，您應自負全責。</p>
                <h3>風險承擔</h3>
                <p>您同意使用BuBuTrip各項服務係基於您的個人意願，並同意自負任何風險，包括因為自BuBuTrip網站下載資料或圖片，或自BuBuTrip服務中獲得之資料導致您的電腦系統損壞，或是發生任何資料流失等結果。</p>
                <h3>個人資料處理</h3>
                <p>對於您所登錄或留存之個人資料，您同意和泰汽車股份有限公司及其關係企業或其合作對象（下稱和泰集團），得於加入BuBuTrip會員、行銷、提供客戶服務、執行業務、研究分析、市場調查等目的內於台灣地區及和泰集團海外分支機構所在地蒐集、處理、保存、傳遞及使用該等資料，以提供使用者其他資訊或服務（含定期以電子郵件提供電子報）、或作成會員統計資料、或進行關於網路行為之調查或研究，或提供優惠訊息等行銷行為，或為任何之合法使用，截至前述蒐集目的消失或您主動請求BuBuTrip刪除、停止處理或利用您個人資料為止，但依據法令得或應繼續保存您個人資料者，則不在此限。您得自由選擇是否提供個人資料，但您若不願提供個人資料，將無法加入車主會員。您有權向BuBuTrip團隊查詢、閱覽或請求製給複本，或補正您的個人資料，亦得隨時<a href="mailto:BUBUTRIP@mail.hotaimotor.com.tw">洽BuBuTrip</a> 表示拒絕BuBuTrip團隊繼續蒐集、處理、利用或刪除您的個人資料。</p>
                <h3>智慧財產權</h3>
                <p>BuBuTrip網站上之所有著作及資料，其著作權、專利權、商標權、營業秘密、其他智慧財產權、所有權或其他權利，均為BuBuTrip團隊或其權利人所有，除事先經BuBuTrip團隊或其權利人之合法授權外，您不得擅自重製、 散布、 傳輸、改作、編輯、 租用、出售 或以其他任何形式、基於任何目的為不合法使用，否則應自負所有法律之責任。</p>
                <p>BuBuTrip網站之內容及程式為和泰汽車股份有限公司之智慧財產，未經和泰汽車股份有限公司授權，不得擅自複製、進行還原工程（ reverse engineering ）、解編 (de-compile) 或反向組譯 (disassemble) 任何功能或程式。BuBuTrip只提供您以登入的方式使用需會員資格的服務，若以其他任何方式進入BuBuTrip網站系統和泰汽車股份有限公司將追究相關之法律責任。</p>
                <h3>連結</h3>
                <p>BuBuTrip團隊在網站或所有服務相關網頁上所提供之所有連結，可能連結到其他個人、公司或組織之網站，提供該等連結之目的，僅係為便利您自行搜集或取得資訊，BuBuTrip團隊對於被連結之該等個人、公司或組織之網站上所提供之產品、服務或資訊，既不擔保其真實性、完整性、即時性或可信度，該等個人、公司或組織亦不因此而當然與BuBuTrip團隊有任何僱傭、委任、代理、合夥或其他類似之關係。</p>
                <h3>禁止從事違反法律規定之行為</h3>
                <p>BuBuTrip團隊就您的行為是否符合本會員條款，有最終決定權。若BuBuTrip團隊決定您的行為違反本會員條款或任何法令，您同意BuBuTrip團隊得隨時停止會員之帳號使用權或清除帳號，及停止使用BuBuTrip服務。您若有違反法律規定之情事，應自負法律責任。</p>
                <h3>損害賠償</h3>
                <p>若因您違反相關法令或違背本會員條款之任一條款，致BuBuTrip團隊或其關係企業、受僱人、受託人、代理人及其他相關履行輔助人因而受有損害或支出費用（包括但不限於因進行民事、刑事及行政程序所支出之律師費用等）時，您應負擔損害賠償責任或補償其費用。</p>
                <h3>個別條款之效力</h3>
                <p>本會員條款之全部或部分無效時，不影響其他條款之效力。</p>
                <h3>通知</h3>
                <p>您依本會員條款之約定而有通知BuBuTrip團隊之必要時，請以電子郵件方式寄送BuBuTrip團隊（與BuBuTrip團隊連繫之電子郵件為: <a href="mailto:BUBUTRIP@mail.hotaimotor.com.tw">BUBUTRIP@mail.hotaimotor.com.tw</a>）或電洽BuBuTrip 團隊(與BuBuTrip團隊之連繫電話為:0800-036036)，在BuBuTrip團隊未收到您的通知前，尚未發生通知之效力，故原約定不會因此而變更或受到任何影響。</p>
                <h3>準據法及管轄法院</h3>
                <p>本會員條款之解釋及適用、以及您因使用BuBuTrip網站服務而與BuBuTrip團隊間所生之權利義務關係，應依中華民國法令解釋適用之。若有涉訟或爭議，均同意以台北地方法院為第一審管轄法院。</p>
            </div>
        </div>
    </div>
    <!--/#tos-member-->

    <script>
    /* Placeholder polyfill for IE9-
     * @see https://github.com/mathiasbynens/jquery-placeholder
     */
    $(function() {

        $('input[placeholder], textarea[placeholder]').placeholder();

        $('form').on('submit', function(e) {
            e.preventDefault();
        });

        $('#reg-form .submit').on('click', function(e) {
            e.preventDefault();
            var frm = document.forms['reg-form'],
                email = frm.email.value,
                namelen = $.trim(frm.elements.name.value).length,
                pwlen = frm.passwd.value.length,
                pwmismatch = (frm.passwd.value != frm.passwd2.value),
                errors = [];

            if (email.length < 10 || email.indexOf('@') < 0) {
                errors.push("帳號 (Email)");
            }
            if (namelen < 2) {
                errors.push("暱稱 (至少2個字元)");
            }
            if (pwlen < 4) {
                errors.push("密碼 (至少4個字元)");
            } else if (pwmismatch) {
                errors.push("密碼與確認密碼不一樣");
            }
            if (errors.length > 0) {
                alert("請檢查下列欄位:\n- " + errors.join("\n- "));
                return;
            }
            if (!frm.agree.checked) {
                alert("請閱讀並同意 BuBuTrip 註冊服務條款");
                return;
            }

            var loading = $(this).data('loading'),
                now = App._now();
            if (typeof loading != 'undefined' && loading > (now - 3)) {
                return;
            }

            $(this).fadeTo(200, .25).data('loading', App._now());
            frm.ajax.value = "1";
            $.post(frm.action, $('#reg-form').serialize(), function(res) {
                $('#reg-form .submit').fadeTo(0, 1);
                if (res.success == 0) {
                    alert(res.msg);
                }
                if (res.success == 1) {
                    frm.reset();
                    $.fancybox.open('#confirmbox', {
                        closeBtn: false,
                        scrolling:false,
                        autoSize: false,
                        width: 624,
                        height: 243
                    });
                }
            }, 'json');
        });

        $('#confirmbox .bn-action, #confirmbox .checkCloseBtn').on('click', function() {
            $.fancybox.close();
            location.href = '/event/2015Anniversary/';
        });

        $('#btn-tos-member').on('click', function(e) {
            e.preventDefault();
            $.fancybox.open('#tos-member', {
                autoSize: false,
                width: 617,
                height: 450
            });
        });


    });
    </script>
</body>

</html>
