<?php
interface EmailServerInterface {
	public function sendEmail($to, $subject, $message);
}

?>
