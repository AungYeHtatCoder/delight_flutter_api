@extends('user_layouts.master')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="card detail-box">
          <div class="img-post my-3">
            <img src="{{ asset('assets/img/blogs/'.$blog->image) }}" class="card-img-top w-100" alt="" />
          </div>
          <div class="post-title">
            <h4>{{ $blog->title }}</h4>
            <div class="d-flex">
                <div>
                    <small><i class="fas fa-calendar me-2" style="color: #37507E;"></i>{{ $blog->created_at->format('M j, Y') }}</small>
                </div>
                <div class="ms-3">
                    <small><i class="fas fa-user-circle me-2" style="color: #37507E;"></i>{{ $blog->users->name }}</small>
                </div>
            </div>


          </div>
          <div class="post-icon my-3">
            @auth
                @php
                    $user_like = App\Models\Admin\Like::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
                @endphp
                <a href="" onclick="event.preventDefault(); document.getElementById('like{{ $blog->id }}').submit();">
                    <i class="fa-{{ $user_like ? "solid" : "regular" }} fa-heart" style="font-size: 25px;"></i>
                </a>
                <form id="like{{ $blog->id }}" action="{{ url('/like/'.$blog->id) }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        @guest
        <a href="{{ route('login') }}">
            <i class="fa-regular fa-heart" style="font-size: 25px;"></i>
        </a>
        @endguest
        <span class="vertical-align-top fw-bold me-3">{{ $blog->likes_count }}</span>
            <a href="" style="padding-left: 15px">
                <i class="fa-regular fa-comment-dots" style="font-size: 25px;"></i>
            </a>
            <span class="vertical-align-top fw-bold me-3">{{ $blog->comments_count }}</span>
          </div>
          <div class="desp">
            <p>
              {!! $blog->description !!}
            </p>
          </div>
        </div>
        <div class="card">
          <div class="header">
            <h5>Comments {{ $blog->comments_count }}</h5>
          </div>
          <div class="body">
            <ul class="comment-reply list-unstyled">
                @foreach ($comments as $comment)
                    <li class="row clearfix mt-2">
                        <div class=" col-md-2 col-4">
                        <img class="rounded-circle" width="90px" height="90px" src="{{ asset('assets/img/profile/'.$comment->users->profile) }}" alt="Awesome Image" />
                        </div>
                        <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                        <h5 class="">{{ $comment->users->name}}</h5>
                        <p>
                            {{ $comment->comment }}
                        </p>
                        <ul class="list-inline">
                            <li><a href="javascript:void(0);">{{ $comment->created_at->format('M, j Y') }}</a></li>
                        </ul>
                        </div>
                    </li>
                    <hr />
                @endforeach
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="header">
            <h4>
              Send Your Comment
            </h4>
          </div>
          <div class="body">
            <div class="comment-form">
              <form class="row clearfix" method="POST" action="{{ url('/comment/create/'.$blog->id) }}">
                @csrf
                <div class="col-sm-12 mt-3">
                  <div class="form-group">
                    <textarea
                      rows="4"
                      class="form-control no-resize"
                      placeholder="Please type what you want..."
                      name="comment"
                    ></textarea>
                    @error('comment')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                  </div>
                  <button
                    type="submit"
                    class="btn btn-block btn-primary mt-3"
                  >
                    SUBMIT
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      @auth
      <div class="col-md-4">
        <div class="card p-4 user">
          <div
            class="image d-flex flex-column justify-content-center align-items-center"
          >
            <div class="">
              <img src="{{ asset('assets/img/profile/'.Auth::user()->profile) }}" height="100" width="100" />
            </div>
            <span class="name mt-3">{{ Auth::user()->name }}</span>
            {{-- <span class="id">@emilly</span> --}}

            <div class="d-flex mt-2">
                <a href="{{ url('/home') }}">Edit Profile</a>
              {{-- <button class="btn btn-primary"></button> --}}
            </div>

            <div class="px-2 rounded mt-4 date">
              <span class="join">Joined {{ Auth::user()->created_at->format("M, j Y") }}</span>
            </div>
          </div>
        </div>
      </div>
      @endauth

    </div>
  </div>
@endsection
