#!/bin/bash
set -euo pipefail

SCRIPT_DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)
COMPOSE_DIR=$(cd "$SCRIPT_DIR/.." && pwd)

usage() {
  cat <<'EOF'
Usage: import-tool.sh [option ...] [selector ...]

With no arguments, and a terminal on stdin, shows a menu and imports one choice.
With selectors, runs unattended and does not prompt.

A failed import stops the script and exits with that command's status.
If later selected imports have not started, their names are printed on stderr.

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
--ignore-errors    Run the remaining imports after a failure, then exit 0.
--help, -h         Show this help and exit.

The script changes to the Sito directory (docker-compose.yml) before importing.
EOF
}

# Space-padded set of menu ids, e.g. " 1 6 9 ".
chosen_ids=" "
ignore_errors=0
# Space-separated short names of imports that failed under --ignore-errors.
failed_names=""

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

# Short name used when telling the user which import failed or was skipped.
step_name() {
  case "$1" in
    1) printf '%s' "main" ;;
    2) printf '%s' "interlineare" ;;
    3) printf '%s' "quiz" ;;
    4) printf '%s' "riassunti" ;;
    5) printf '%s' "studi" ;;
    6) printf '%s' "vocabolario" ;;
    7) printf '%s' "statistiche" ;;
    8) printf '%s' "brani" ;;
    9) printf '%s' "ntmss" ;;
    *) printf '%s' "$1" ;;
  esac
}

# Names of selected imports that come after the one that just failed.
skipped_after() {
  local failed_id=$1
  local id skipped=""
  for id in 1 2 3 4 5 6 7 8 9; do
    if [ "$id" -le "$failed_id" ]; then
      continue
    fi
    if wants "$id"; then
      skipped="${skipped}$(step_name "$id") "
    fi
  done
  printf '%s' "$skipped"
}

# Runs one import. On failure, either stops the script or records the name and returns 0.
run_step() {
  local id=$1
  shift
  set +e
  "$@"
  local status=$?
  set -e
  if [ "$status" -eq 0 ]; then
    return 0
  fi
  local name
  name=$(step_name "$id")
  echo "Import failed: ${name} (exit status ${status})." >&2
  if [ "$ignore_errors" -eq 1 ]; then
    echo "Continuing with the remaining imports because --ignore-errors is set." >&2
    failed_names="${failed_names}${name} "
    return 0
  fi
  local skipped
  skipped=$(skipped_after "$id")
  if [ -n "$skipped" ]; then
    echo "Stopped before processing all imports. Not started: ${skipped% }" >&2
  fi
  exit "$status"
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
  selector_args=()
  for arg in "$@"; do
    if [ "$arg" = "--ignore-errors" ]; then
      ignore_errors=1
      continue
    fi
    selector_args+=("$arg")
  done
  if [ "${#selector_args[@]}" -eq 0 ]; then
    echo "No selector given. Example: import-tool.sh --all" >&2
    echo "Run import-tool.sh --help for the selector list." >&2
    exit 2
  fi
  for arg in "${selector_args[@]}"; do
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

import_main() {
  docker compose exec -T db sh -c 'cd /var/lib/mysql-files/data && \
    echo "Merging commentpulpitoA.txt & commentpulpitoB.txt -> commentpulpito.txt" && \
    cat commentpulpitoA.txt commentpulpitoB.txt > commentpulpito.txt && \
    echo "Merging commentillustratoreA.txt & commentillustratoreB.txt -> commentillustratore.txt" && \
    cat commentillustratoreA.txt commentillustratoreB.txt > commentillustratore.txt' &&
    import_sql "import.sql"
}

import_ntmss() {
  docker compose exec -T db sh -c '
    cd /var/lib/mysql-files/data/ntmss &&
    echo "Importing ntmss/import.txt..." &&
    export MYSQL_PWD=$MYSQL_PASSWORD &&
    mysql --local-infile=1 -u"$MYSQL_USER" < import.txt
  '
}

if wants 1; then
  run_step 1 import_main
fi
if wants 2; then
  run_step 2 import_sql "importinterlineare.sql"
fi
if wants 3; then
  run_step 3 import_sql "importquiz.sql"
fi
if wants 4; then
  run_step 4 import_sql "importriassunti.sql"
fi
if wants 5; then
  run_step 5 import_sql "importstudi.sql"
fi
if wants 6; then
  run_step 6 import_sql "importvocabolario.sql"
fi
if wants 7; then
  run_step 7 import_sql "importstatistiche.sql"
fi
if wants 8; then
  run_step 8 import_sql "importbrani.sql"
fi
if wants 9; then
  run_step 9 import_ntmss
fi

if [ -n "$failed_names" ]; then
  echo "Finished with errors in: ${failed_names% }" >&2
  echo "Exiting without an error because --ignore-errors is set." >&2
fi
