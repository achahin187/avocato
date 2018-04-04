ALTER TABLE `users_rules` ADD COLUMN `deleted_at` timestamp NULL;
ALTER TABLE `installments` ADD COLUMN `deleted_at` timestamp NULL;
ALTER TABLE `clients_passwords` ADD COLUMN `deleted_at` timestamp NULL;
ALTER TABLE `user_company_details` ADD COLUMN `deleted_at` timestamp NULL;
ALTER TABLE `user_details` ADD COLUMN `deleted_at` timestamp NULL;
ALTER TABLE `subscriptions` ADD COLUMN `deleted_at` timestamp NULL;
