<div>
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ Str::repeat('—', $level) }} {{ $category->name }}</td>
        <td>{{ $category->created_at }}</td>
        <td>{{ $category->updated_at }}</td>
        <td class="text-end">
            <button type="button" class="btn btn-sm btn-primary">Düzenle</button>
            <button type="button" class="btn btn-sm btn-danger">Sil</button>
        </td>
    </tr>

    @foreach($category->childrenRecursive as $child)
        <x-category-table-row :category="$child" :level="++$level" />
    @endforeach
</div>