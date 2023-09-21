# Laravel Developer Test Documentation

## Stripe Integration

- Integrated Stripe using the official Stripe PHP SDK.
- Created a purchase page where users can select products and pay via Stripe.
- Fully managable details & general info in user's profile.
- Payments processed via Stripe are saved in the database.

## Role-Based Access Control

- Four roles allowed: Admin, User, B2C Customer, and B2B Customer.
- Assigned roles to users based on the product they purchased.

## Product Management

- Created a Product model to manage products in the system.
- Seeded two products: B2C and B2B.
- Assigned roles to users based on the product they purchased.

## Key Pages

- Purchase & Register Page: Displays products and integrates Stripe payment.
- Login Page: Used Laravel's built-in authentication.
- Dashboard Page: info, based on current role. 
- User Listing: Displays all users for the super admin.
