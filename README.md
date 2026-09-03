# Chat App

A real-time chat application built with Laravel 7 and Livewire.

## Features

- Real-time one-to-one messaging
- Add/remove friends, with real-time updates
- Favorite conversations, with real-time toggling
- Real-time message deletion and "wipe all chats"
- Real-time authentication validation
- New message notifications

## Tech stack

- PHP / Laravel 7
- Livewire (real-time server-rendered components)
- MySQL

## Getting started

```bash
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Demo

A live demo is available at https://chatappdemo.barakhub.com/

## Testing

PHPUnit is configured; the repository currently includes only the default Laravel example tests.

## Status

12 commits (Feb–Mar 2022), single author. Deployed with a working public demo.
