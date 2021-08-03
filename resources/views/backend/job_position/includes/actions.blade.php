<x-utils.edit-button
        :href="route('admin.job.edit', $job->id)"
        :text="__('Edit')" />  
        
<x-utils.delete-button
            :href="route('admin.job.destroy', $job)"
            :text="__('Delete')" />
