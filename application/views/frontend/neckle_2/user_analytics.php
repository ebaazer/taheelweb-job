<script src="<?php echo base_url(); ?>assets/js/es5.js"></script>

<?php
#------------------------------------------
#  user analytics, save the database
#------------------------------------------
//$status = $this->db->select('*')->from('settings')->where('settings_id', 8)->get()->row();
$status = $this->db->get_where('settings', array('type' => 'user_analytics'))->row()->description;
//echo 'user_analytics ==> ' . $status;

if ($status == 'active') {

    //$ip = $_SERVER['REMOTE_ADDR'];

    function getClientIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    $ipaddress = getClientIP();

    function ip_details($ip) {
        $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
        $details = json_decode($json, true);
        return $details;
    }

    $info = ip_details($ipaddress);
    //echo $info['city'];

    /*
    function get_content($URL) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $URL);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
     */

//$gmail = '84e777bdef1bbe';
//$hotmail = 'c4444e65173f4b';
//$ForIp_0 = '3ff985d3f082ef';
//$ForIp_1 = '20466027914498';
//$ForIp_2 = 'a5022ee7b31c93';
//$ForIp_3 = 'f95866585211fb';

    $month = date('m-Y');
    $token_array = array('3ff985d3f082ef', '20466027914498', 'a5022ee7b31c93', '84e777bdef1bbe', 'c4444e65173f4b', 'f95866585211fb');

    $inserted_manth = $this->db->get_where('ipinfoio', array('date' => $month))->num_rows();

    if ($inserted_manth > 0) {

        $TOKEN = $this->db->select("token")
                        ->from('ipinfoio')
                        ->where('date', $month)
                        ->where('used <', '50000')
                        ->limit(1)
                        ->get()
                        ->row()->token;
    } else {
        foreach ($token_array as $token_array_row) {
            $data['token'] = $token_array_row;
            $data['date'] = $month;
            $data['used'] = 0;

            $this->db->insert('ipinfoio', $data);
        }

        $TOKEN = $this->db->select("token")
                        ->from('ipinfoio')
                        ->where('date', $month)
                        ->where('used <', '50000')
                        ->limit(1)
                        ->get()
                        ->row()->token;
    }

    $TOKEN_data = $this->db->get_where('ipinfoio', array('token' => $TOKEN, 'date' => $month))->row();
    $data_up_to['used'] = $TOKEN_data->used + 1;

    $this->db->where('id', $TOKEN_data->id);
    $this->db->update('ipinfoio', $data_up_to);

    //echo $token;
    //$TOKEN = $gmail;
    //$TOKEN = $hotmail;
    //$info = (object) json_decode(get_content("https://ipinfo.io/{$ip}/json"));
    //$info = json_decode(get_content("https://ipinfo.io/{$ip}?token=$TOKEN"));

    echo json_decode($info);

    if ($page_name == 'careers_single') {
        $type = 'careers_single';
    } elseif ($page_name == 'university_profile') {
        $type = 'university';
    } elseif ($page_name == 'blog_details') {
        $type = 'blog';
    } else {
        $type = 'page';
    }


    if ($this->session->userdata('userweb_login') == 1) {
        $user_id = $this->session->userdata('userweb_id');
    } else {
        $user_id = 0;
    }

    require_once 'lib/Mobile_Detect/Mobile_Detect.php';
    $detect = new Mobile_Detect;

    $device = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

    if ($detect->isiPhone()) {
        $device_type = 'elseifiPhone';
    } elseif ($detect->isBlackBerry()) {
        $device_type = 'elseifBlackBerry';
    } elseif ($detect->isHTC()) {
        $device_type = 'HTC';
    } elseif ($detect->isNexus()) {
        $device_type = 'Nexus';
    } elseif ($detect->isDell()) {
        $device_type = 'Dell';
    } elseif ($detect->isMotorola()) {
        $device_type = 'Motorola';
    } elseif ($detect->isSamsung()) {
        $device_type = 'Samsung';
    } elseif ($detect->isLG()) {
        $device_type = 'LG';
    } elseif ($detect->isSony()) {
        $device_type = 'Sony';
    } elseif ($detect->isAsus()) {
        $device_type = 'Asus';
    } elseif ($detect->isNokiaLumia()) {
        $device_type = 'NokiaLumia';
    } elseif ($detect->isMicromax()) {
        $device_type = 'Micromax';
    } elseif ($detect->isPalm()) {
        $device_type = 'Palm';
    } elseif ($detect->isVertu()) {
        $device_type = 'Vertu';
    } elseif ($detect->isPantech()) {
        $device_type = 'Pantech';
    } elseif ($detect->isFly()) {
        $device_type = 'Fly';
    } elseif ($detect->isWiko()) {
        $device_type = 'Wiko';
    } elseif ($detect->isiMobile()) {
        $device_type = 'iMobile';
    } elseif ($detect->isSimValley()) {
        $device_type = 'SimValley';
    } elseif ($detect->isWolfgang()) {
        $device_type = 'Wolfgang';
    } elseif ($detect->isAlcatel()) {
        $device_type = 'Alcatel';
    } elseif ($detect->isNintendo()) {
        $device_type = 'Nintendo';
    } elseif ($detect->isAmoi()) {
        $device_type = 'Amoi';
    } elseif ($detect->isINQ()) {
        $device_type = 'INQ';
    } elseif ($detect->isOnePlus()) {
        $device_type = 'OnePlus';
    } elseif ($detect->isGenericPhone()) {
        $device_type = 'GenericPhone';
    } elseif ($detect->isiPad()) {
        $device_type = 'iPad';
    } elseif ($detect->isNexusTablet()) {
        $device_type = 'NexusTablet';
    } elseif ($detect->isGoogleTablet()) {
        $device_type = 'GoogleTablet';
    } elseif ($detect->isSamsungTablet()) {
        $device_type = 'SamsungTablet';
    } elseif ($detect->isKindle()) {
        $device_type = 'Kindle';
    } elseif ($detect->isSurfaceTablet()) {
        $device_type = 'SurfaceTablet';
    } elseif ($detect->isHPTablet()) {
        $device_type = 'HPTablet';
    } elseif ($detect->isAsusTablet()) {
        $device_type = 'AsusTablet';
    } elseif ($detect->isBlackBerryTablet()) {
        $device_type = 'BlackBerryTablet';
    } elseif ($detect->isHTCtablet()) {
        $device_type = 'HTCtablet';
    } elseif ($detect->isMotorolaTablet()) {
        $device_type = 'MotorolaTablet';
    } elseif ($detect->isNookTablet()) {
        $device_type = 'NookTablet';
    } elseif ($detect->isAcerTablet()) {
        $device_type = 'AcerTablet';
    } elseif ($detect->isToshibaTablet()) {
        $device_type = 'ToshibaTablet';
    } elseif ($detect->isLGTablet()) {
        $device_type = 'LGTablet';
    } elseif ($detect->isFujitsuTablet()) {
        $device_type = 'FujitsuTablet';
    } elseif ($detect->isPrestigioTablet()) {
        $device_type = 'PrestigioTablet';
    } elseif ($detect->isLenovoTablet()) {
        $device_type = 'LenovoTablet';
    } elseif ($detect->isDellTablet()) {
        $device_type = 'DellTablet';
    } elseif ($detect->isYarvikTablet()) {
        $device_type = 'YarvikTablet';
    } elseif ($detect->isMedionTablet()) {
        $device_type = 'MedionTablet';
    } elseif ($detect->isArnovaTablet()) {
        $device_type = 'ArnovaTablet';
    } elseif ($detect->isIntensoTablet()) {
        $device_type = 'IntensoTablet';
    } elseif ($detect->isIRUTablet()) {
        $device_type = 'IRUTablet';
    } elseif ($detect->isMegafonTablet()) {
        $device_type = 'MegafonTablet';
    } elseif ($detect->isEbodaTablet()) {
        $device_type = 'EbodaTablet';
    } elseif ($detect->isAllViewTablet()) {
        $device_type = 'AllViewTablet';
    } elseif ($detect->isArchosTablet()) {
        $device_type = 'ArchosTablet';
    } elseif ($detect->isAinolTablet()) {
        $device_type = 'AinolTablet';
    } elseif ($detect->isNokiaLumiaTablet()) {
        $device_type = 'NokiaLumiaTablet';
    } elseif ($detect->isSonyTablet()) {
        $device_type = 'SonyTablet';
    } elseif ($detect->isPhilipsTablet()) {
        $device_type = 'PhilipsTablet';
    } elseif ($detect->isCubeTablet()) {
        $device_type = 'CubeTablet';
    } elseif ($detect->isCobyTablet()) {
        $device_type = 'CobyTablet';
    } elseif ($detect->isMIDTablet()) {
        $device_type = 'MIDTablet';
    } elseif ($detect->isMSITablet()) {
        $device_type = 'MSITablet';
    } elseif ($detect->isSMiTTablet()) {
        $device_type = 'SMiTTablet';
    } elseif ($detect->isRockChipTablet()) {
        $device_type = 'RockChipTablet';
    } elseif ($detect->isFlyTablet()) {
        $device_type = 'FlyTablet';
    } elseif ($detect->isbqTablet()) {
        $device_type = 'bqTablet';
    } elseif ($detect->isHuaweiTablet()) {
        $device_type = 'HuaweiTablet';
    } elseif ($detect->isNecTablet()) {
        $device_type = 'NecTablet';
    } elseif ($detect->isPantechTablet()) {
        $device_type = 'PantechTablet';
    } elseif ($detect->isBronchoTablet()) {
        $device_type = 'BronchoTablet';
    } elseif ($detect->isVersusTablet()) {
        $device_type = 'VersusTablet';
    } elseif ($detect->isZyncTablet()) {
        $device_type = 'ZyncTablet';
    } elseif ($detect->isPositivoTablet()) {
        $device_type = 'PositivoTablet';
    } elseif ($detect->isNabiTablet()) {
        $device_type = 'NabiTablet';
    } elseif ($detect->isKoboTablet()) {
        $device_type = 'KoboTablet';
    } elseif ($detect->isDanewTablet()) {
        $device_type = 'DanewTablet';
    } elseif ($detect->isTexetTablet()) {
        $device_type = 'TexetTablet';
    } elseif ($detect->isPlaystationTablet()) {
        $device_type = 'PlaystationTablet';
    } elseif ($detect->isTrekstorTablet()) {
        $device_type = 'TrekstorTablet';
    } elseif ($detect->isPyleAudioTablet()) {
        $device_type = 'PyleAudioTablet';
    } elseif ($detect->isAdvanTablet()) {
        $device_type = 'AdvanTablet';
    } elseif ($detect->isDanyTechTablet()) {
        $device_type = 'DanyTechTablet';
    } elseif ($detect->isGalapadTablet()) {
        $device_type = 'GalapadTablet';
    } elseif ($detect->isMicromaxTablet()) {
        $device_type = 'MicromaxTablet';
    } elseif ($detect->isKarbonnTablet()) {
        $device_type = 'KarbonnTablet';
    } elseif ($detect->isAllFineTablet()) {
        $device_type = 'AllFineTablet';
    } elseif ($detect->isPROSCANTablet()) {
        $device_type = 'PROSCANTablet';
    } elseif ($detect->isYONESTablet()) {
        $device_type = 'YONESTablet';
    } elseif ($detect->isChangJiaTablet()) {
        $device_type = 'ChangJiaTablet';
    } elseif ($detect->isGUTablet()) {
        $device_type = 'GUTablet';
    } elseif ($detect->isPointOfViewTablet()) {
        $device_type = 'PointOfViewTablet';
    } elseif ($detect->isOvermaxTablet()) {
        $device_type = 'OvermaxTablet';
    } elseif ($detect->isHCLTablet()) {
        $device_type = 'HCLTablet';
    } elseif ($detect->isDPSTablet()) {
        $device_type = 'DPSTablet';
    } elseif ($detect->isVistureTablet()) {
        $device_type = 'VistureTablet';
    } elseif ($detect->isCrestaTablet()) {
        $device_type = 'CrestaTablet';
    } elseif ($detect->isMediatekTablet()) {
        $device_type = 'MediatekTablet';
    } elseif ($detect->isConcordeTablet()) {
        $device_type = 'ConcordeTablet';
    } elseif ($detect->isGoCleverTablet()) {
        $device_type = 'GoCleverTablet';
    } elseif ($detect->isModecomTablet()) {
        $device_type = 'ModecomTablet';
    } elseif ($detect->isVoninoTablet()) {
        $device_type = 'VoninoTablet';
    } elseif ($detect->isECSTablet()) {
        $device_type = 'ECSTablet';
    } elseif ($detect->isStorexTablet()) {
        $device_type = 'StorexTablet';
    } elseif ($detect->isVodafoneTablet()) {
        $device_type = 'VodafoneTablet';
    } elseif ($detect->isEssentielBTablet()) {
        $device_type = 'EssentielBTablet';
    } elseif ($detect->isRossMoorTablet()) {
        $device_type = 'RossMoorTablet';
    } elseif ($detect->isiMobileTablet()) {
        $device_type = 'iMobileTablet';
    } elseif ($detect->isTolinoTablet()) {
        $device_type = 'TolinoTablet';
    } elseif ($detect->isAudioSonicTablet()) {
        $device_type = 'AudioSonicTablet';
    } elseif ($detect->isAMPETablet()) {
        $device_type = 'AMPETablet';
    } elseif ($detect->isSkkTablet()) {
        $device_type = 'SkkTablet';
    } elseif ($detect->isTecnoTablet()) {
        $device_type = 'TecnoTablet';
    } elseif ($detect->isJXDTablet()) {
        $device_type = 'JXDTablet';
    } elseif ($detect->isiJoyTablet()) {
        $device_type = 'iJoyTablet';
    } elseif ($detect->isFX2Tablet()) {
        $device_type = 'FX2Tablet';
    } elseif ($detect->isXoroTablet()) {
        $device_type = 'XoroTablet';
    } elseif ($detect->isViewsonicTablet()) {
        $device_type = 'ViewsonicTablet';
    } elseif ($detect->isVerizonTablet()) {
        $device_type = 'VerizonTablet';
    } elseif ($detect->isOdysTablet()) {
        $device_type = 'OdysTablet';
    } elseif ($detect->isCaptivaTablet()) {
        $device_type = 'CaptivaTablet';
    } elseif ($detect->isIconbitTablet()) {
        $device_type = 'IconbitTablet';
    } elseif ($detect->isTeclastTablet()) {
        $device_type = 'TeclastTablet';
    } elseif ($detect->isOndaTablet()) {
        $device_type = 'OndaTablet';
    } elseif ($detect->isJaytechTablet()) {
        $device_type = 'JaytechTablet';
    } elseif ($detect->isBlaupunktTablet()) {
        $device_type = 'BlaupunktTablet';
    } elseif ($detect->isDigmaTablet()) {
        $device_type = 'DigmaTablet';
    } elseif ($detect->isEvolioTablet()) {
        $device_type = 'EvolioTablet';
    } elseif ($detect->isLavaTablet()) {
        $device_type = 'LavaTablet';
    } elseif ($detect->isAocTablet()) {
        $device_type = 'AocTablet';
    } elseif ($detect->isMpmanTablet()) {
        $device_type = 'MpmanTablet';
    } elseif ($detect->isCelkonTablet()) {
        $device_type = 'CelkonTablet';
    } elseif ($detect->isWolderTablet()) {
        $device_type = 'WolderTablet';
    } elseif ($detect->isMediacomTablet()) {
        $device_type = 'MediacomTablet';
    } elseif ($detect->isMiTablet()) {
        $device_type = 'MiTablet';
    } elseif ($detect->isNibiruTablet()) {
        $device_type = 'NibiruTablet';
    } elseif ($detect->isNexoTablet()) {
        $device_type = 'NexoTablet';
    } elseif ($detect->isLeaderTablet()) {
        $device_type = 'LeaderTablet';
    } elseif ($detect->isUbislateTablet()) {
        $device_type = 'UbislateTablet';
    } elseif ($detect->isPocketBookTablet()) {
        $device_type = 'PocketBookTablet';
    } elseif ($detect->isKocasoTablet()) {
        $device_type = 'KocasoTablet';
    } elseif ($detect->isHisenseTablet()) {
        $device_type = 'HisenseTablet';
    } elseif ($detect->isHudl()) {
        $device_type = 'Hudl';
    } elseif ($detect->isTelstraTablet()) {
        $device_type = 'TelstraTablet';
    } elseif ($detect->isGenericTablet()) {
        $device_type = 'GenericTablet';
    } else {
        $device_type = 'Unknown device type';
    }


    if ($detect->isAndroidOS()) {
        $system_type = 'AndroidOS';
    } elseif ($detect->isBlackBerryOS()) {
        $system_type = 'BlackBerryOS';
    } elseif ($detect->isPalmOS()) {
        $system_type = 'PalmOS';
    } elseif ($detect->isSymbianOS()) {
        $system_type = 'SymbianOS';
    } elseif ($detect->isWindowsMobileOS()) {
        $system_type = 'WindowsMobileOS';
    } elseif ($detect->isWindowsPhoneOS()) {
        $system_type = 'WindowsPhoneOS';
    } elseif ($detect->isiOS()) {
        $system_type = 'iOS';
    } elseif ($detect->isiPadOS()) {
        $system_type = 'iPadOS';
    } elseif ($detect->isMeeGoOS()) {
        $system_type = 'MeeGoOS';
    } elseif ($detect->isMaemoOS()) {
        $system_type = 'MaemoOS';
    } elseif ($detect->isJavaOS()) {
        $system_type = 'JavaOS';
    } elseif ($detect->iswebOS()) {
        $system_type = 'webOS';
    } elseif ($detect->isbadaOS()) {
        $system_type = 'badaOS';
    } elseif ($detect->isBREWOS()) {
        $system_type = 'BREWOS';
    } else {
        $system_type = 'Unknown system';
    }


    if ($detect->isChrome()) {
        $browser_type = 'Chrome';
        $version_browser = $detect->version('Chrome');
    } elseif ($detect->isDolfin()) {
        $browser_type = 'Dolfin';
        $version_browser = $detect->version('Dolfin');
    } elseif ($detect->isOpera()) {
        $browser_type = 'Opera';
        $version_browser = $detect->version('Opera');
    } elseif ($detect->isSkyfire()) {
        $browser_type = 'Skyfire';
        $version_browser = $detect->version('Skyfire');
    } elseif ($detect->isEdge()) {
        $browser_type = 'Edge';
        $version_browser = $detect->version('Edge');
    } elseif ($detect->isIE()) {
        $browser_type = 'IE';
        $version_browser = $detect->version('IE');
    } elseif ($detect->isFirefox()) {
        $browser_type = 'Firefox';
        $version_browser = $detect->version('Firefox');
    } elseif ($detect->isBolt()) {
        $browser_type = 'Bolt';
        $version_browser = $detect->version('Bolt');
    } elseif ($detect->isTeaShark()) {
        $browser_type = 'TeaShark';
        $version_browser = $detect->version('TeaShark');
    } elseif ($detect->isBlazer()) {
        $browser_type = 'Blazer';
        $version_browser = $detect->version('Blazer');
    } elseif ($detect->isSafari()) {
        $browser_type = 'Safari';
        $version_browser = $detect->version('Safari');
    } elseif ($detect->isWeChat()) {
        $browser_type = 'WeChat';
        $version_browser = $detect->version('WeChat');
    } elseif ($detect->isUCBrowser()) {
        $browser_type = 'UCBrowser';
        $version_browser = $detect->version('UCBrowser');
    } elseif ($detect->isbaiduboxapp()) {
        $browser_type = 'baiduboxapp';
        $version_browser = $detect->version('baiduboxapp');
    } elseif ($detect->isbaidubrowser()) {
        $browser_type = 'baidubrowser';
        $version_browser = $detect->version('baidubrowser');
    } elseif ($detect->isDiigoBrowser()) {
        $browser_type = 'DiigoBrowser';
        $version_browser = $detect->version('DiigoBrowser');
    } elseif ($detect->isMercury()) {
        $browser_type = 'Mercury';
        $version_browser = $detect->version('Mercury');
    } elseif ($detect->isObigoBrowser()) {
        $browser_type = 'ObigoBrowser';
        $version_browser = $detect->version('ObigoBrowser');
    } elseif ($detect->isNetFront()) {
        $browser_type = 'NetFront';
        $version_browser = $detect->version('NetFront');
    } elseif ($detect->isGenericBrowser()) {
        $browser_type = 'GenericBrowser';
        $version_browser = $detect->version('GenericBrowser');
    } elseif ($detect->isPaleMoon()) {
        $browser_type = 'PaleMoon';
        $version_browser = $detect->version('PaleMoon');
    } else {
        $browser_type = 'Unknown browser';
        $version_browser = 'Unknown version browser';
    }


    if ($device == 'mobile' || $device == 'tablet') {
        $device_type;
        $system_type;
        $browser_type;
        $version_browser;
    }

    if ($device == 'computer') {
        $device_type = null;
    }

    $news_id = $this->uri->segment(3);
    $link = base_url(uri_string());

    $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, "SA");
    $timezone = new DateTimeZone(end($timezones));
    $datetime = new DateTime('now', $timezone);
    $nowtime = $datetime->format('Y-m-d H:i:s');
    ?>

    <script type="text/javascript">
        $(document).ready(function () {
            var result = bowser.getParser(window.navigator.userAgent);
            var browser_type = result.parsedResult.browser.name;
            var version_browser = result.parsedResult.browser.version;
            var system_type = result.parsedResult.os.name;
            //console.log(browser_type);

            //console.log('<?php echo $info['city']; ?>');

            var ip = '<?php echo $ip; ?>';
            var country = '<?php echo $info['country']; ?>';
            var city = '<?php echo $info['city']; ?>';
            var user_id = '<?php echo $user_id; ?>';
            var link = '<?php echo $link; ?>';
            var type = '<?php echo $type; ?>';
            var news_id = '<?php echo $news_id; ?>';
            var date_time = '<?php echo $nowtime; ?>';
            var browser = '<?php echo $this->input->user_agent(); ?>';
            var session = '<?php echo session_id(); ?>';
            var device = '<?php echo $device; ?>';
            var device_type = '<?php echo $device_type; ?>';
            var browser_type = browser_type;
            var version_browser = version_browser;
            var system_type = system_type;
            var loc = '<?php echo $info['loc']; ?>';
            var postal = '<?php echo $info['postal']; ?>';
            var region = '<?php echo $info['region']; ?>';
            var country_name = '<?php echo $info['country_name']; ?>';
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>home/user_analiytics_add',
                data: {
                    ip: ip,
                    country: country,
                    country_name: country_name,
                    city: city,
                    loc: loc,
                    postal: postal,
                    region: region,
                    user_id: user_id,
                    link: link,
                    type: type,
                    news_id: news_id,
                    date_time: date_time,
                    browser: browser,
                    session: session,
                    device: device,
                    device_type: device_type,
                    browser_type: browser_type,
                    version_browser: version_browser,
                    system_type: system_type

                },
                success: function (response) {
                    console.log('Done Send');
                }
            });
        });
    </script> 

    <?php
}

#------------------------------------------
#  user analytics, save the database 
#------------------------------------------
?>