FROM innotech/docker-bench-security:1.10.0

COPY run.sh /docker-bench-security
COPY ansi2html.sh /docker-bench-security
COPY web /docker-bench-security

ENTRYPOINT ["/bin/sh", "run.sh"]
