.PHONY: all
all: build-container

.PHONY: compile-sass
compile-sass:
	make -C site/css/

.PHONY: build-container
build-container: compile-sass
	make -C container/

.PHONY: deploy-container
deploy-container:
	make build-container
	docker rm -f pandas || true
	docker run --rm -d --name pandas -p 9000:80 quay.io/mmoltras/pandas:latest

.PHONY: clean
clean:
	make -C site/css/ clean
