
# rancher-bench-security

This container run with provileges in a rancher docker host and get information about security issues based on https://dockerbench.com/

In addition, it provides a logic to run in every docker host of your rancher enironment and a web interface to see the results

## Usage

docker run -it --net host --pid host --cap-add audit_control \
    -v /var/lib:/var/lib \
    -v /var/run/docker.sock:/var/run/docker.sock \
    -v /usr/lib/systemd:/usr/lib/systemd \
    -v /etc:/etc \
    -v /tmp:/tmp \
    --label docker_bench_security \
    innotech/rancher-bench-security:dev


NOTE: You may want to use it from rancher catalog
