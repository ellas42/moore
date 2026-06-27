@extends('admin.layout')
@section('title', 'Subscribers')

@section('content')
<div class="admin-header">
  <h1>Subscribers</h1>
  <p>Everyone waiting to hear about your next event.</p>
</div>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr><th>Name</th><th>Email</th><th>Subscribed</th></tr>
    </thead>
    <tbody>
      @forelse($subscribers as $sub)
      <tr>
        <td>{{ $sub->name }}</td>
        <td>{{ $sub->email }}</td>
        <td>{{ $sub->created_at->format('d M Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="3" style="text-align:center;color:var(--taupe);padding:40px;">No subscribers yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $subscribers->links() }}</div>
@endsection