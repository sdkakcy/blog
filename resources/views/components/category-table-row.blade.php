<tr>
    <td>{{ $category->id }}</td>
    <td>{{ Str::repeat('—', $level) }} {{ $category->name }}</td>
    <td>{{ $category->created_at }}</td>
    <td>{{ $category->updated_at }}</td>
    <td class="text-end">
        @can('update category')
            <a href="{{ route('panel.categories.edit', ['category' => $category->id]) }}" type="button" class="btn btn-sm btn-primary">{{ __('Düzenle') }}</a>
        @endcan
        @can('delete category')
            <form class="d-inline-flex" action="{{ route('panel.categories.destroy', $category->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">{{ __('Sil') }}</button>
            </form>
        @endcan
    </td>
</tr>

@php
    $level++;
@endphp

@foreach($category->children as $child)
    <x-category-table-row :category="$child" :level="$level" />
@endforeach
