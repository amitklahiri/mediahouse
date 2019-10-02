<?php 
class Page
{
	public function contact($data)
	{
		$to = 'support@xyz123abc456.mno789';
		$name = $data['name'];
		$email = $data['email'];
		$subject = $data['subject'];
		$message = $data['message'];
		$header = "From: Media House Contact <$name: $email>";

		if (@mail($to, $subject, $message, $header)) {
			return true;
		} else {
			return false;
		}
	}
}
