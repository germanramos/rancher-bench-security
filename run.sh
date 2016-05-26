#!/bin/sh

PWD=/tmp/cis
FILE=report.txt

mkdir -p ${PWD}

cp web/* ${PWD}

echo "Pending..." > ${PWD}/${FILE}

while true; do
  echo "Hostname: `hostname`" > report.part
  /bin/sh docker-bench-security.sh | tee -a report.part
  mv report.part ${PWD}/${FILE}
  echo "Waiting ${INTERVAL} seconds for next report"
  sleep ${INTERVAL}
done
