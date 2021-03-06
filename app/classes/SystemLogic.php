<?php

/**
 * Created by PhpStorm.
 * User: sven
 * Date: 2017/7/7 0007
 * Time: 下午 3:56
 */

namespace main\app\classes;

use main\app\model\user\UserGroupModel;
use main\app\model\project\ProjectUserRoleModel;
use main\app\model\user\UserModel;
use main\app\model\SettingModel;

class SystemLogic
{
    public function getUserEmailByProjectRole($projectIds, $roleIds)
    {
        if (empty($projectIds)) {
            return [];
        }
        $userProjectRoleModel = new ProjectUserRoleModel();
        $userIds = $userProjectRoleModel->getUidsByProjectRole($projectIds, $roleIds);

        $userModel = new UserModel();
        $emails = $userModel->getFieldByIds('email', $userIds);
        return $emails;
    }

    public function getUserEmailByProject($projectIds)
    {
        if (empty($projectIds)) {
            return [];
        }
        $userProjectRoleModel = new ProjectUserRoleModel();
        $userIds = $userProjectRoleModel->getUidsByProjectIds($projectIds);

        $userModel = new UserModel();
        $emails = $userModel->getFieldByIds('email', $userIds);
        return $emails;
    }

    public function getUserEmailByGroup($groups)
    {
        if (empty($groups)) {
            return [];
        }
        $userGroupModel = new UserGroupModel();
        $userIds = $userGroupModel->getUserIdsByGroups($groups);
        $userModel = new UserModel();
        $emails = $userModel->getFieldByIds('email', $userIds);
        return $emails;
    }

    /**
     * 发送邮件
     * @param $recipients
     * @param $title
     * @param $content
     * @param string $replyTo
     * @param string $contentType
     * @return array
     * @throws \Exception
     */
    public function mail($recipients, $title, $content, $replyTo = '', $contentType = 'html')
    {
        $settingModel = new SettingModel();
        $settings = $settingModel->getSettingByModule('mail');
        $config = [];
        if (empty($settings)) {
            return [false, 'fetch mail setting error'];
        }
        foreach ($settings as $s) {
            $config[$s['_key']] = $settingModel->formatValue($s);
        }
        unset($settings);
        ini_set("magic_quotes_runtime", 0);
        require_once PRE_APP_PATH . '/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
        try {
            $mail = new \PHPMailer(true);
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
            $mail->SMTPAuth = true; //开启认证
            $mail->Port = $config['mail_port'];
            $mail->SMTPDebug = 0;
            $mail->Host = $config['mail_host'];    //"smtp.exmail.qq.com";
            $mail->Username = $config['mail_account'];     // "chaoduo.wei@ismond.com";
            $mail->Password = $config['mail_password'];    // "";
            $mail->Timeout = isset($config['timeout']) ? $config['timeout'] : 20;
            $mail->From = $config['send_mailer'];
            $mail->FromName = $config['send_mailer'];
            if (!empty($recipients) && is_array($recipients)) {
                foreach ($recipients as $r) {
                    $mail->AddAddress($r);
                }
            } else {
                $mail->AddAddress($recipients);
            }
            $mail->Subject = $title;
            $mail->Body = $content;
            if (!empty($replyTo)) {
                $mail->addReplyTo($replyTo);
            }

            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
            $mail->WordWrap = 80; // 设置每行字符串的长度
            $mail->IsHTML($contentType == 'html');
            $ret = $mail->Send();
            // print_r($mail);
            if (!$ret) {
                $msg = 'Mailer Error: ' . $mail->ErrorInfo;
                return [false, $msg];
            }
        } catch (\phpmailerException $e) {
            $msg = "邮件发送失败：" . $e->errorMessage();
            return [false, $msg];
        } catch (\Exception $e) {
            $msg = "邮件发送失败：" . $e->getMessage();
            return [false, $msg];
        }
        return [true, 'ok'];
    }
}
