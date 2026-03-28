# Security Hardening Checklist (MVP)

- [ ] Public quote endpoints protected by validation + rate limiting plan.
- [ ] Customer ownership checks enforced on quote detail access.
- [ ] Admin endpoints protected by auth middleware and role-gating backlog.
- [ ] Sensitive data omitted from analytics and logs.
- [ ] Mail recipients configured through environment variables only.
- [ ] Queue failures observable via failed jobs and dedicated log channels.
- [ ] Dependency updates and security advisories tracked before release.
