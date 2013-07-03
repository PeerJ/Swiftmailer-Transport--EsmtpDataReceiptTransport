<?php

/**
 * Extends Swift_Transport_EsmtpTransport
 *
 */
class Swift_Transport_EsmtpDataReceiptTransport extends Swift_Transport_EsmtpTransport
{
    /** Stream the contents of the message over the buffer */
    protected function _streamMessage(Swift_Mime_Message $message)
    {
        $this->_buffer->setWriteTranslations(array("\r\n." => "\r\n.."));
        try {
            $message->toByteStream($this->_buffer);
            $this->_buffer->flushBuffers();
        } catch (Swift_TransportException $e) {
            $this->_throwException($e);
        }
        $this->_buffer->setWriteTranslations(array());
        $response = $this->executeCommand("\r\n.\r\n", array(250));
        $message->getHeaders()->addTextHeader("X-Swift-Data-Receipt", $response);
        return $response;
    }
}
