## "Building a voting App"
# Training from Laracasts.com

#Link
https://laracasts.com/series/build-a-voting-app


# My own additions
- Moved the email of the admin to .env. Accessible through app.config.
- Status change of idea also generates a notification
- almost all buttons now use button.blade.php component
- when status of idea is changed, notification to all voters is a notification, not an email
- implemented likes for comments
- text search also searches the description of ideas
- a counter for the total number of ideas found is added to the search filter


## Testing
For some reason tests started to behave strangly. So don't trust them

## Additions I used for adding markdown
- The Laravel Str::markdown() helper method
- The Typography plugin of Tailwind to get the Markdown styling right
- Use of the Flowbite toggle switch



