
START TRANSACTION;

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `code` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `categories_code_unique` (`code`),
  ADD UNIQUE KEY `categories_category_unique` (`category`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD UNIQUE KEY `products_product_name_unique` (`product_name`),
  ADD KEY `products_category_code_foreign` (`category_code`);


--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_code_foreign` FOREIGN KEY (`category_code`) REFERENCES `categories` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;
