<?php

namespace App\Http\Controllers;

use App\Config;
use App\Http\Requests\ConfigEmailRequest;
use Illuminate\Http\Request;

class ConfigEmailController extends Controller
{
    public function getEmailConfig()
    {
        $cauhinhs = Config::whereIn('name', ['email-receive', 'email-sender-subject','email-sender-from', 'email-receive-subject','email-receive-from', 'email-signatures', 'email-sender-content'])->orderBy('order')->get();
        return view('backend.admin.config.mail', compact('cauhinhs'));
    }
    public function saveEmailConfig(ConfigEmailRequest $request)
    {
        $emailReceive = $request->input('email-receive');
        $hdEmailReceive = $request->input('hd-email-receive');
        $emailSenderSubject = $request->input('email-sender-subject');
        $hdEmailSenderSubject = $request->input('hd-email-sender-subject');
        $emailSenderFrom = $request->input('email-sender-from');
        $hdEmailSenderFrom = $request->input('hd-email-sender-from');
        $emailReceiveSubject = $request->input('email-receive-subject');
        $hdEmailReceiveSubject = $request->input('hd-email-receive-subject');
        $emailReceiveFrom = $request->input('email-receive-from');
        $hdEmailReceiveFrom = $request->input('hd-email-receive-from');
        $emailSignatures = $request->input('email-signatures');
        $hdEmailSignatures = $request->input('hd-email-signatures');
        $emailSenderContent = $request->input('email-sender-content');
        $hdEmailSenderContent = $request->input('hd-email-sender-content');
        if (strcmp(trim($emailReceive), trim($hdEmailReceive)) != 0) {
            $config = Config::where('name', 'email-receive')->first();
            $config->content = $emailReceive;
            $config->save();
        }
        if (strcmp(trim($emailSenderSubject), trim($hdEmailSenderSubject)) != 0) {
            $config = Config::where('name', 'email-sender-subject')->first();
            $config->content = $emailSenderSubject;
            $config->save();
        }
        if (strcmp(trim($emailSenderFrom), trim($hdEmailSenderFrom)) != 0) {
            $config = Config::where('name', 'email-sender-from')->first();
            $config->content = $emailSenderFrom;
            $config->save();
        }
        if (strcmp(trim($emailReceiveSubject), trim($hdEmailReceiveSubject)) != 0) {
            $config = Config::where('name', 'email-receive-subject')->first();
            $config->content = $emailReceiveSubject;
            $config->save();
        }
        if (strcmp(trim($emailReceiveFrom), trim($hdEmailReceiveFrom)) != 0) {
            $config = Config::where('name', 'email-receive-from')->first();
            $config->content = $emailReceiveFrom;
            $config->save();
        }
        if ($emailSignatures) {
            if (strcmp(trim($emailSignatures), trim($hdEmailSignatures)) != 0) {
                $config = Config::where('name', 'email-signatures')->first();
                $config->content = $emailSignatures;
                $config->save();
            }
        }else{
            if(trim($hdEmailSignatures)){
                $config = Config::where('name', 'email-signatures')->first();
                $config->content = '';
                $config->save();
            }
        }
        if (strcmp(trim($emailSenderContent), trim($hdEmailSenderContent)) != 0) {
            $config = Config::where('name', 'email-sender-content')->first();
            $config->content = $emailSenderContent;
            $config->save();
        }
        return redirect()->route('config.email.index')
            ->with('success', 'Cấu Hình Email Lưu Thành Công');
    }
}
