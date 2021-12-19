<x-modal-confirm
    event-to-open-modal='custom-show-delete-modal'
    event-to-close-modal='ideaWasDeleted'
    modal-title='Delete Idea'
    modalDescription='Are you sure you want to delete this idea? This action cannot be undone.'
    modal-confirm-button-text='Delete'
    wire-click='deleteIdea'
/>
