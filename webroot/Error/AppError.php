<?php
declare(strict_types=1);

namespace App\Error;

use Cake\Error\ErrorHandler;

class AppError extends ErrorHandler
{
    protected function _displayError(array $error, bool $debug): void
    {
        // Only show actual errors, not warnings
        if ($error['level'] === E_WARNING || 
            $error['level'] === E_USER_WARNING || 
            $error['level'] === E_DEPRECATED || 
            $error['level'] === E_USER_DEPRECATED ||
            $error['level'] === E_NOTICE ||
            $error['level'] === E_USER_NOTICE) {
            return; // Skip warnings completely
        }
        
        parent::_displayError($error, $debug);
    }
}