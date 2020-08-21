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

trait ForgetController
{

    public function postForget() {
        try {
            cb()->validation(['email'=>'required|email']);

            if($user = cb()->find("users",["email"=>request("email")])) {
                $token = Str::random(6);
                $linkToken = cb()->getAdminUrl("continue-reset/".$token);
                Cache::put("forget_".$token, $user->id, now()->addHours(12));

                Log::info("Someone trying reset password:\n
                        Time: ".date("Y-m-d H:i:s")."\n
                        IP: ".request()->ip()."\n
                        User Agent: ".request()->userAgent()."\n
                        Email Entered: ".request("email"));

                $mail = new MailHelper();
                $mail->to($user->email);
                $mail->sender(getSetting("forget_email_sender","noreply@".$_SERVER['SERVER_NAME']),cb()->getAppName());
                $mail->subject("Silakan Konfirmasi Lupa Password");
                $mail->content("
                    Hai $user->name,<br/><br>
                    Seseorang Dengan Detail: <br/>
                    Wantu = ".now()->format("Y-m-d H:i:s")."<br/>
                    IP Address = ".request()->ip()."<br/>
                    Browser = ".request()->userAgent()."<br/>
                    <p>
                        Telah mencoba mereset password. Jika itu kamu, silakan klik url dibawah ini: <br>
                        <a href='$linkToken' target='_blank'>$linkToken</a>
                    </p>
                    <br><br>
                    Terimakasih <br/>
                    ".cb()->getAppName()."
                ");
                $mail->send();

            } else {
                return cb()->redirectBack("Email yang anda masukan tidak tersedia");
            }

        }catch (CBValidationException $e) {
            return cb()->redirectBack($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e);
            return cb()->redirectBack(cbLang("something_went_wrong"));
        }

        return cb()->redirectBack("Kami telah mengirimkan instruksi melaui email anda. Silakan ikuti instruksi di dalam email","success");
    }

    public function getContinueReset($token) {
        if(Cache::has("forget_".$token)) {
            $id = Cache::get("forget_".$token);
            $newPassword = Str::random(6);
            cb()->update("users", $id, ["password"=>Hash::make($newPassword)]);

            $user = cb()->find("users",$id);

            $mail = new MailHelper();
            $mail->to($user->email);
            $mail->sender(getSetting("forget_email_sender","noreply@".$_SERVER['SERVER_NAME']),cb()->getAppName());
            $mail->subject("Ini Password Baru Anda");
            $mail->content("
                Hai $user->name,<br/><br>
                Reset password telah berhasil. Ini password baru Anda: <br>
                <h2>$newPassword</h2>
                
                <br><br>
                Terimakasih <br/>
                ".cb()->getAppName()."
            ");
            $mail->send();

            return cb()->redirect(cb()->getAdminUrl("login"),"Kami telah mengirim password baru melaui email anda. Silakan periksa di inbox Anda atau spambox","success");
        } else {
            return cb()->redirect(cb()->getAdminUrl("login"),"Sepertinya url telah kedaluwarsa!");
        }
    }

}