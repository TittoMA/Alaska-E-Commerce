@extends('layouts.master')

@section('title', 'Notification |')

@section('content')

<div class="container mt-4">

    <h5 class="mb-3">Unread Notifications</h5>

    @forelse ($notifications as $item)
    <div class="card br-card def-shadow mb-2">
        <div class="card-body">
            <p style="font-size: 13px; margin-bottom: 0">
                {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y h:i')}}
            </p>
            <h5 style="color: #585858">{{ $item->data['message'] }}</h5>
            <a class="mark-as-read" href="#" data-id="{{ $item->id }}">Mark as read</a>
        </div>
    </div>
    @empty
    <h4>No New Notification</h4>
    @endforelse

</div>
@endsection

@section('script')
<script>
    function sendMarkRequest(id) {
        return $.ajax("{{ route('markNotification') }}", {
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                window.location.reload();
            });
        });
    });
</script>
@endsection