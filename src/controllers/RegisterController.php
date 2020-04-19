<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/14/2019
 * Time: 8:45 PM
 */

namespace ersaazis\cb\controllers;

use ersaazis\cb\exceptions\CBValidationException;
use ersaazis\cb\helpers\MailHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait RegisterController
{

    public function postRegister() {
        try {
            cb()->validation([
                "name"=>"required|string|max:50",
                "email"=>"required|email|max:50",
                "password"=>"required|max:25",
                "captcha"=>"required|integer"
            ]);

            if(Session::get("captcha_result") != request("captcha")) {
                return cb()->redirectBack("Captcha yang Anda masukkan salah!");
            }

            if($user = cb()->find("users",["email"=>request("email")])) {
                return cb()->redirectBack("Email yang Anda input sudah terdaftar!");
            }
            $token = Str::random(6);
            $linkToken = cb()->getAdminUrl("continue-register/".$token);
            if(getSetting("register_mail_verification")) {
                Cache::put("register_".$token,[
                    "name"=>request("name"),
                    "email"=>request("email"),
                    "password"=>request("password")
                ],now()->addHours(24));

                $mail = new MailHelper();
                $mail->to(request("email"));
                $mail->sender(getSetting("register_mail_verification_sender","noreply@".$_SERVER['SERVER_NAME']),cb()->getAppName());
                $mail->subject("Verifikasi Email Anda");
                $mail->content("
                Hai ".request("name")."<br/>
                Terimakasih telah mendaftar di ".cb()->getAppName()." untuk melanjutkan pendaftaran, silakan klik link dibawah ini: <br/>
                <p>$linkToken</p>
                <br>
                Terimakasih <br>
                ".cb()->getAppName()."
                ");
                $mail->send();
            } else {
                DB::table("users")
                    ->insert([
                        "created_at"=>date("Y-m-d H:i:s"),
                        "name"=> request("name"),
                        "email"=> request("email"),
                        "password"=>Hash::make(request("password")),
                        "cb_roles_id"=> getSetting("register_as_role")
                    ]);

                return cb()->redirect(cb()->getAdminUrl("login"),"Terima kasih sudah mendaftar. Sekarang Anda dapat login =)","success");
            }

        }catch (CBValidationException $e) {
            return cb()->redirectBack($e->getMessage());
        }

        return cb()->redirectBack("Kami telah mengirimi Anda email konfirmasi. Silakan klik link di dalam email","success");
    }

    public function postContinueRegister($token) {
        if($token = Cache::get("register_".$token)) {
            DB::table("users")
                ->insert([
                    "created_at"=>date("Y-m-d H:i:s"),
                    "name"=> $token['name'],
                    "email"=> $token['email'],
                    "password"=>Hash::make($token['password']),
                    "cb_roles_id"=> getSetting("register_as_role")
                ]);

            return cb()->redirect(cb()->getAdminUrl("login"),"Terima kasih sudah mendaftar. Sekarang Anda dapat login =)","success");
        } else {
            return cb()->redirect(cb()->getAdminUrl("login"),"Sepertinya URL telah kedaluwarsa!");
        }
    }

}