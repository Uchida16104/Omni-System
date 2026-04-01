FROM ubuntu:24.04
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y \
    php-cli php-xml curl wget git rustc cargo python3 python3-pip \
    openjdk-21-jdk build-essential clang
RUN wget https://ziglang.org/download/0.12.0/zig-linux-x86_64-0.12.0.tar.xz \
    && tar -xf zig-linux-x86_64-0.12.0.tar.xz -C /usr/local \
    && ln -s /usr/local/zig-linux-x86_64-0.12.0/zig /usr/local/bin/zig
RUN curl -s https://get.modular.com | sh - \
    && modular install mojo
WORKDIR /var/www/html/backend
COPY . /var/www/html/backend
RUN cargo build --release --manifest-path=/var/www/html/backend/core/Cargo.toml
RUN javac /var/www/html/backend/core/src/legacy/DataProcessor.java
RUN g++ -O3 /var/www/html/backend/core/src/legacy/security.cpp -o /var/www/html/backend/core/bin/security
RUN gcc -O3 /var/www/html/backend/core/src/legacy/network.c -o /var/www/html/backend/core/bin/network
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html/backend"]
