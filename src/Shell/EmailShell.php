<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Mailer\Email;

/**
 * Email shell command.
 */
class EmailShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

	/**
	 * @param string $email Email address to send email to
	 */
    public function sendTest($toEmail, $emailProfile = null){
    	define('WEBROOT', 'http://test.variantsol.com');
		$this->out(sprintf('Sending test email to %s', $toEmail));
		$aurl = WEBROOT . "users/doactivate/" . $toEmail . "/notrealactivationcode" ;

		$emailProfile = $emailProfile ? $emailProfile : $emailProfile;
		$email = new Email($emailProfile);
		$email->template('activate', 'default')
			->emailFormat('both')
			->to($toEmail)
			->subject('Account Activation')
			->from(Configure::read('emailfrom'))
			->viewVars(['aurl' => $aurl, 'name' => 'Unknown user']);
		try{
			if($email->send()){
				$this->out(sprintf('Email was successfully sent to %s', $toEmail));
			}else{
				$this->out(sprintf('There was an issue while sending an email to %s', $toEmail));
			}
		}catch (\Exception $e){
			$this->out(sprintf('There was an error while sending an email to %s', $toEmail));
			$this->out(sprintf('Error details: %s', $e->getMessage()));
		}
	}
}
