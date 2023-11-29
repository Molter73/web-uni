.PHONY: all
all: download-bootstrap compile-sass

.PHONY: download-bootstrap
download-bootstrap:
	wget https://github.com/twbs/bootstrap/archive/v5.0.2.zip
	unzip $(CURDIR)/v5.0.2.zip
	rm -f $(CURDIR)/v5.0.2.zip

.PHONY: compile-sass
compile-sass:
	sass $(CURDIR)/style.scss $(CURDIR)/style.css

.PHONY: watch-sass
watch-sass:
	sass --watch $(CURDIR)/style.scss $(CURDIR)/style.css

.PHONY: clean
clean:
	rm -rf $(CURDIR)/bootstrap-5.0.2/
	rm -f $(CURDIR)/v5.0.2.zip
	rm -f $(CURDIR)/style.css $(CURDIR)/style.css.map

