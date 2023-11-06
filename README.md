> Develop WordPress plugin for test task
# Auto Posts WordPress plugin 
#### This plugin is designed to automatically create posts at a specific url, which has a json post format. This plugin creates posts by URL, defines a category that is automatically created, loads the image into feature images, etc. The addition of posts is indicated after a certain period of time via cron.
## Development guide
### Clone plugin repository
```bash
git clone https://github.com/Shayerdev/plugin-cpamatica-autoposts.git
cd plugin-cpamatica-autoposts
```
### Install development dependency.
```bash
composer install
```
> **Warning:** <a href="https://getcomposer.org/" target="_blank">Composer</a> could have been installed in your machine. Check this by composer -h in terminal
### Update autoload files
```bash
composer build
```
### Test code format by PHP CodeSniffer (PSR-12)
```bash
vendor/bin/phpcs --standard=PSR12 ./src
```
### Autofix Code Format
```bash
vendor/bin/phpcbf --standard=PSR12 ./src
```
### For compile css/js you have must use Webpack
```bash
npm install
```
### For development webpack css/js 
```bash
npm run watch
```
### For build webpack css/js
```bash
npm run build
```

## Next steps after Download plugin and activate
- Go to plugin setting page (CPAM AutoPosts)
- See instruction for use
- Now you have link for upload a new post **(Update posts url)**
- You also append this link to cron job for auto upload post
- Copy example shortcode and paste to block shortcode to your page/post
- Enjoy ❤️