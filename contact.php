<?php
// Basic, host-friendly email sender using PHP mail()
// Sends submissions to hrithikkantak1644@gmail.com and stores a CSV log.

$TO = "hrithikkantak1644@gmail.com"; // <-- change if needed
$FROM_ADDRESS = "no-reply@yourdomain.com"; // many hosts require a domain email as From
$SUBJECT = "New Contact Form Message – QuietMomentum";

// Ensure POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo "Method Not Allowed";
  exit;
}

// Honeypot (anti-spam)
if (!empty($_POST['website'])) {
  // Pretend success to avoid tipping off bots
  header("Location: thank-you.html");
  exit;
}

// Sanitize inputs
function sanitize($value) {
  return trim(filter_var($value, FILTER_SANITIZE_STRING));
}

$name = sanitize($_POST['name'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$message = trim($_POST['message'] ?? '');
$origin = sanitize($_POST['origin'] ?? 'unknown');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

if (!$name || !$email || !$message) {
  http_response_code(400);
  echo "Please fill all required fields.";
  exit;
}

// Build email body
$body  = "You have a new contact form submission:\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
$body .= "Message:\n{$message}\n\n";
$body .= "Origin: {$origin}\n";
$body .= "IP: {$ip}\n";
$body .= "User Agent: {$ua}\n";
$body .= "Time: " . date('Y-m-d H:i:s') . " (server time)\n";

// Headers
$headers   = "From: QuietMomentum <{$FROM_ADDRESS}>\r\n";
$headers  .= "Reply-To: {$name} <{$email}>\r\n";
$headers  .= "MIME-Version: 1.0\r\n";
$headers  .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
@mail($TO, $SUBJECT, $body, $headers);

// Log to CSV (optional but useful)
$logDir = __DIR__ . "/storage";
if (!is_dir($logDir)) { @mkdir($logDir, 0775, true); }
$csv = fopen($logDir . "/contact-log.csv", "a");
if ($csv) {
  fputcsv($csv, [date('c'), $name, $email, $origin, str_replace(["\r","\n"], ' ', $message), $ip, $ua]);
  fclose($csv);
}

// Redirect to thank you page
header("Location: thank-you.html");
exit;
?>
