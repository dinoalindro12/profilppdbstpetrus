{{--
    Komponen nav item reusable.
    Pakai: @include('admin.layouts.partials._nav-item', ['route' => '...', 'label' => '...', 'icon' => '...'])
--}}
@props(['route', 'label', 'icon' => null, 'active' => false])
