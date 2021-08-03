
<x-utils.edit-button
    :href="route('admin.unit.edit', $unit->id)"
    :text="__('Edit')" />
<x-utils.delete-button
    :href="route('admin.unit.destroy', $unit)"
    :text="__('Delete')" />  