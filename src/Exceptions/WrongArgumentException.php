<?php

namespace BugTracker\Exceptions;

class WrongArgumentException extends BugTrackerException {

    public function __construct(string $message, int $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}