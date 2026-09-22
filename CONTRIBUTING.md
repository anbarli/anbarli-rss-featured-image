# Contributing

Thanks for helping improve Anbarli RSS Featured Image.

## Good First Contributions

- Report compatibility results from RSS readers and newsletter tools.
- Improve documentation and examples.
- Add tests for RSS output.
- Add WordPress.org packaging improvements.
- Add troubleshooting notes for specific feed consumers.

## Development Notes

- Keep the plugin small and focused.
- Avoid adding an admin settings page unless there is a strong compatibility reason.
- Prefer WordPress hooks and filters over custom configuration surfaces.
- Keep output escaped and compatible with RSS XML.

## Pull Requests

1. Describe the user-facing problem.
2. Include before/after RSS output when behavior changes.
3. Keep changes scoped to one problem.
4. Update README or `readme.txt` when behavior or compatibility changes.

## Bug Reports

Please include:

- WordPress version
- PHP version
- Theme name
- Feed URL if public
- Whether the raw feed includes `<media:content>`
- The RSS reader or integration where the problem appears
