# Silentlab

Official website for the band Silentlab.

## Technology

- PHP pages and includes
- Plain JavaScript for page interactions
- CSS for responsive layout
- JSON records for Events and lyrics

The site retains its existing public page routes and content.

## Deployment

GitHub Actions uploads runtime files via FTPS after website changes are
pushed to `main`. Run Deploy website manually for the initial upload or
a retry. Configure repository secrets `FTP_SERVER`, `FTP_USERNAME`,
`FTP_PASSWORD` and `SERVER_DIR`. The destination must end in `/`.
Documentation, development tooling and source design files are excluded.
