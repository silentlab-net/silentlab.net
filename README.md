# Silentlab

Official website for the band Silentlab.

## Technology

- PHP pages and includes
- Plain JavaScript for page interactions
- CSS for responsive layout
- JSON records for Releases, Events and lyrics

Releases has its own page, linked from the main menu alongside Events,
Videos and Lyrics. Covers and official listening links are stored in
`data/releases.json`. The homepage retains the band logo, label and
Merch sections; social links remain in the footer.

Public section URLs are `/releases`, `/events`, `/videos` and `/lyrics`.
Events uses one page with Grid (default) and Details (`?view=details`).
Legacy PHP section URLs redirect to their clean equivalents, preserving queries.
Individual event links use `/event.php?a=...`; old `/live.php` links redirect.
Social previews use the PNG logo rendered from the current SVG artwork.
Each release cover opens `/release.php?a=...`, with its artwork, Spotify
link and a link back to Releases. Individual social previews use the
release's PNG cover. Unknown releases return 404.

## Deployment

GitHub Actions uploads runtime files via FTPS after website changes are
pushed to `main`. Run Deploy website manually for the initial upload or
a retry. Configure repository secrets `FTP_SERVER`, `FTP_USERNAME`,
`FTP_PASSWORD` and `SERVER_DIR`. A trailing `/` is added automatically.
Documentation, development tooling and source design files are excluded.
