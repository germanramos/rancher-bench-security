#!/bin/sh

PWD=/tmp/cis
FILE=report.txt

mkdir -p ${PWD}

cp web/* ${PWD}

echo "Pending..." > ${PWD}/${FILE}

while true; do
  /bin/sh docker-bench-security.sh | tee -a report.part
  cat report.part | sh ansi2html.sh > ${PWD}/${FILE}
  echo "Waiting ${INTERVAL} seconds for next report"
  sleep ${INTERVAL}
done
