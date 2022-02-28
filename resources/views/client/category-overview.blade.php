@extends('layouts.app')
@section('content')
<div class="container">
    <nav class="breadcrumb">
      <a href="/" class="breadcrumb-item">Forum Category</a>
      <span class="breadcrumb-item active">Category overview</span>
    </nav>

    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <!-- Category one -->
          <div class="col-lg-12">
            <!-- second section  -->
            <h4 class="text-white bg-info mb-0 p-4 rounded-top">
              {{ $category->title }}
            </h4>
            <table
              class="table table-striped table-responsive table-bordered mb-xl-0"
            >
              <thead class="thead-light">
                <tr>
                  <th scope="col">Forum</th>
                  <th scope="col">Topics</th>
                  <th scope="col">Posts</th>
                </tr>
              </thead>
              <tbody>
                  @if (count($category->forum)>0)
                      @foreach ($category->forum as $forum )
                      <tr>
                        <td>
                          <h3 class="h5">
                            <a href="{{ route('forum.overview',$forum->id) }}" class="text-uppercase">{{ $forum->title }}</a>
                          </h3>
                          <p class="mb-0">
                            {!! $forum->desc !!}
                          </p>
                        </td>
                        <td><div>{{ count($forum->topic) }}</div></td>
                        <td><div>{{ count($forum->post) }}</div></td>
                      </tr>
                      @endforeach
                  @else
                      <h4>No forums in this category</h4>
                  @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <aside>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Members Online</h4>
              <ul class="list-unstyled mb-0">
                <li><a href="#">Member name</a></li>
                <li><a href="#">Member name</a></li>
                <li><a href="#">Member name</a></li>
                <li><a href="#">Member name</a></li>
                <li><a href="#">Member name</a></li>
              </ul>
            </div>
            <div class="card-footer">
              <dl class="row">
                <dt class="col-8 mb-0">Total:</dt>
                <dd class="col-4 mb-0">10</dd>
              </dl>
              <dl class="row">
                <dt class="col-8 mb-0">Members:</dt>
                <dd class="col-4 mb-0">10</dd>
              </dl>
              <dl class="row">
                <dt class="col-8 mb-0">Guests:</dt>
                <dd class="col-4 mb-0">3</dd>
              </dl>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Members Statistics</h4>
              <dl class="row">
                <dt class="col-8 mb-0">Total Forums:</dt>
                <dd class="col-4 mb-0">15</dd>
              </dl>
              <dl class="row">
                <dt class="col-8 mb-0">Total Topics:</dt>
                <dd class="col-4 mb-0">500</dd>
              </dl>
              <dl class="row">
                <dt class="col-8 mb-0">Total members:</dt>
                <dd class="col-4 mb-0">200</dd>
              </dl>
            </div>
            <div class="card-footer">
              <div>Newest Member</div>
              <div><a href="#">Member Name</a></div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
@endsection
