#!/bin/sh

# USe git to set directory to root of the project
cd "$(git rev-parse --show-toplevel)" || exit 1

# Minify css file
minify -o style.min.css style.css
