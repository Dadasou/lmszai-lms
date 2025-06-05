@extends('layouts.organization')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('My Courses')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('organization.dashboard')}}">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item font-14" aria-current="page"><a href="{{ route('organization.course.index') }}">{{__('My Courses')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('organization.exam.index', @$exam->course->uuid) }}">{{ __('Quiz List') }}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{ __('Multiple Choice') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-quiz-list-page">
            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>{{$title}}</h6>
                <a href="{{ url()->previous() }}">{{__('Back')}}</a>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($take_exams->count() > 0)
                        <div class="table-responsive table-responsive-xl">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('Position')}}</th>
                                    <th scope="col">{{__('Student')}}</th>
                                    <th scope="col">{{__('Quiz Mark')}}</th>
                                    <th scope="col">{{__('Obtained Mark')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($take_exams as $k =>  $take_exam)
                                    @if($take_exam->user)
                                        <td>{{$k + 1}}</td>
                                        <td>
                                            <div class="align-items-center d-flex">
                                                <div class="student-img-wrap flex-shrink-0"><img
                                                        src="{{ getImageFile($take_exam->user->image_path) }}" alt="img"
                                                        class="img-fluid"></div>
                                                <div class="student-name font-medium color-heading">{{$take_exam->user->name}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            {{get_total_score($exam->id)}}
                                        </td>
                                        <td>
                                            {{get_student_by_student_score($exam->id, null)}}
                                        </td>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($take_exams->hasPages())
                            {{ $take_exams->links('frontend.paginate.paginate') }}
                        @endif
                        <!-- Pagination End -->
                    @else
                        <!-- If there is no data Show Empty Design Start -->
                        <div class="empty-data">
                            <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img"
                                 class="img-fluid">
                            <h5 class="my-3">{{__('Empty Participant')}}</h5>
                        </div>
                        <!-- If there is no data Show Empty Design End -->
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
