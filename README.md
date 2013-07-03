Swiftmailer-Transport--EsmtpDataReceiptTransport
================================================

Adds X-Swift-Data-Receipt to the message header comprised of the smtp data receipt text

### Add to composer.json
"peerj/swiftmailer-transport-esmtpdatareceipttransport": "dev-master"

### Add to parameters.yml
parameters:
     swiftmailer.transport.smtp.class: Swift_Transport_EsmtpDataReceiptTransport

### In your implmentation of Swift_Events_SendListener::sendPerformed
$dataReceipt = $message->getHeaders()->get("X-Swift-Data-Receipt")->getValue();
