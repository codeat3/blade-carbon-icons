# Upgrade Guide

General steps for every update:

- Run `php artisan view:clear`

## Upgrading from Blade Icons

If you're upgrading from the original Blade Icons package there's very little steps you would need to take. The syntax for the Blade components has remained the same.

## Upgrading from 1.x to 2.x

When auto-update workflow was introduced in this package, we had changed the filename structure too. Previously all the icons where suffixed with `-32` which was removed in `^2.0` versions. So kindly make sure to remove the `-32` once you upgrade.

### Raw Icons

If you were using the raw exported icons you'll need to re-publish them with:

```bash
php artisan vendor:publish --tag=blade-carbon-icons --force
```

The new way to reference them is:

```blade
<img src="{{ asset('vendor/blade-carbon-icons/sigma.svg') }}" width="10" height="10"/>
```
