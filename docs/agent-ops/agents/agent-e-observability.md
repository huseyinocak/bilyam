# Agent-E — Notification, Integration, Observability

## Amaç
Mail/queue, log, hata görünürlüğü ve analitik event standardı.

## Dokunacağı Alanlar
- `app/Notifications/*`
- `app/Mail/*`
- `app/Jobs/*`
- `config/mail.php`
- `config/queue.php`
- `config/logging.php`
- event/listener katmanı
- analitik event sözlüğü dokümanları

## Teslimler
- Teklif alındı + admin bildirim + cevap mail akışı
- Queue tabanlı gönderim
- Hata logları + temel gözlemlenebilirlik
- Analitik event naming/param standardı

## Dokunmayacağı Alanlar
- admin/public görsel tasarım dosyaları

## Kapsam Dışı (Bu Sprint)
- görsel dashboard widget tasarımı
