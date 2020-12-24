# Task: Matrix multiplication

Create a Laravel / Lumen application for Matrix multiplication. There should be an API accepting two matrices.

## Option 1: Run Server via Docker:

    docker-compose up -d
    
## Option 2: Run Server Locally:

    php -S localhost:8000 -t public

## Accessing the Server
    
    localhost:8000

## **Example API Requests:**

**Success Case:**
*Command:*
curl -X POST -H 'Content-Type: application/json' -i http://localhost:8000/api/v1/matrix --data '{"matrixA":[[1,1,4],[1,1,5]],"matrixB":[[1,1],[1,1],[1,1]]}'
*Response:*
{"result":"success","data":[["F","F"],["G","G"]]}

**Failed Case 1:**
*Command:*
curl -X POST -H 'Content-Type: application/json' -i http://localhost:8000/api/v1/matrix
*Response:*
Status Code: 422 Unprocessable Entity
{"result":"fail","errors":{"matrixA":["The matrix a field is required."],"matrixB":["The matrix b field is required."]}}

**Failed Case 2:**
*Command:*
curl -X POST -H 'Content-Type: application/json' -i http://localhost:8000/api/v1/matrix --data '{"matrixA":[[1,1],[1,1,5]],"matrixB":[[1,1],[1,1],[1,1]]}'
*Response:*
Status Code: 422 Unprocessable Entity
{"result":"fail","errors":{"matrixA":["matrix a must not be empty or has differnt row's length."],"matrixB":["The matrix b must contain 2 items."]}}

**Failed Case 3:**
*Command:*
curl -X POST -H 'Content-Type: application/json' -i http://localhost:8000/api/v1/matrix --data '{"matrixA":[[1,1,4,4],[1,1,5,4]],"matrixB":[[1,1],[1,1],[1,1]]}'
*Response:*
Status Code: 422 Unprocessable Entity
{"result":"fail","errors":{"matrixB":["The matrix b must contain 4 items."]}}

## Code Quality Checking (without docker container)

**Runing Unit Tests:**

Run tests by typing the following command (phpunit is already installed with Lumen):

    cd src && ./vendor/bin/phpunit && cd ..

**Runing Code Sniffer:**

Run code sniffer to validate PSR-12 coding standards (phpcs must be installed first):

    cd src && ./phpcs && cd ..

