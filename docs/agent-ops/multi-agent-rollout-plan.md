# Çoklu Ajan Başlatma Planı (Faz-1 / MVP)

Bu doküman, Agent-A ... Agent-F için görev çakışmasını önleyen ve doğrudan başlatılabilir bir çalışma çerçevesi sağlar.

## 0) Master Kurallar (Bağlayıcı)
- MVP sınırı korunur, hacky çözüm üretilmez.
- Teklif akışı klasik sepet mantığına indirgenmez.
- Misafir kullanıcı akışı korunur.
- Commitler küçük ve tek sorumlulukludur.
- Her görev kartında kapsam dışı açıkça yazılır.

## 1) Orkestrasyon Modeli
- **Koordinatör:** Teknik lider / agent-orchestrator
- **Yürütücüler:** Agent-A, B, C, D, E, F
- **Senkronizasyon çevrimi:**
  1. Planlama (scope + handoff)
  2. Uygulama (ajan bazlı PR)
  3. Entegrasyon (çatışma kontrolü)
  4. Gate (QA + security)

## 2) Agent Dağılımı (Çakışmasız)
Özet görevler ajan dosyalarında detaylandırılmıştır:
- `docs/agent-ops/agents/agent-a-domain-data.md`
- `docs/agent-ops/agents/agent-b-public-catalog.md`
- `docs/agent-ops/agents/agent-c-customer-auth.md`
- `docs/agent-ops/agents/agent-d-admin-operations.md`
- `docs/agent-ops/agents/agent-e-observability.md`
- `docs/agent-ops/agents/agent-f-qa-release-security.md`

## 3) Başlatma Sırası
1. Agent-A başlatılır (domain + migration + seed omurgası)
2. Paralelde Agent-B ve Agent-D UI yüzeylerini iskeletler
3. Agent-C auth/customer panel akışını bağlar
4. Agent-E bildirim/queue/observability akışlarını entegre eder
5. Agent-F uçtan uca kritik test + release gate uygular

## 4) Done Kriteri (Global)
- Her ajan kendi "dokunmayacağı alanlar" sınırını ihlal etmez.
- Her PR'da kapsam dışı maddeleri yer alır.
- Kırmızı test bırakılmaz.
- Entegrasyon aşamasında route/model/view ownership çakışması kalmaz.
