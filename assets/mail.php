<?php



    // Only process POST reqeusts.

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the form fields and remove MORALspace.

        $name = strip_tags(trim($_POST["name"]));

				$name = str_replace(array("\r","\n"),array(" "," "),$name);

        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        $subject = trim($_POST["subject"]);
        $number = trim($_POST["number"]);
        $website = trim($_POST["website"]);
        $message = trim($_POST["message"]);



        // Check that data was sent to the mailer.

        if ( empty($name)  OR empty($number) OR empty($website) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Set a 400 (bad request) response code and exit.

            http_response_code(400);

            echo "Please complete the form and try again.";

            exit;

        }



        // Set the recipient email address.

        // FIXME: Update this to your desired email address.

        $recipient = "bilgi@ixirkimya.com.tr";



        // Set the email subject.

        $sender = "Şu kişiden yeni $name";



        //Email Header

        $head = " /// ThemePure \\\ ";



        // Build the email content.

        $email_content = "$head\n\n\n";

        $email_content .= "İsm: $name\n";

        $email_content .= "E-posta: $email\n\n";

        $email_content .= "Konu: $subject\n\n";

        $email_content .= "Tel No.: $number\n\n";

        $email_content .= "Web Adresi: $websiite\n\n";

        $email_content .= "Mesajınız:\n$message\n";



        // Build the email headers.

        $email_headers = "Tarafından: $name <$email>";



        // Send the email.

        if (mail($recipient, $sender, $email_content, $email_headers)) {

            // Set a 200 (okay) response code.

            http_response_code(200);

            echo "Thank You! Your message has been sent.";

        } else {

            // Set a 500 (internal server error) response code.

            http_response_code(500);

            echo "Oops! Something went wrong and we couldn't send your message.";

        }



    } else {

        // Not a POST request, set a 403 (forbidden) response code.

        http_response_code(403);

        echo "There was a problem with your submission, please try again.";

    }



?>

