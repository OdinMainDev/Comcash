@extends("admin.layouts.dashboard")
@section("content")

@include("admin.components.dashboard.header")
@include("admin.components.dashboard.small_charts")
@include("admin.components.dashboard.revenue_chart")
@include("admin.components.dashboard.exchanges_affiliate_charts")
@include("admin.components.dashboard.statistic_table")
    
@endsection