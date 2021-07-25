<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('genUuid')) {
    function genUuid()
    {
        return strtoupper(sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        ));
    }
}

if (!function_exists('cek_session')) {
    function cek_session($idMenu)
    {
        $modules = array();
        $CI = get_instance();
        if (!$CI->session->userdata('login')) {
            redirect(base_url() . 'auth/login/logout');
            exit(0);
        } else {
            $sess       = $CI->session->userdata('login');
            $modules    = getMenu($sess['user_id']);
            $dateNow    = date("YmdHis");
            $expireDate = $sess['expiredate'];
            if ((int)$dateNow > (int)$expireDate) {
                echo '<script>alert("Session kamu telah habis, silakan login kembali"); window.location.replace("' . base_url('auth/login/logout') . '"); </script>';
            } else {
                $moduleDetailIds = array();
                foreach ($modules as $module) {
                    $moduleDetailIds[] = $module['modul_detail_id'];
                }
                cek_module($moduleDetailIds, $idMenu);
            }
            return $modules;
        }
    }

    function getMenu($user_id)
    {
        $CI = get_instance();
        $CI->load->model('auth/ModelLogin');
        $sessionCurrentApp = $CI->session->userdata('current_app');
        return $CI->ModelLogin->getMenuAppl($user_id);
    }

    function cek_module($moduleDetailIds, $idMenu)
    {
        $moduleDetailId = $idMenu;

        for ($i = 0; $i < COUNT($moduleDetailIds); $i++) {
            if (strpos($moduleDetailId, $moduleDetailIds[$i]) !== FALSE) {
                return true;
            }
        }

        if($idMenu == "DASHBOARD"){
            return true;
        }else{
            echo '<script>alert("Kamu tidak memiliki akses untuk halaman ini"); window.location.replace("' . base_url('home') . '"); </script>';
            return false;
        }
    }
}

if (!function_exists('genPdf')) {
    function genPdf($url, $path, $nameFile)
    {
        $respons = array();
        $command = "/usr/bin/wkhtmltopdf --page-size A4 --margin-top 0 --margin-bottom 0 --margin-left 0 --margin-right 0";
        $assetPdf = "assets/pdf".$path;
        if (!file_exists($assetPdf)) {
            mkdir($assetPdf, 0755, true);
        }
        $pathFileName = $assetPdf."".$nameFile;
        exec($command." '".$url."' '".$pathFileName."'", $output, $return);
        if (!$return) {
            $respons['status']  = true;
            $respons['remarks'] = "Successfully generate";
            $respons['error']   = null;
            $respons['path']    = $pathFileName;
        }else{
            $respons['status']  = false;
            $respons['remarks'] = "Failed generate";
            $respons['error']   = $return;
            $respons['path']    = $pathFileName;
        }
        return $respons;
    }
}

if (!function_exists('sendMail')) {
    function sendMail($fromMail, $fromName, $to, $cc, $urlAttachments, $subjet, $body)
    {
        $CI = get_instance();
        $respons = array();

        $config = [
            'mailtype'      => 'html',
            'charset'       => 'iso-8859-1',
            'protocol'      => 'smtp',
            'smtp_host'     => 'smtp.googlemail.com',
            'smtp_user'     => 'speedlab.lentera@gmail.com',
            'smtp_pass'     => 'lbgg hbxd nxnn ulpt',
            'smtp_crypto'   => 'tls',
            'smtp_port'     => 587,
            'crlf'          => "\r\n",
            'wordwrap'      => TRUE,
            'newline'       => "\r\n"
        ];

        $CI->load->library('email', $config);
        $CI->email->from($fromMail, $fromName);
        $CI->email->to($to);
        if($cc != "" OR $cc != null){
            $CI->email->cc($cc);
        }
        if($urlAttachments != null OR COUNT($urlAttachments) < 1){
            for($i = 0; $i<COUNT($urlAttachments); $i++){
                $CI->email->attach($urlAttachments[$i]);
                $respons['urlAttachments']  = $urlAttachments[$i];
            }
        }

        $CI->email->subject($subjet);
        $CI->email->message($body);
        $return = $CI->email->send();
        if ($return) {
            $respons['status']  = true;
            $respons['remarks'] = "Email Sent Successfully";
            $respons['error']   = null;
        }else{
            $respons['status']  = false;
            $respons['remarks'] = "Failed to send email";
            $respons['error']   = $CI->email->print_debugger(array('headers'));
        }
        $respons['return']  = $return;
        return $respons;
    }
}

if (!function_exists('genQRCode')) {
    function genQRCode($data, $path, $nameFile)
    {
        $CI = get_instance();
        $CI->load->library('ciqrcode');
        $respons = array();

        $assetQRCode = "assets/qrcode".$path;
        if (!file_exists($assetQRCode)) {
            mkdir($assetQRCode, 0755, true);
        }

        $config['cacheable']    = true; 
        $config['imagedir']     = $assetQRCode; 
        $config['quality']      = true; 
        $config['size']         = '1024';
        $config['black']        = array(224,255,255);
        $config['white']        = array(70,130,180);
        $CI->ciqrcode->initialize($config);

        $image_name =   $nameFile.'.png';
        $params['data']     = $data; 
        $params['level']    = 'H'; 
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; 
        $resPath = $CI->ciqrcode->generate($params);
        $pathFile = base_url($config['imagedir'].$image_name);

        if ($resPath) {
            $respons['status']  = true;
            $respons['remarks'] = "Successfully generate";
            $respons['path']    = $pathFile;
        }else{
            $respons['status']  = false;
            $respons['remarks'] = "Failed generate";
            $respons['path']    = $pathFile;
        }
        return $respons;
    }
}
if (!function_exists('json')) {
    function json($data, $status = true, $remarks = '') {
        header('Content-Type: application/json');
        echo json_encode([
            'status_json'   => $status,
            'data'          => $data,
            'remarks'       => $remarks
        ]);
    }
}
if (!function_exists('level')) {
    function level() {
        $ci = get_instance();
        $session = $ci->session->userdata('login');
        $mg = $ci->ModelGeneral;
        $user = $mg->getUser($session['user_id']);
        $manager = $mg->getManager($user['departement_id']);
        if($user['position_id'] == 13 || $user['user_id'] == 1) {
            $level = 1;
        } elseif($user['position_id'] == $manager['id']) {
            $level = 2;
        } else {
            $level = 3;
        }
        return $level;
    }
}