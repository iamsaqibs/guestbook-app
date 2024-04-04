[#](#) Guestbook Example

# Setup

## Docker

You will need `docker` installing on your machine.
If you're on Windows, we recommend you set up Docker Desktop with WSL2

## Laravel Sail

If you don't have PHP and composer installed on your host machine (why would you when running docker?)
then run the following from your project root.
This will install all the needed composer dependencies.

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Before proceeding, copy the contents of `.env.example` into `.env` and do any necessary adjustments like ports.

Spin up with Laravel sail
```shell
./vendor/bin/sail up -d
```

-   You should then run the demo seeder:

```shell
./vendor/bin/sail artisan migrate:refresh
./vendor/bin/sail artisan db:seed
```
## NPM 

You should also run 
```shell
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev -d
```
To be able to access the app from the browser
This is also an important step or the Feature Tests will fail.

## Running UNIT tests

```shell
./vendor/bin/sail test tests/
```

# The application

This is a basic guestbook application.

There is a stateful API layer (uses cookies & Laravel sessions) and some
basic views.

In this application, I chose to implement the Service Repository pattern for handling the logic related to the guestbook feature. Below are the reasons why this pattern was opted for:
Separation of Concerns: By utilizing the Service Repository pattern, we maintain a clear separation of concerns within our application. Each component (Controller, Service, Repository) has a distinct responsibility, making the codebase easier to understand and maintain.
Improved Testability: With this pattern, it becomes easier to write unit tests for each layer of our application. We can mock dependencies (such as repositories) in our service layer to isolate and test the business logic independently.
Flexibility and Scalability: The Service Repository pattern offers flexibility and scalability as our application grows. It allows us to make changes to the underlying data access logic (repository) without affecting the higher-level business logic (service), promoting code reuse and maintainability.
Encapsulation of Business Logic: Business logic is encapsulated within the service layer, making it more reusable across different parts of the application. This promotes cleaner, more modular code that is easier to extend and modify.
Centralized Data Access Logic: The repository layer acts as a centralized point for data access operations. This helps in keeping the data access logic organized and consistent throughout the application, reducing code duplication and potential errors.
Easier Integration with Third-party Services: By abstracting data access operations behind a repository interface, it becomes easier to integrate with third-party services or switch between different data storage solutions without affecting the higher-level business logic.
In summary, the Service Repository pattern enhances maintainability, testability, and scalability of our application while promoting clean, modular code design.

### Useful information

```shell
# this requires `httpie` - https://httpie.io/
http get localhost/api/guestbook

http post localhost/api/guestbook/sign \
    title="Wowsers..." content="This is amazing" name="Gatesy" real_name="Gill Bates" email="retired@msft.com"

http get localhost/api/guestbook/some-id

http delete localhost/api/guestbook/some-id

# As user-a
http --session=user-a post localhost/auth/login \
    email="user-a@example.com" password="user-a"

http --session=user-a post localhost/api/guestbook/sign \
    title="Foo" content="123" name="user-a" real_name="User Alpha" email="user-a@example.com"

http --session=user-a get  localhost/api/guestbook/my

# As user-b
http --session=user-b post localhost/auth/login g \
    email="user-b@example.com" password="user-b"

http --session=user-a post localhost/api/guestbook/sign \
    title="Foo" content="123" name="user-b" real_name="User Bravo" email="user-b@example.com"

http --session=user-b get  localhost/api/guestbook/my
```