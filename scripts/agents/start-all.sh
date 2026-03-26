#!/usr/bin/env bash
set -euo pipefail

for agent in agent-a agent-b agent-c agent-d agent-e agent-f; do
  echo "- ${agent}: READY"
done

echo "Tüm ajanlar plan seviyesinde başlatılabilir durumda."
echo "Uygulama için her ajanı ayrı branch'te başlatın:"
echo "  scripts/agents/start-agent.sh agent-a"
echo "  scripts/agents/start-agent.sh agent-b"
echo "  ..."
