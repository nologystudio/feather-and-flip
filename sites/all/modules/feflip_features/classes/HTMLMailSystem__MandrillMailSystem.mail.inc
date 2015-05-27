<?php
class HTMLMailSystem__MandrillMailSystem implements MailSystemInterface {
    protected $formatClass;
    protected $mailClass;
    public function __construct() {
        if (drupal_autoload_class('HTMLMailSystem')) {
            $this->formatClass = new HTMLMailSystem;
        }
        else {
            $this->formatClass = new DefaultMailSystem;
        }
        if (drupal_autoload_class('MandrillMailSystem')) {
            $this->mailClass = new MandrillMailSystem;
        }
        else {
            $this->mailClass = new DefaultMailSystem;
        }
    }
    public function format(array $message) {
        return $this->formatClass->format($message);
    }
    public function mail(array $message) {
        return $this->mailClass->mail($message);
    }
}