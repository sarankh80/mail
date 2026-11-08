# Company Webmail Platform — Architecture & Plan

Status as of 2026-11-08: Phase 2 (webmail core) scaffolding in progress, local-only.
No production server exists yet. Phase 1 (live mail server + DNS) has not started
and will not be touched without explicit owner approval per the project's strict
development rules.

## 1. Layers

- **Application layer** — Laravel 13 (PHP 8.4 locally; target 8.5 in production),
  SQLite for local dev, MySQL 8+ in production. Session-based web auth via
  Laravel Fortify (2FA, passkeys, password reset, email verification). Sanctum
  for `/api/v1` token auth. Vanilla JS/CSS frontend — no SPA framework.
- **Mail server layer** (Phase 1, not yet provisioned) — Postfix (SMTP),
  Dovecot (IMAP/Sieve/quota/ACL), Rspamd + Redis (spam), OpenDKIM, ClamAV
  (optional), Let's Encrypt, Fail2Ban. Direct-SMTP outbound relay (owner's
  choice — no SES/Mailgun/Resend).
- **Integration layer** — Laravel services talk to the mail server via IMAP/SMTP
  protocols and narrowly-scoped helper scripts for root-level mailbox
  provisioning (never raw shell exec from web requests). Not yet implemented;
  comes in Phase 2 once Phase 1 exists to integrate against.

All company-specific values (name, domain, branding, quotas, relay choice,
spam level, etc.) live in `.env` / `config/company.php` — nothing is
hardcoded in application code.

## 2. Database design (implemented)

33 migrations covering every table in the master spec's §20 list. Email
*content* (messages/attachments) is never duplicated into MySQL — it stays in
Dovecot's Maildir storage. MySQL holds only metadata, permissions,
preferences, and security/audit records.

| Group | Tables |
|---|---|
| Identity & access | `users` (+role/status/owner columns), `user_profiles`, `roles`, `permissions`, `role_user`, `permission_role` |
| Mailboxes | `mailbox_accounts`, `mailbox_aliases`, `mailbox_quotas`, `mailbox_identities`, `mailbox_signatures`, `mailbox_settings` |
| Provisioning | `mailbox_requests`, `mailbox_request_verifications` |
| Shared mailboxes | `mailbox_access` (read/send/send_as grants) |
| Devices/sessions | `mailbox_devices`, `mailbox_sessions` |
| Contacts | `contacts`, `contact_groups`, `contact_group_members` |
| Calendar | `calendar_calendars`, `calendar_events`, `calendar_attendees`, `calendar_invitations` |
| Notifications | `notification_subscriptions`, `notification_preferences` |
| Mail security | `email_rules`, `email_security_settings`, `email_allow_lists`, `email_block_lists`, `email_quarantine`, `email_security_events` |
| Governance | `admin_audit_logs` |

Roles seeded: `owner` (permanent, protected, bypasses permission checks),
`administrator`, `moderator`, `staff` — each with a distinct permission set
matching §12. A single protected owner account is created by
`OwnerUserSeeder` from `OWNER_EMAIL`/`OWNER_NAME`/`OWNER_PASSWORD` env vars
(random password generated and printed once if not set).

## 3. Implementation checklist

**Phase 2 — Webmail core** (in progress, local)
- [x] Laravel scaffold, Fortify, Sanctum
- [x] Company config layer (no hardcoded values)
- [x] Full database schema + models + relationships
- [x] Roles/permissions seeding, protected owner account
- [ ] IMAP/SMTP integration services (requires Phase 1 server to connect to)
- [ ] Folders, message list, reading pane, compose, send, attachments (API + UI)
- [ ] Policies for owner/admin/moderator/staff authorization on every endpoint

**Phase 3 — Settings & security**
- [ ] Profile, password, 2FA UI (Fortify actions already scaffolded)
- [ ] Devices/sessions management UI backed by `mailbox_devices`/`mailbox_sessions`
- [ ] Signatures, language, automatic replies (Sieve integration, Phase 1-dependent)

**Phase 4 — Sign-up & admin**
- [ ] Public address-request form + personal-email verification flow
- [ ] Admin approval → mailbox provisioning (Phase 1-dependent)
- [ ] Admin dashboard, audit log viewer

**Phase 5 — Spam & shared mailboxes**
- [ ] Rspamd/Redis integration, quarantine UI
- [ ] Shared mailbox ACL management (Dovecot ACL + Linux groups, Phase 1-dependent)

**Phase 6 — PWA & delivery**
- [ ] manifest.json, service worker, Web Push (VAPID)
- [ ] Final security audit, backup/restore test, documentation

## 4. Phase 1 plan (mail server + DNS) — NOT STARTED

Blocked on: a provisioned VPS (Ubuntu 24.04) with SSH access, and a real
domain. Per the project's strict rules, none of this runs until the owner
provides server access and explicitly approves each live/DNS change.

When ready, the sequence will be:
1. Inspect the fresh server (OS, resources, existing services) — read-only.
2. Snapshot/backup before any install.
3. Install Postfix, Dovecot, Rspamd, Redis, OpenDKIM, Fail2Ban, UFW,
   Let's Encrypt (ClamAV only if RAM allows).
4. Generate DKIM keys; propose MX/SPF/DKIM/DMARC(`p=none` to start)/PTR
   records for owner approval before publishing.
5. Issue TLS certs, configure Postfix direct-SMTP delivery.
6. Send/receive test mail via one throwaway mailbox; verify SPF/DKIM/DMARC
   alignment.
7. Document a one-line rollback for every change made live.

Nothing in Phase 1 will be executed without the owner supplying server
access and explicitly approving the DNS changes at that time.
