#!/bin/bash
set -euo pipefail

SCRIPT_DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)
COMPOSE_DIR=$(cd "$SCRIPT_DIR/.." && pwd)

usage() {
  cat <<'EOF'
Usage: import-tool.sh [selector ...]

With no arguments, and a terminal on stdin, shows a menu and imports one choice.
With selectors, runs unattended and does not prompt.

Selectors (numbers or names; repeats are ignored; imports run in this order):
  1, main           Merge split commentary files, then import.sql
  2, interlineare   importinterlineare.sql
  3, quiz           importquiz.sql
  4, riassunti      importriassunti.sql
  5, studi          importstudi.sql
  6, vocabolario    importvocabolario.sql
  7, statistiche    importstatistiche.sql
  8, brani          importbrani.sql
  9, ntmss          ntmss/import.txt
  a, all, --all     Every import above

Do not combine "all" with other selectors.
--help, -h         Show this help and exit.

The script changes to the Sito directory (docker-compose.yml) before importing.
EOF
}

# Space-padded set of menu ids, e.g. " 1 6 9 ".
chosen_ids=" "

mark() {
  case "$chosen_ids" in
    *" $1 "*) ;;
    *) chosen_ids="${chosen_ids}${1} " ;;
  esac
}

wants() {
  case "$chosen_ids" in
    *" $1 "*) return 0 ;;
    *) return 1 ;;
  esac
}

mark_all() {
  local id
  for id in 1 2 3 4 5 6 7 8 9; do
    mark "$id"
  done
}

# Sets selector_id to a menu id, "all", or "help". Returns 1 if unknown.
selector_id=
classify_selector() {
  local raw trimmed
  raw=$1
  trimmed=$(printf '%s' "$raw" | tr '[:upper:]' '[:lower:]' | sed 's/^[ \t]*//;s/[ \t]*$//')
  trimmed=${trimmed#--}
  case "$trimmed" in
    -h|help) selector_id=help ;;
    a|all) selector_id=all ;;
    1|main) selector_id=1 ;;
    2|interlineare) selector_id=2 ;;
    3|quiz) selector_id=3 ;;
    4|riassunti) selector_id=4 ;;
    5|studi) selector_id=5 ;;
    6|vocabolario) selector_id=6 ;;
    7|statistiche) selector_id=7 ;;
    8|brani) selector_id=8 ;;
    9|ntmss) selector_id=9 ;;
    *)
      selector_id=
      return 1
      ;;
  esac
}

require_selector() {
  if ! classify_selector "$1"; then
    echo "Unknown selector: '$1'" >&2
    usage >&2
    exit 1
  fi
  if [ "$selector_id" = "help" ]; then
    usage
    exit 0
  fi
}

if [ "$#" -eq 0 ]; then
  if [ ! -t 0 ]; then
    echo "No selector given and stdin is not a terminal. Example: import-tool.sh --all" >&2
    echo "Run import-tool.sh --help for the selector list." >&2
    exit 2
  fi

  echo "What do you want to import?"
  echo "1) Main db tables (import.sql)"
  echo "2) Interlineare (importinterlineare.sql)"
  echo "3) Quiz (importquiz.sql)"
  echo "4) Riassunti (importriassunti.sql)"
  echo "5) Studi (importstudi.sql)"
  echo "6) Vocabolario (importvocabolario.sql)"
  echo "7) Statistiche (importstatistiche.sql)"
  echo "8) Brani (importbrani.sql)"
  echo "9) NT manoscritti/greco (ntmss/import.txt)"
  echo "a) All of the above"

  read -r -p "> " choice
  require_selector "$choice"
  if [ "$selector_id" = "all" ]; then
    mark_all
  else
    mark "$selector_id"
  fi
else
  saw_all=0
  saw_specific=0
  for arg in "$@"; do
    require_selector "$arg"
    if [ "$selector_id" = "all" ]; then
      saw_all=1
    else
      saw_specific=1
      mark "$selector_id"
    fi
  done
  if [ "$saw_all" -eq 1 ] && [ "$saw_specific" -eq 1 ]; then
    echo "Do not combine 'all' with other selectors." >&2
    exit 1
  fi
  if [ "$saw_all" -eq 1 ]; then
    mark_all
  fi
fi

cd "$COMPOSE_DIR"

import_sql() {
  local f=$1
  docker compose exec -T -e f="$f" db sh -c '
    cd /var/lib/mysql-files/data &&
    echo "Importing $f..." &&
    export MYSQL_PWD=$MYSQL_PASSWORD &&
    mysql --local-infile=1 -u"$MYSQL_USER" < "$f"
  '
}

if wants 1; then
  docker compose exec -T db sh -c 'cd /var/lib/mysql-files/data && \
    echo "Merging commentpulpitoA.txt & commentpulpitoB.txt -> commentpulpito.txt" && \
    cat commentpulpitoA.txt commentpulpitoB.txt > commentpulpito.txt && \
    echo "Merging commentillustratoreA.txt & commentillustratoreB.txt -> commentillustratore.txt" && \
    cat commentillustratoreA.txt commentillustratoreB.txt > commentillustratore.txt'
  import_sql "import.sql"
fi

if wants 2; then
  import_sql "importinterlineare.sql"
fi
if wants 3; then
  import_sql "importquiz.sql"
fi
if wants 4; then
  import_sql "importriassunti.sql"
fi
if wants 5; then
  import_sql "importstudi.sql"
fi
if wants 6; then
  import_sql "importvocabolario.sql"
fi
if wants 7; then
  import_sql "importstatistiche.sql"
fi
if wants 8; then
  import_sql "importbrani.sql"
fi

if wants 9; then
  docker compose exec -T db sh -c '
    cd /var/lib/mysql-files/data/ntmss &&
    echo "Importing ntmss/import.txt..." &&
    export MYSQL_PWD=$MYSQL_PASSWORD &&
    mysql --local-infile=1 -u"$MYSQL_USER" < import.txt
  '
fi
