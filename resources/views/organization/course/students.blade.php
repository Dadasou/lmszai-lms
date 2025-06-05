@extends('layouts.organization')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{$course->title}} {{__('Enroll Students')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('organization.dashboard')}}">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('organization.course.index') }}">{{__('My Courses')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('Enroll Students')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-quiz-list-page instructor-all-student-page">

            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>{{$course->title}} {{__('Enroll Students')}}</h6>
                <a href="{{url()->previous()}}">{{__('Back')}}</a>
            </div>

            <div class="row">
                @if(count($enrollments) > 0)
                <div class="col-12">
                    <div class="table-responsive table-responsive-xl">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Enroll')}}</th>
                                <th scope="col">{{__('Expired')}}</th>
                                <th scope="col">{{__('Progress')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($enrollments as $enrollment)
                                <tr>
                                    <td>
                                        <div class="all-student-img-wrap">
                                            <img src="{{ getImageFile(@$enrollment->user->image_path) }}" alt="img" class="img-fluid">
                                        </div>
                                        <p>{{ @$enrollment->user->name }}</p>
                                        <p>{{ @$enrollment->user->email }}</p>
                                    </td>
                                    <td>{{ $enrollment->start_date }}</td>
                                    <td class="font-15 color-heading">{{ (checkIfExpired($enrollment)) ? (checkIfLifetime($enrollment->end_date) ? __('Lifetime') : \Carbon\Carbon::now()->diffInDays($enrollment->end_date, false).' '.__('days left') ) : __('Expired') }}</td>
                                    <td>
                                        <div class="review-progress-bar-wrap sf-course-students-progress-wrap">
                                            <!-- Progress Bar -->
                                            <div class="barras">
                                                <div class="progress-bar-box">
                                                    <div class="progress-hint-value font-14 color-heading">{{number_format(studentCourseProgress(@$enrollment->course->id, @$enrollment->id), 2)}}%</div>
                                                    <div class="barra">
                                                        <div class="barra-nivel" data-nivel="{{number_format(studentCourseProgress(@$enrollment->course->id, @$enrollment->id), 2)}}%" style="width: {{number_format(studentCourseProgress(@$enrollment->course->id, @$enrollment->id), 2)}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(@$enrollment->status == ACCESS_PERIOD_ACTIVE)
                                            <span>{{__('Active')}}</span>
                                        @else
                                            <span>{{ __('Revoked')}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination Start -->
                    @if(@$enrollments->hasPages())
                        {{ @$enrollments->links('frontend.paginate.paginate') }}
                    @endif
                <!-- Pagination End -->
                @else
                    <!-- If there is no data Show Empty Design Start -->
                    <div class="empty-data">
                        <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                        <h5 class="my-3">{{__('Empty Student')}}</h5>
                    </div>
                    <!-- If there is no data Show Empty Design End -->
                @endif
            </div>

        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('frontend/assets/js/instructor/view-student.js') }}"></script>
@endpush
