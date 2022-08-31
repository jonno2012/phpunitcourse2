<?php

namespace App;

use App\Mailer;

/**
 * User
 *
 * An example user class
 */
class User
{

    /**
     * Email address
     * @var string
     */
    public $email;

    /**
     * Mailer object
     * @var Mailer
     */
    protected $mailer;

    /**
     * Constructor
     *
     * @param string $email The user's email
     *
     * @return void
     */

    public $mailer_callable;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Mailer setter
     *
     * @param Mailer $mailer A Mailer object
     *
     * @return void
     */
    public function setMailer(Mailer $mailer) {
        $this->mailer = $mailer;        
    }

    public function setMailerCallable($mailer_callable)
    {
        $this->mailer_callable = $mailer_callable;
    }
    
    /**
     * Send the user a message
     *
     * @param string $message The message
     *
     * @return boolean
     */
    public function notify(string $message)
    {
        return call_user_func($this->mailer_callable, $this->email, $message);
//        return $this->mailer::send($this->email, $message);
    }
}
