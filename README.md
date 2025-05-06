# 🎯 Gambling.com Dev Test

This Laravel project filters affiliates from a provided `affiliates.txt` file and displays only those located within **100km** of the Dublin office.

- ✅ No database required
- ✅ Uses the haversine formula for geographic distance
- ✅ Reads from `affiliates.txt` as provided
- ✅ Tested and production-ready

---

## 📍 Dublin Office Coordinates

```text
Latitude: 53.3340285
Longitude: -6.2535495
```

🚀 Getting Started

1. Clone the Repository

```bash
git clone git@github.com:panicfilip/gambling-com-dev-test.git
cd gambling-com-dev-test
```

2. Start Docker Containers

```bash
docker compose up --build -d
```

3. Copy Environment File and Install Dependencies

```bash
cp .env.example .env
docker exec gambling-com-dev-test-app-1 composer install
```

4. Generate Laravel Application Key

```bash
docker exec gambling-com-dev-test-app-1 php artisan key:generate
```

📁 File Format — storage/app/affiliates.txt

The input file must contain one JSON object per line:

```json
{"affiliate_id": 1, "name": "John Doe", "latitude": 53.339428, "longitude": -6.257664}
```

The file should be placed at:

```text
storage/app/private/affiliates.txt
```

🧪 Running Tests

Run All Tests:

```bash
docker exec gambling-com-dev-test-app-1 php artisan test
```

Or directly:

```bash
docker exec gambling-com-dev-test-app-1 ./vendor/bin/phpunit
```

Run a Specific Test:

```bash
docker exec gambling-com-dev-test-app-1 php artisan test --filter=AffiliateFilterServiceTest
```

🛠 Technologies
- Laravel (PHP Framework)
- Docker / Docker Compose
- PHPUnit (Testing)
- Blade (Templating)

📌 Notes
- The app does not use a database (as per instructions).
- Uses real affiliates.txt from storage/app/private/, unaltered.
- Easily extendable via service classes or API integration.
