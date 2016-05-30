# pastethingy 
A simple paste web application made with [Laravel 5.2](https://laravel.com) and [Pygments](http://pygments.org) via [Pygmentize](https://github.com/dedalozzo/pygmentize).

## Features
  * Paste expiry 
  * Future pastes
  * Code highlighting
  * Useful output formats (e.g. HTML, raw, terminal, PNG)
  * Works without JS (optional JS for entering tab characters with the tab key) 
  * Usable via curl (e.g. `echo test | curl pastethingy.my.domain/paste -F 'content=<-'`)
  * No bloat (no user accounts, no deletion URLs, no encryption, etc.)
  * No CSS framework
  * JSON API

## JSON API
TODO: Document the JSON API.

## License
pastethingy is available under the University of Illinois/NCSA Open Source License.
The full license can be found in the [LICENSE.md](LICENSE.md) file.
