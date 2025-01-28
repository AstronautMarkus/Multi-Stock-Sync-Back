# MercadoLibre API Reports Documentation
These endpoints are used to generate JSON reports on sales, products, profits, customer reviews, among other products.

However, these endpoints will only be used to generate reports in CSV or PDF format.

## Endpoints

### 1. **Get invoice report** (WIP)

**GET** `/mercadolibre/invoices/{client_id}`

> Note: For this endpoint to work, we must verify that there is a "client_id" with the value we send in the request registered in the system's database.

#### Response (Success)
```json
{
    "status": "success",
    "message": "Reporte de facturas obtenido con éxito.",
    "data": {
        "offset": 1,
        "limit": 2,
        "total": 0,
        "last_id": 0,
        "results": [],
        "errors": []
    }
}
```

### 2. **Get sales by month** (WIP)

**GET** `/mercadolibre/sales-by-month/{client_id}`

Optional query parameters:
- `month`: The month for which to retrieve sales data (e.g., `09` for September).
- `year`: The year for which to retrieve sales data (e.g., `2024`).

> Note: You can omit the `year` and `month` parameters, and the system will use the current date.

#### Response (Success)
```json
{
    "status": "success",
    "message": "Ventas por mes obtenidas con éxito.",
    "data": {
        "2025-01": {
            "total_amount": 30000,
            "orders": [
                {
                    "id": 1234567890,
                    "date_created": "2025-01-02T15:23:40.000-04:00",
                    "total_amount": 15000,
                    "status": "paid",
                    "sold_products": [
                        {
                            "order_id": 1234567890,
                            "order_date": "2025-01-02T15:23:40.000-04:00",
                            "title": "Producto A",
                            "quantity": 1,
                            "price": 15000
                        }
                    ]
                },
                {
                    "id": 1234567891,
                    "date_created": "2025-01-05T08:56:09.000-04:00",
                    "total_amount": 15000,
                    "status": "paid",
                    "sold_products": [
                        {
                            "order_id": 1234567891,
                            "order_date": "2025-01-05T08:56:09.000-04:00",
                            "title": "Producto B",
                            "quantity": 1,
                            "price": 15000
                        }
                    ]
                }
            ]
        }
    }
}
```

### 3. **Get annual sales**

**GET** `/mercadolibre/annual-sales/{client_id}`

Optional query parameters:
- `year`: The year for which to retrieve sales data (e.g., `2025`).

> Note: You can omit the `year` and the system will use the current date.

#### Response (Success)

```json
{
    "status": "success",
    "message": "Ventas anuales obtenidas con éxito.",
    "data": {
        "2025-01": {
            "total_amount": 10780,
            "orders": [
                {
                    "id": 1234567890,
                    "date_created": "2025-01-02T15:23:40.000-04:00",
                    "total_amount": 10780,
                    "status": "paid",
                    "sold_products": [
                        {
                            "order_id": 1234567890,
                            "order_date": "2025-01-02T15:23:40.000-04:00",
                            "title": "Producto Ejemplo",
                            "quantity": 2,
                            "price": 5390
                        }
                    ]
                }
            ]
        }
    }
}
```

### 4. **Get weeks of the month**

**GET** `/mercadolibre/weeks-of-month`

Optional query parameters:
- `year`: The year for which to retrieve sales data (e.g., `2025`).

- `month`: The month for which to retrieve sales data (e.g., `01`).

> Note: You can omit the `year` or `year` and the system will use the current date.

#### Response (Success)
```json
{
    "status": "success",
    "message": "Semanas obtenidas con éxito.",
    "data": [
        {
            "start_date": "2025-01-01",
            "end_date": "2025-01-05"
        },
        {
            "start_date": "2025-01-06",
            "end_date": "2025-01-12"
        },
        {
            "start_date": "2025-01-13",
            "end_date": "2025-01-19"
        },
        {
            "start_date": "2025-01-20",
            "end_date": "2025-01-26"
        },
        {
            "start_date": "2025-01-27",
            "end_date": "2025-01-31"
        }
    ]
}
```

### 5. **Get sales by week**

**GET** `/mercadolibre/sales-by-week/{client_id}`

