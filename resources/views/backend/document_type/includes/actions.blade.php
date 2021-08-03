<x-utils.edit-button
        :href="route('admin.document_type.edit', $documentType->id)"
        :text="__('Edit')" />  
        
<x-utils.delete-button
            :href="route('admin.document_type.destroy', $documentType)"
            :text="__('Delete')" />
