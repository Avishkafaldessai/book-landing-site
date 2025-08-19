READY-TO-RUN BOOK LANDING (Bootstrap + PHP)

What’s included
---------------
- index.html — Landing page using Bootstrap 5 and Google Font "Outfit"
- assets/styles.css — Minimal custom styling
- assets/script.js — Footer year + 10-second purchase modal
- contact.php — Sends emails to hrithikkantak1644@gmail.com and logs CSV to /storage
- thank-you.html — Redirect page after form submission
- storage/contact-log.csv — (created automatically on first submission)

Requirements
------------
- Any PHP-enabled hosting (PHP 7.x or 8.x is fine).
- The `mail()` function must be enabled for email delivery.
  If your host requires SMTP, replace `mail()` with PHPMailer and SMTP creds.

How to use
----------
1) Upload all files to your hosting (public_html or similar).
2) Edit contact.php (optional):
   - Change $FROM_ADDRESS to an email at YOUR domain (e.g. no-reply@yourdomain.com).
     Many hosts reject mail if From is a free email (like Gmail).
3) Replace Buy links (#) under the Book section with your payment/checkout URLs.
4) Open your domain — the popup will show after 10 seconds automatically.

Notes
-----
- Testimonial carousel shows 3 reviews on desktop and 1 review on mobile.
- Images use Unsplash placeholders; replace with your own at any time.
- Entries are also stored to storage/contact-log.csv for backup.
