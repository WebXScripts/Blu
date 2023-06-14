<div>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            @foreach($this->columns() as $column)
                <th>
                    <div class="py-3 px-6 flex items-center">
                        {{ $column->label }}
                    </div>
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($this->data() as $row)
            <tr class="bg-white border-b hover:bg-gray-50">
                @foreach($this->columns() as $column)
                    <td>
                        <div class="py-3 px-6 flex items-center cursor-pointer">
                            <x-dynamic-component
                                :component="$column->component"
                                :value="$row[$column->key]"
                            >
                            </x-dynamic-component>
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $this->data()->links('livewire.tables.base.pagination') }}
</div>
