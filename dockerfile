FROM php:8.2

EXPOSE 8082

WORKDIR /quiz
COPY . /quiz/

ENTRYPOINT [ "tail" ]
CMD ["-f","/dev/null"]