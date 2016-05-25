#!/bin/sh

REPORT=/tmp/report.txt

echo "Pending..." > $REPORT

# logger(){
#   while true; do
#     cat $REPORT | nc -l -p 8080
#   done
# }
#
# logger &

while true; do
  /bin/sh docker-bench-security.sh | tee -a report.part
  mv report.part $REPORT
  echo "Waiting 60 seconds for next report"
  sleep 60
done