Optional query parameters:
- `year`: The year for which to retrieve sales data (e.g., `2025`).
- `month`: The month for which to retrieve sales data (e.g., `01`).
- `week_start_date` (required): The start date of the week (e.g., `2025-01-01`).
- `week_end_date` (required): The end date of the week (e.g., `2025-01-07`).

> Note: You can omit the `year` and `month` parameters, and the system will use the current date. However, `week_start_date` and `week_end_date` are required.

#### Response (Success)
```json
{
    "status": "success",
    "message": "Ingresos y productos obtenidos con éxito.",
    "data": {
        "week_start_date": "2025-01-01",
        "week_end_date": "2025-01-07",
        "total_sales": 50000,
        "sold_products": [
            {
                "title": "Producto Imaginario A",
                "quantity": 3,
                "total_amount": 15000
            },
            {
                "title": "Producto Imaginario B",
                "quantity": 2,
                "total_amount": 20000
            },
            {
                "title": "Producto Imaginario C",
                "quantity": 1,
                "total_amount": 15000
            }
        ]
    }
}
```

### 6. **Get daily sales**

**GET** `/mercadolibre/daily-sales/{client_id}`

#### Response (Success)
```json
{
    "status": "success",
    "message": "Ventas diarias obtenidas con éxito.",
    "data": {
        "date": "2025-01-24",
        "total_sales": 0,
        "sold_products": []
    }
}
```

### 7. **Get top selling products**

**GET** `/mercadolibre/top-selling-products/{client_id}`

Optional query parameters:
- `year`: The year for which to retrieve sales data (e.g., `2025`).
- `month`: The month for which to retrieve sales data (e.g., `01`).

> Note: If we add `year` but not `month`, the system will consider the entire year. If we only add `month`, it will consider the machine's year. If we do not send either, it will consider the entire machine's year and no specific month.

#### Response (Success)

```json
{
    "status": "success",
    "message": "Productos más vendidos obtenidos con éxito.",
    "total_sales": 90390,
    "data": [
        {
            "title": "Producto Imaginario X",
            "quantity": 4,
            "total_amount": 21560
        },
        {
            "title": "Producto Imaginario Y",
            "quantity": 2,
            "total_amount": 18980
        },
        {
            "title": "Producto Imaginario Z",
            "quantity": 2,
            "total_amount": 24980
        },
        {
            "title": "Producto Imaginario W",
            "quantity": 1,
            "total_amount": 15180
        },
        {
            "title": "Producto Imaginario V",
            "quantity": 1,
            "total_amount": 9690
        }
    ]
}
```

### 8. **Get order statuses**

**GET** `/mercadolibre/order-statuses/{client_id}`

- `year`: The year for which to retrieve sales data (e.g., `2025`).

> Note: If the `year` parameter is not provided, the system will default to the current year.

> Note 2: If the `year` parameter is set to 'alloftimes', the system will return data for all years of sales.


#### Response (Success)
```json
{
    "status": "success",
    "message": "Estados de órdenes obtenidos con éxito.",
    "data": {
        "paid": 36,
        "pending": 0,
        "canceled": 0
    }
}
```

### 9. **Get top payment methods**

**GET** `/mercadolibre/top-payment-methods/{client_id}`



#### Response (Success)
```json
{
    "status": "success",
    "message": "Métodos de pago más utilizados obtenidos con éxito.",
    "request_date":"2025-01-27 19:06:15"
    "data": {
        "account_money": 39,
        "debit_card": 12,
        "credit_card": 2
    }
}
```

### 10. **Get store summary**

**GET** `/mercadolibre/summary/{client_id}`

#### Response (Success)
```json
{
    "status": "success",
    "message": "Resumen de la tienda obtenido con éxito.",
    "data": {
        "total_sales": 638056,
        "top_selling_products": [
            {
                "title": "Camiseta Mujer Jockey Shapewear K-435 Seamless Control",
                "quantity": 7,
                "total_amount": 88361
            },
            {
                "title": "Calcetin Mujer Lady Genny P-585 Bamboo Sin Costura",
                "quantity": 5,
                "total_amount": 11825
            },
            {
                "title": "Soquete Mujer Lady Genny P-545 Grueso Elasticado(100 Denier)",
                "quantity": 5,
                "total_amount": 11950
            },
            {
                "title": "Media Mujer Lady Genny P-439 Media Pantalon Compresion",
                "quantity": 5,
                "total_amount": 16450
            },
            {
                "title": "Cuadro Mujer Lady Genny C-27 Midi Cotton Spandex Fantasia",
                "quantity": 5,
                "total_amount": 23450
            }
        ],
        "order_statuses": {
            "paid": 36,
            "pending": 0,
            "canceled": 0
        },
        "daily_sales": 0,
        "weekly_sales": 0,
        "monthly_sales": 90390,
        "annual_sales": 90390,
        "top_payment_methods": {
            "account_money": 39,
            "debit_card": 12,
            "credit_card": 2
        }
    }
}
```

