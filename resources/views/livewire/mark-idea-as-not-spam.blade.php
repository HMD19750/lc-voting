<x-modal-confirm
    event-to-open-modal='custom-show-mark-as-not-spam-modal.window'
    event-to-close-modal='ideaWasMarkedAsNotSpam'
    modal-title='Reset spam counter to 0'
    modalDescription='Are you sure you want to mark this idea is not spam? This action cannot be undone.'
    modal-confirm-button-text='Reset spam counter'
    wire-click='markIdeaAsNotSpam'
/>

