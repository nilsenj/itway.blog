<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/29/2015
 * Time: 6:46 PM
 */

namespace Itway\MailComposers;

use CodeZero\Mailer\MailComposer;

class WelcomeMailComposer extends MailComposer
{

    /**
     * Compose a welcome mail.
     *
     * @param string $email
     * @param string $firstname
     *
     * @return \CodeZero\Mailer\Mail
     */
    public function compose($email, $name)
    {
        $toEmail = $email;
        $toName = $name;
        $subject = 'Welcome!';
        $view = 'emails.welcome';
        $data = ['name' => $name];
        $options = null;

        return $this->getMail($toEmail, $toName, $subject, $view, $data, $options);
    }

}