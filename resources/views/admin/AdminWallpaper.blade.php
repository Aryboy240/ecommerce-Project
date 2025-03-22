@extends('layouts.adminLayout')

@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminWallpaper.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('title', 'Optique | Admin Wallpapers')

@section('content')
<div class="main-content">
    <main class="dashboard">
        <div class="page-header">
            <h1>Change Wallpaper</h1>
        </div>

        <div class="wallpapers">
            @foreach ($wallpapers as $wallpaper)
                <div class="wallpaper-item {{ $wallpaper->is_selected ? 'selected' : '' }}" 
                     data-id="{{ $wallpaper->id }}" 
                     data-path="{{ asset($wallpaper->video_path) }}">
                    <video src="{{ asset($wallpaper->video_path) }}" muted loop></video>
                </div>
            @endforeach
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('.wallpaper-item').click(function() {
            let wallpaperId = $(this).data('id');
            let videoPath = $(this).data('path');

            $.ajax({
                url: "{{ route('change.wallpaper') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    wallpaper_id: wallpaperId
                },
                success: function(response) {
                    if (response.success) {
                        $('.wallpaper-item').removeClass('selected');
                        $(`[data-id='${wallpaperId}']`).addClass('selected');
                        $('.background-video').attr('src', response.video_path);
                    }
                }
            });
        });
    });
</script>
@endsection
