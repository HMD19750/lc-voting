## Building a voting App
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



## Testing
For some reason tests started to behave strangly. 


## Toevoegen Markdown voor ideas, comments en status changes
- Gebruiken van Str::markdown() helper method
- Gebruiken van typography plugin van Tailwind om de markdown styling goed te krijgen
- Gebruiken van Flowbite toggle switch





-------

#Todo
de achtergrondkleur van de toggle switch in het editformulier aanpassen
