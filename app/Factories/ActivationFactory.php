<?php

namespace App\Factories;

use App\Kullanici;
use App\Repositories\ActivationRepository;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class ActivationFactory
{
    protected $activationRepo;
    protected $mailer;
    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo, Mailer $mailer)
    {
        $this->activationRepo = $activationRepo;
        $this->mailer = $mailer;
    }

    public function sendActivationMail($user)
    {
        if ($user->onayli == "1" || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('kullanici.onay', [$user->id, $token]);
        $message = sprintf('Hesabınızı aktifleştirin %s', $link);

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Activation mail');
        });
    }

    public function activateUser($kullanici_id, $token)
    {
        $kullanici = \App\Kullanici::find($kullanici_id);
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null)//token'ın kullanıcı id'si, onay linkindeki ile eşleşmiyorsa
        {
            return null;
        }

        if ($activation->kullanici_id != $kullanici_id)
        {
            abort(403, 'Forbidden.');
        }

        $kullanici->onayli = "1";

        $kullanici->save();

        $this->activationRepo->deleteActivation($token);

        return $kullanici;
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}