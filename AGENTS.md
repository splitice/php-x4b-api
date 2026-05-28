# Development Guide

This project targets PHP 8.2+ and uses GitHub Actions for CI.

## Working Practices

- Keep the public API stable unless you are fixing a clear bug.
- Prefer small, targeted refactors over broad rewrites.
- Add or update tests whenever behavior changes.
- Do not commit `composer.lock`; this repository is maintained as a library.

## Local Setup

- Install dependencies with `composer install`.
- Required PHP extensions include `curl` and `json`.
- Phan can run locally with the fallback parser; CI installs `ext-ast`.

## Verification Commands

- `composer validate --strict`
- `composer phplint`
- `composer phpstan`
- `composer phan`
- `composer test`
- `composer ci`

Pull requests should keep the GitHub Actions workflow green before merge.
