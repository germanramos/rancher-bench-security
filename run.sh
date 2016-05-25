#!/bin/sh

PWD=/tmp/cis
FILE=report.txt

mkdir -p ${PWD}

echo "Pending..." > ${PWD}/${FILE}

while true; do
  /bin/sh docker-bench-security.sh | tee -a report.part
  mv report.part ${PWD}/${FILE}
  echo "Waiting 60 seconds for next report"
  sleep ${INTERVAL}
done
