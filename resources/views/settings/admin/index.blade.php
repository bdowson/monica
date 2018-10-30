@extends('layouts.skeleton')

@section('content')

 <div class="settings">

  {{-- Breadcrumb --}}
  <div class="breadcrumb">
   <div class="{{ auth()->user()->getFluidLayout() }}">
    <div class="row">
     <div class="col-xs-12">
      <ul class="horizontal">
       <li>
        <a href="{{ route('dashboard.index') }}">{{ trans('app.breadcrumb_dashboard') }}</a>
       </li>
       <li>
        <a href="{{ route('settings.index') }}">{{ trans('app.breadcrumb_settings') }}</a>
       </li>
       <li>
        {{ trans('app.breadcrumb_settings_admin') }}
       </li>
      </ul>
     </div>
    </div>
   </div>
  </div>

  <div class="{{ auth()->user()->getFluidLayout() }}">
   <div class="row">

    @include('settings._sidebar')

    <div class="col-xs-12 col-md-9">

     <div class="mb3">
      <h3 class="f3 fw5">{{ trans('settings.admin_tab_title') }}</h3>
      <p>{{ trans('settings.admin_title') }}</p>
     </div>

     @include('partials.errors')


     <div class="br3 ba b--gray-monica bg-white mb4">
      <div class="pa3 bb b--gray-monica">
       <admin-statistics></admin-statistics>
      </div>
     </div>

     <div class="br3 ba b--gray-monica bg-white mb4">
      <div class="pa3 bb b--gray-monica">
       <admin-accounts></admin-accounts>
      </div>
     </div>

     <div class="br3 ba b--gray-monica bg-white mb4">
      <div class="pa3 bb b--gray-monica">
       <admin-jobs></admin-jobs>
      </div>
     </div>

     <div class="br3 ba b--gray-monica bg-white mb4">
      <div class="pa3 bb b--gray-monica">
       <admin-logs></admin-logs>
      </div>
     </div>

    </div>
   </div>
  </div>
 </div>

@endsection
