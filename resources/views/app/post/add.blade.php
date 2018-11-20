@extends('layouts.admin')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
@endsection

@section('content')

    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <form action="/app/new/post" method="post">
                <h5>New {{ $postType->title }} @if(\Auth::user()->hasPermissionTo('edit posts')){!! button(null, "Save Item", "save", "pull-right", null, null, "button") !!}@endif</h5>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postTitle">Title</label>
                                <input value="" type="text" class="form-control" id="title"
                                       aria-describedby="postTitle" placeholder="Enter a title"
                                       required
                                       name="title">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postSlug">Slug</label>
                                <input value="" type="text" class="form-control" id="slug"
                                       required
                                       aria-describedby="postSlug" placeholder="example-slug" name="slug">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postStatus">Status</label><br>
                                <select class="custom-select" id="status" name="status"
                                        required
                                        aria-describedby="postStatus" style="width:100%;">
                                    <option value="PUBLISHED">Published</option>
                                    <option selected value="DRAFT">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @include('app.partials.post-fields')
                        <input type="hidden" name="post_type" value="{{$postType->slug}}"/>
                </form>
            </div>
        </div>
    </main>

    <script>

        $(document).ready(function () {
            $(".nav-link").click(function () {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });
            $('.date-picker').each(function () {
                $(this).datepicker({
                    templates: {
                        leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
                        rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
                    }
                }).on('show', function () {
                    $('.datepicker').addClass('open');

                    datepicker_color = $(this).data('datepicker-color');
                    if (datepicker_color.length != 0) {
                        $('.datepicker').addClass('datepicker-' + datepicker_color + '');
                    }
                }).on('hide', function () {
                    $('.datepicker').removeClass('open');
                });
            });
        });
    </script>
@endsection