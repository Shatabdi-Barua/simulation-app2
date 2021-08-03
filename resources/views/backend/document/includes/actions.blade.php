<x-utils.edit-button
    :href="route('admin.document.edit', $document->id)"
    :text="__('Edit')" />
<x-utils.delete-button
    :href="route('admin.document.destroy', $document)"
    :text="__('Delete')" />  