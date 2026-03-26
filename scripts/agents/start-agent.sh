#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Kullanım: scripts/agents/start-agent.sh <agent-a|agent-b|agent-c|agent-d|agent-e|agent-f>"
  exit 1
fi

agent_id="$1"

case "$agent_id" in
  agent-a) guide="docs/agent-ops/agents/agent-a-domain-data.md" ;;
  agent-b) guide="docs/agent-ops/agents/agent-b-public-catalog.md" ;;
  agent-c) guide="docs/agent-ops/agents/agent-c-customer-auth.md" ;;
  agent-d) guide="docs/agent-ops/agents/agent-d-admin-operations.md" ;;
  agent-e) guide="docs/agent-ops/agents/agent-e-observability.md" ;;
  agent-f) guide="docs/agent-ops/agents/agent-f-qa-release-security.md" ;;
  *)
    echo "Hata: bilinmeyen agent id: $agent_id"
    exit 2
    ;;
esac

branch="agent/${agent_id}/kickoff"

if git rev-parse --verify "$branch" >/dev/null 2>&1; then
  git checkout "$branch"
else
  git checkout -b "$branch"
fi

echo "[ok] ${agent_id} başlatıldı -> branch: ${branch}"
echo "[next] Görev rehberi: ${guide}"