### 11. **Get refunds or returns by category**

**GET** `/mercadolibre/refunds-by-category/{client_id}`

Optional query parameters:
- `date_from`: The start date for the date range (e.g., `2023-01-01`).
- `date_to`: The end date for the date range (e.g., `2023-01-31`).
- `category`: The category ID to filter by (e.g., `MLC12345`).

> Note: You can omit the `date_from` and `date_to` parameters, and the system will use the current month. The `category` parameter is optional.

#### Response (Success)
```json
{
    "status": "success",
    "message": "Devoluciones por categoría obtenidas con éxito.",
    "data": {
        "MLC12345": {
            "category_id": "MLC12345",
            "total_refunds": 50000,
            "orders": [
                {
                    "id": 1234567890,
                    "date_created": "2023-01-02T15:23:40.000-04:00",
                    "total_amount": 15000,
                    "status": "cancelled",
                    "title": "Producto A",
                    "quantity": 1,
                    "price": 15000
                },
                {
                    "id": 1234567891,
                    "date_created": "2023-01-05T08:56:09.000-04:00",
                    "total_amount": 35000,
                    "status": "cancelled",
                    "title": "Producto B",
                    "quantity": 2,
                    "price": 17500
                }
            ]
        }
    }
}
```

### 11. **Get product reviews**

**GET** `/mercadolibre/products/reviews/{product_id}?client_id={client_id}`

Required query parameters:
- `client_id`: The MercadoLibre account client id (e.g., `12345678987654321`).


#### Response (Success)
```json
{
    "status": "success",
    "message": "Opiniones obtenidas con éxito.",
    "data": {
        "paging": {
            "total": 0,
            "limit": 5,
            "offset": 0,
            "kvs_total": 0
        },
        "reviews": [],
        "helpful_reviews": {
            "best_max_stars": null,
            "best_min_stars": null
        },
        "attributes": [],
        "quanti_attributes": [],
        "quali_attributes": [],
        "metadata": [],
        "rating_average": 0,
        "rating_levels": {
            "one_star": 0,
            "two_star": 0,
            "three_star": 0,
            "four_star": 0,
            "five_star": 0
        }
    }
}
```

### 11. **Get product reviews**

**GET** `/mercadolibre/compare-sales-data/{client_id}?year1={year1}&month1={month1}&year2={year2}&month2={month2}`

Required query parameters:
- `year1`: The first year for compare (e.g., `2024`).
- `month1`: The first month to compare (e.g, `10`).
- `year2`: The second year for compare (e.g., `2025`).
- `month2`: The second month to compare (e.g, `11`).


#### Response (Success)

```json
{
    "status": "success",
    "message": "Comparación de ventas obtenida con éxito.",
    "data": {
        "month1": {
            "year": "2024",
            "month": "10",
            "total_sales": 50000,
            "sold_products": [
                {
                    "order_id": 1,
                    "order_date": "2024-10-01",
                    "title": "Producto A",
                    "quantity": 2,
                    "price": 10000
                },
                {
                    "order_id": 2,
                    "order_date": "2024-10-02",
                    "title": "Producto B",
                    "quantity": 3,
                    "price": 5000
                }
            ]
        },
        "month2": {
            "year": "2025",
            "month": "01",
            "total_sales": 40000,
            "sold_products": [
                {
                    "order_id": 3,
                    "order_date": "2025-01-01",
                    "title": "Producto C",
                    "quantity": 1,
                    "price": 20000
                },
                {
                    "order_id": 4,
                    "order_date": "2025-01-02",
                    "title": "Producto D",
                    "quantity": 2,
                    "price": 10000
                }
            ]
        },
        "difference": -10000,
        "percentage_change": -20.0
    }
}
```
