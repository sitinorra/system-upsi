<?php
declare(strict_types=1);

namespace App\Utility;

class EmailHelper
{
    /**
     * Simulate sending email notification
     * For demo purposes only - doesn't actually send email
     */
    public static function sendComplaintNotification($type, $complaint, $recipientEmail, $recipientName)
    {
        // In real implementation, this would use CakePHP Email or PHPMailer
        // For now, we just log it
        
        $subject = '';
        $message = '';
        
        // Safely get values with null checks
        $complaintId = $complaint->complaint_id ?? 'N/A';
        $complaintType = isset($complaint->complaint_type) ? $complaint->complaint_type->type_name : 'N/A';
        $complaintCategory = isset($complaint->complaint_category) ? $complaint->complaint_category->category_name : 'N/A';
        $complaintStatus = $complaint->status ?? 'Pending';
        
        switch ($type) {
            case 'new_complaint':
                $subject = 'New Complaint Submitted - #' . $complaintId;
                $message = "Dear {$recipientName},\n\n";
                $message .= "Your complaint has been submitted successfully.\n\n";
                $message .= "Complaint ID: #{$complaintId}\n";
                $message .= "Type: {$complaintType}\n";
                $message .= "Category: {$complaintCategory}\n";
                $message .= "Status: {$complaintStatus}\n\n";
                $message .= "We will review your complaint and get back to you soon.\n\n";
                $message .= "Thank you,\nUPSI Complaint System";
                break;
                
            case 'status_updated':
                $subject = 'Complaint Status Updated - #' . $complaintId;
                $message = "Dear {$recipientName},\n\n";
                $message .= "Your complaint status has been updated.\n\n";
                $message .= "Complaint ID: #{$complaintId}\n";
                $message .= "New Status: {$complaintStatus}\n\n";
                $message .= "Please login to view more details.\n\n";
                $message .= "Thank you,\nUPSI Complaint System";
                break;
                
            case 'feedback_added':
                $subject = 'New Feedback on Your Complaint - #' . $complaintId;
                $message = "Dear {$recipientName},\n\n";
                $message .= "New feedback has been added to your complaint.\n\n";
                $message .= "Complaint ID: #{$complaintId}\n\n";
                $message .= "Please login to view the feedback.\n\n";
                $message .= "Thank you,\nUPSI Complaint System";
                break;
        }
        
        // Log email (simulated)
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'to' => $recipientEmail,
            'subject' => $subject,
            'message' => $message
        ];
        
        // Write to log file (optional)
        try {
            $logFile = LOGS . 'email_notifications.log';
            $logContent = json_encode($logEntry, JSON_PRETTY_PRINT) . "\n---\n";
            @file_put_contents($logFile, $logContent, FILE_APPEND);
        } catch (\Exception $e) {
            // Ignore log errors
        }
        
        // Return true to simulate successful sending
        return true;
    }
}