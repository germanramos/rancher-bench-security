FROM innotech/docker-bench-security:1.10.0

COPY run.sh /docker-bench-security

ENTRYPOINT ["/bin/sh", "run.sh"]
