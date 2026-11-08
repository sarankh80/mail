# Enterprise Mail
### Self-Hosted Business Email & Collaboration Platform

**A secure, modern, self-hosted company email platform inspired by Microsoft Outlook.**

![Laravel](https://img.shields.io/badge/Laravel-13%2B-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8%2B-4479A1?logo=mysql&logoColor=white)
![Ubuntu](https://img.shields.io/badge/Ubuntu-24.04-E95420?logo=ubuntu&logoColor=white)
![PWA](https://img.shields.io/badge/PWA-Enabled-5A0FC8?logo=pwa&logoColor=white)
![License](https://img.shields.io/badge/License-Proprietary-red)

---

## 1. Overview

Enterprise Mail is a private, self-hosted business email and collaboration platform designed to give organizations complete control over their email infrastructure, user accounts, communications, and security.

The platform combines a modern Outlook-inspired webmail experience with a privately managed mail server and a comprehensive administration system.

Unlike traditional hosted email services, the organization controls its own mail infrastructure, mailbox provisioning, storage policies, security configurations, and administrative permissions.

The application is designed for businesses that need a secure, reliable, and easy-to-manage email solution without requiring employees to install traditional desktop email software.

### Key Highlights

- Fully self-hosted company email infrastructure.
- Modern Outlook-inspired webmail interface.
- Real-time email sending and receiving.
- Centralized mailbox administration.
- Shared mailboxes and team collaboration.
- Advanced spam and phishing protection.
- Two-factor authentication.
- Installable Progressive Web Application (PWA).
- English and Khmer localization.
- Responsive desktop, tablet, and mobile experience.

## 2. Project Objectives

The primary objectives are:

1. Establish a company-owned email infrastructure.
2. Provide a modern and intuitive webmail experience.
3. Centralize employee email account management.
4. Protect company communications and sensitive information.
5. Simplify mailbox administration for non-technical administrators.
6. Support departmental and shared mailboxes.
7. Reduce dependency on external hosted email platforms.
8. Provide a scalable foundation for future collaboration features.

## 3. Technology Stack

### Application

| Technology | Purpose |
|---|---|
| Laravel 13+ | Application backend |
| PHP 8.5 | Application runtime |
| MySQL 8+ | Application database |
| JavaScript | Frontend interactions |
| HTML5 | Application structure |
| CSS3 | Responsive interface |
| REST API | Application communication |
| PWA | Installable web application |

### Mail Infrastructure

| Technology | Purpose |
|---|---|
| Postfix | SMTP mail transfer |
| Dovecot | IMAP mailbox access |
| Dovecot Sieve | Email filtering and automatic replies |
| Dovecot ACL | Shared mailbox permissions |
| Rspamd | Spam and phishing protection |
| Redis | Spam filtering support |
| OpenDKIM | DKIM email signing, where applicable |
| ClamAV | Optional antivirus scanning |
| Let's Encrypt | SSL/TLS certificates |
| Fail2Ban | Intrusion and brute-force protection |

### Server Environment

- Ubuntu 24.04 LTS
- Nginx
- PHP-FPM
- MySQL
- Redis
- Systemd
- UFW Firewall

## 4. System Architecture

The platform consists of three primary layers.

### Application Layer

Responsible for:

- Authentication and authorization.
- User and mailbox management.
- Email interface.
- Contacts and calendar.
- Settings and preferences.
- Administration and reporting.
- Security and audit logs.

### Mail Server Layer

Responsible for:

- Incoming email.
- Outgoing email.
- Mailbox storage.
- IMAP access.
- Spam filtering.
- Email authentication.
- Shared mailbox access.
- Mailbox quotas.

### Integration Layer

Connects the Laravel application to the mail infrastructure through dedicated services and secure administrative interfaces.

```text
                 USERS
                   |
                   v
          Webmail / PWA
                   |
                   v
          Nginx + HTTPS
                   |
                   v
          Laravel Application
                   |
          +--------+--------+
          |                 |
          v                 v
       MySQL             Mail Services
          |                 |
          |          +------+------+
          |          |             |
          |          v             v
          |       Postfix       Dovecot
          |          |             |
          |          v             v
          |       SMTP          IMAP
          |          |             |
          |          +------+------+
          |                 |
          |                 v
          |          Mail Storage
          |
          v
    Application Data

          Rspamd + Redis
          DKIM / SPF / DMARC
          ClamAV (Optional)
```

## 5. Core Features

### 5.1 Webmail

- Inbox.
- Sent Items.
- Drafts.
- Deleted Items.
- Junk Email.
- Archive.
- Notes.
- Personal folders.
- Conversation threading.
- Reading pane.
- Email search.
- Message flags.
- Unread indicators.
- Bulk message operations.

### 5.2 Email Composer

- Compose new messages.
- Reply and reply all.
- Forward messages.
- Rich-text formatting.
- To, CC and BCC.
- File attachments.
- Drag-and-drop attachments.
- Draft autosave.
- Email signatures.
- Recipient autocomplete.
- Shared mailbox sending.

### 5.3 Account Management

- Multiple authorized mailboxes.
- Mailbox aliases.
- Mailbox quotas.
- Account switching.
- Default sending identity.
- Profile settings.
- Password management.
- Recovery email.

### 5.4 Contacts

- Personal contacts.
- Company directory.
- Contact groups.
- Import and export.
- Search and autocomplete.

### 5.5 Calendar

- Day, week and month views.
- Event management.
- Meeting invitations.
- Accept and decline invitations.
- Calendar reminders.
- Recurring events.
- ICS import and export.

### 5.6 Security

- Two-factor authentication.
- Authenticator applications.
- Backup codes.
- Session management.
- Device management.
- Login history.
- Password recovery.
- Rate limiting.
- Secure cookies.
- CSRF protection.
- Content Security Policy.
- Audit logging.

### 5.7 Shared Mailboxes

Examples:

- support@company.com
- sales@company.com
- accounts@company.com
- info@company.com
- hr@company.com

Support mailbox-level and user-level permission management, including reading and sending permissions.

### 5.8 Administration

- Admin dashboard.
- Mailbox provisioning.
- User management.
- Address requests.
- Approval workflows.
- Role management.
- Mailbox suspension.
- Quota management.
- Spam configuration.
- Quarantine management.
- Allow and block lists.
- Audit history.
- Server health monitoring.

### 5.9 Progressive Web Application

- Install from supported browsers.
- Standalone application experience.
- Responsive layouts.
- Application icons.
- Offline application shell.
- Web Push notifications.
- Secure service worker.

## 6. User Roles and Permissions

| Role | Permissions |
|---|---|
| Owner | Permanent highest-level authority |
| Administrator | Full system administration |
| Moderator | Approve requests and reset passwords through secure recovery |
| Staff | Access assigned mailboxes and personal settings |

### Owner Protection

The permanent owner account must:

- Never be deleted.
- Never be suspended by another administrator.
- Never be demoted.
- Never have its password reset by another administrator.
- Retain permanent administrative authority.

Users cannot modify their own roles.

## 7. Email Security

Security is a core part of the platform.

### Email Authentication

Configure:

- MX records.
- SPF records.
- DKIM signing.
- DMARC policies.
- Reverse DNS.
- TLS certificates.

Start DMARC with monitoring mode (`p=none`) and move toward stronger enforcement after reviewing legitimate sending sources.

### Spam Protection

Rspamd provides:

- Spam scoring.
- Phishing detection.
- Sender reputation checks.
- Allow and block lists.
- Quarantine integration.
- Spam feedback.

### Attachment Protection

Dangerous attachments must be identified using file signatures, MIME types and configurable security policies.

Optional ClamAV scanning provides additional malware detection.

### Safe Email Rendering

- Sanitize HTML messages.
- Block external images by default.
- Prevent script execution.
- Restrict unsafe links.
- Validate attachment downloads.
- Prevent unauthorized message access.

## 8. Installation Requirements

### Minimum Server Requirements

| Resource | Minimum | Recommended |
|---|---:|---:|
| CPU | 1 vCPU | 2 vCPU |
| RAM | 1 GB | 4 GB |
| Storage | 30 GB SSD | 90 GB+ SSD |
| OS | Ubuntu 24.04 | Ubuntu 24.04 LTS |
| Web Server | Nginx | Nginx |
| PHP | 8.5 | 8.5 |
| Database | MySQL 8+ | MySQL 8+ |

**Note:** A 1 GB server requires careful resource management. ClamAV and other memory-intensive services should be disabled unless sufficient RAM is available. Mailbox storage capacity depends on actual email volume and retention requirements.

## 9. Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/your-company/enterprise-mail.git

cd enterprise-mail
```

### Step 2: Install Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### Step 3: Environment Configuration

```bash
cp .env.example .env

php artisan key:generate
```

Configure the environment variables:

```env
APP_NAME="Enterprise Mail"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://mail.example.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_TIMEZONE=Asia/Phnom_Penh

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=enterprise_mail
DB_USERNAME=enterprise_mail_user
DB_PASSWORD=CHANGE_ME

MAIL_HOST=127.0.0.1
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

Never commit production secrets to Git.

### Step 4: Database Setup

Create the database and restricted database user.

Run migrations:

```bash
php artisan migrate --force
```

Run seeders only after reviewing the production seed data:

```bash
php artisan db:seed --force
```

### Step 5: Configure Laravel

```bash
php artisan storage:link

php artisan optimize
```

### Step 6: Configure Permissions

Ensure Laravel storage and cache directories are writable by the appropriate PHP-FPM service user.

Do not grant unnecessary write permissions to the entire application directory.

### Step 7: Configure Web Server

Configure Nginx to:

- Serve the Laravel `public` directory.
- Force HTTPS.
- Use PHP-FPM.
- Deny access to sensitive files.
- Apply security headers.
- Restrict upload sizes.
- Configure appropriate timeouts.

### Step 8: Configure Mail Services

Install and configure Postfix, Dovecot, Rspamd and Redis according to the deployment documentation.

Verify SMTP, IMAP, DNS authentication and TLS before enabling production accounts.

## 10. Environment Configuration

Important environment settings should be documented separately for:

- Application.
- Database.
- SMTP relay.
- IMAP connection.
- Mail storage.
- Push notifications.
- Security keys.
- Backup destinations.
- Monitoring.

Do not store Linux root passwords, mail administrator credentials, DKIM private keys or VAPID private keys in publicly accessible application files.

## 11. Development Roadmap

The project follows six controlled implementation phases.

| Phase | Description | Status |
|---|---|---|
| 01 | Mail server, DNS and email delivery | Planned |
| 02 | Webmail core | Planned |
| 03 | Settings and security | Planned |
| 04 | Address requests and administration | Planned |
| 05 | Spam filtering and shared mailboxes | Planned |
| 06 | PWA and push notifications | Planned |

Each phase must be tested and demonstrated before moving to the next phase.

## 12. Testing Strategy

The project must include automated and manual tests.

### Application Testing

- Authentication.
- Authorization.
- API validation.
- Mailbox operations.
- Contacts.
- Calendar.
- File attachments.
- Admin permissions.

### Mail Server Testing

- SMTP sending.
- Incoming email.
- IMAP authentication.
- DKIM validation.
- SPF validation.
- DMARC validation.
- TLS certificates.
- Spam filtering.
- Mailbox quotas.

### Security Testing

- XSS.
- CSRF.
- SQL injection.
- IDOR.
- Brute-force protection.
- Session revocation.
- Unsafe attachment handling.
- Email HTML sanitization.

### Deployment Testing

- Backup integrity.
- Database restoration.
- Mailbox restoration.
- Service restart.
- Certificate renewal.
- Disaster recovery.

## 13. Backup and Disaster Recovery

Back up:

- Application source code.
- MySQL database.
- Mailbox storage.
- Postfix configuration.
- Dovecot configuration.
- Rspamd configuration.
- DKIM keys.
- SSL configuration.
- Environment secrets.

Use encrypted off-server backups.

Regularly test the complete restoration process.

## 14. Project Structure

```text
enterprise-mail/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   ├── Services/
│   ├── Policies/
│   ├── Jobs/
│   └── Notifications/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── public/
│   ├── assets/
│   ├── icons/
│   ├── manifest.json
│   └── sw.js
├── resources/
│   ├── views/
│   ├── js/
│   ├── css/
│   └── lang/
├── routes/
├── storage/
├── tests/
├── docs/
│   ├── ADMIN-GUIDE.md
│   ├── STAFF-GUIDE.md
│   ├── INSTALLATION.md
│   ├── MAIL-SERVER.md
│   ├── SECURITY.md
│   ├── BACKUP-RESTORE.md
│   └── API.md
├── .env.example
├── artisan
├── composer.json
└── README.md
```

Mail server configuration and mailbox storage should remain outside the public web directory and be managed independently from Laravel.

## 15. Operational Guidelines

- Always back up before production modifications.
- Test new configurations locally.
- Use a dedicated test mailbox before production rollout.
- Require approval for DNS changes and privileged server operations.
- Keep all services updated.
- Monitor disk and memory usage.
- Review security logs.
- Test backup restoration.
- Document all infrastructure changes.
- Never expose private credentials.

## 16. Documentation

The project must provide:

| Document | Description |
|---|---|
| README.md | Project overview and setup |
| INSTALLATION.md | Complete installation guide |
| MAIL-SERVER.md | Postfix and Dovecot configuration |
| SECURITY.md | Security and hardening |
| API.md | API endpoints and authentication |
| ADMIN-GUIDE.md | One-page administrator guide |
| STAFF-GUIDE.md | One-page staff guide |
| BACKUP-RESTORE.md | Backup and recovery |
| CHANGELOG.md | Version history |

## 17. Project Completion Criteria

The project is considered production-ready only when:

- Real emails can be sent and received.
- Mailbox storage is operational.
- Authentication and authorization work.
- Shared mailbox permissions work.
- Spam filtering works.
- Quarantine operations work.
- Two-factor authentication works.
- Account requests and approvals work.
- Calendar and contacts work.
- PWA installation works.
- Notifications work.
- English and Khmer localization work.
- Backup restoration is verified.
- Security tests pass.
- Administration documentation is complete.

Do not mark planned or partially implemented functionality as complete.

---

## 18. Project Information

**Project Name:** Enterprise Mail

**Category:** Enterprise Email & Collaboration

**Deployment Model:** Self-Hosted

**Application:** Laravel

**Mail Infrastructure:** Postfix + Dovecot

**Interface:** Outlook-Inspired Webmail

**Supported Languages:** English and Khmer

**Application Type:** Responsive Web Application / PWA

**Target Users:** Business Owners, Administrators, Moderators and Employees

**Ownership:** Private Company Infrastructure

---

## License

Copyright © [YEAR] [COMPANY NAME]. All rights reserved.

This software is intended for private company use.

Redistribution, commercial distribution, modification or resale must be authorized by the copyright owner, subject to applicable third-party software licenses.

---

**Built for secure business communication.  
Owned by your company. Controlled by your team.**