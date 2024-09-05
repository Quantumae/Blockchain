# Copyright IBM Corp. All Rights Reserved.
#
# SPDX-License-Identifier: Apache-2.0

ARG GO_VER=1.20.6
ARG ALPINE_VER=3.10

FROM golang:${GO_VER}-alpine${ALPINE_VER}

WORKDIR /go/src/
COPY . .

RUN go get -d -v ./...
RUN go install -v ./...

EXPOSE 9999
CMD ["external"]
