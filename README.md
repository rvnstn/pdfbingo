# pdfbingo
Little php script which generate bingo sheets as pdf.

## Requirements
- php >= 5.1
- fpdf > 1.8

## Docker
To run this project in docker checkout this repo and run
```
composer install
```
build the container with
```
docker build -t pdfbinfo .
```
and start one instance with
```
docker run -dP pdfbingo
```
