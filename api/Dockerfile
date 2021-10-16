FROM python:3.11.0a1-alpine3.14
COPY . /usr/src/app
WORKDIR /usr/src/app
RUN apk add --no-cache gcc musl-dev python3-dev libffi-dev openssl-dev build-base ncurses-dev
RUN pip3 install --no-cache-dir -r requirements.txt
ENTRYPOINT ["python"]
CMD ["rest.py"] 
