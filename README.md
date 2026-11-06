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
Individual event links use `/event?a=...`; old `/live.php` links redirect.
Social previews use the PNG logo rendered from the current SVG artwork.
Each release cover opens `/release?a=...`, with its artwork, Spotify
link and a link back to Releases. Individual social previews use the
release's PNG cover. Unknown releases return 404.

On phones, release covers, event posters and videos fill the page width.
Release and event grids use one column. Desktop layouts remain unchanged.

## Deployment

The standardized GitHub Actions workflow uploads runtime files using lftp
over SFTP after changes are pushed to `main`. It reads `.ftpignore` and
recovers changes since the last successful upload.
Configure `SFTP_HOST`, `SFTP_USERNAME`, `SFTP_PASSWORD`
and optional `SFTP_PORT` (22 by default). Existing `FTP_SERVER`,
`FTP_USERNAME` and `FTP_PASSWORD` secrets are accepted as
compatibility aliases. Verify their SFTP access and destination using the
read-only **check** mode before uploading. Full mode preserves remote-only files.
The workflow defines `SFTP_REMOTE_DIR` as `/home/flamenco/silentlab.net`.
The old destination variable and `SERVER_DIR` secret are not used.
Documentation, development tooling and source design files remain excluded.
Run `node --test .github/tests/deployment.cjs` for deployment tests.
See the shared [deployment procedure](../SITES.md#deployment).
