## Building a voting App
# Training from Laracasts.com

#Link
https://laracasts.com/series/build-a-voting-app


## Opmerkingen

# Aflevering 10
phpunit geeft een foutmelding op de test om een user te registreren

# Aflevering 30 - Search filter
Als extra gemplementeerd(in IdeasIndex.php) dat full text search ook in de description van een idea werkt.**


# Aflevering 40 - Edit Idea Test
Twee tests werken niet:
- test_single_idea_shows_on_the_show_page
- function test_does_not_show_edit_idea_livewire_component_when_user_does_not_have_authorization

# Aflevering 45 - Spam reports
Het is beter om voor spam reporting een aparte tabel te maken zoals voor votes. Dat voorkomt spam-spamming!

# Aflevering 48 - Comment model migration
De lijn links van de comments is nog niet doorlopend!->opgelost in commit van aflevering **49**

# Aflevering 50
Paginatio test in ShowIdeasTest werkt niet. Buiten werking gesteld


-------
## Toevoegen Markdown voor ideas, comments en status changes
- Gebruiken van Str::markdown() helper method
- Gebruiken van typography plugin van Tailwind om de markdown styling goed te krijgen
- Gebruiken van Flowbite toggle switch

## Others
- Moved the email of the admin to .env. Accessible through app.config.
- Status change of idea also generates notification
- almost all buttons now use button.blade.php component
- when status of idea is changed, notification to all voters is a notification, not an email



-------

#Todo
de achtergrondkleur van de toggle switch in het editformulier aanpassen
