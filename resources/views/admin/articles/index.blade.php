@extends('layouts.admin')

@section('header_title', 'Manage News & Articles')

@section('admin_content')

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color);">Published Articles & News</h3>
            <a href="{{ route('admin.articles.create') }}" class="btn-primary">✍ Write New Article</a>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Language</th>
                        <th>Slug / URL Path</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $index => $article)
                        <tr>
                            <td style="font-weight: bold; color: var(--text-muted);">{{ $articles->firstItem() + $index }}</td>
                            <td>
                                @if($article->image_path)
                                    <img src="{{ $article->image_path }}" alt="" style="width: 50px; height: 35px; object-fit: cover; border-radius: 3px; border: 1px solid var(--border-color);">
                                @else
                                    <span style="font-size: 0.75rem; color: var(--text-muted); font-style: italic;">No Image</span>
                                @endif
                            </td>
                            <td style="font-weight: 700; color: var(--primary-color);">{{ $article->title }}</td>
                            <td><span style="font-size: 0.75rem; font-weight: bold; text-transform: uppercase; color: var(--accent-color);">{{ $article->category }}</span></td>
                            <td><span class="badge-locale">{{ $article->locale }}</span></td>
                            <td><code style="font-size: 0.8rem; background-color: #f1f5f9; padding: 2px 6px; border-radius: 3px;">/news/{{ $article->slug }}</code></td>
                            <td>
                                <span class="{{ $article->status == 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 8px;">
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-action btn-edit">Edit</a>
                                    <form action="{{ route('admin.articles.delete', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article? This will remove the dynamic page.');">
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 20px; color: var(--text-muted);">
                                No articles found. Click "Write New Article" to start.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $articles->links() }}
        </div>
    </div>

@endsection
