<x-modal-confirm
    event-to-open-modal='custom-show-mark-as-spam-modal'
    event-to-close-modal='ideaWasMarkedAsSpam'
    modal-title='Mark this idea as spam'
    modalDescription='Are you sure you want to mark this idea as spam? This action cannot be undone.'
    modal-confirm-button-text='Mark as spam'
    wire-click='markIdeaAsSpam'
/>

