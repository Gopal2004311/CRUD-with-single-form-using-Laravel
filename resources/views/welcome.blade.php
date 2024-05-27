{{-- @php session_start();@endphp --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Multi Action Form</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
        <style>tr{cursor: pointer;}</style>
    </head>
    <body class="bg-dark">
        <div class="container mt-3 shadow-lg p-5 bg-light rounded-3">
            <div class="alert
                @if (!isset($_SESSION['success']) && !isset($_SESSION['update']) && !isset($_SESSION['delete']))d-none @endif
                @isset($_SESSION['success'])alert-success @endisset
                @isset($_SESSION['update'])alert-primary @endisset
                @isset($_SESSION['delete'])alert-danger @endisset
            ">
            <span>
                @isset($_SESSION['success']){!!$_SESSION['success']!!} @php unset($_SESSION['success'])@endphp @endisset
                @isset($_SESSION['update']){!!$_SESSION['update']!!}@php unset($_SESSION['update'])@endphp @endisset
                @isset($_SESSION['delete']){!!$_SESSION['delete']!!}@php unset($_SESSION['delete'])@endphp @endisset
            </span>
            </div>
            <div class="heading mb-5">
                <h2 class="text-center text-primary">All Operation Form</h2>
            </div>
            <div class="form-box row g-3 col-12">
                <form id="myForm" method="post" autocomplete="off">
                    @csrf
                    <span id="method"></span>
                    <div class="col-12 d-flex g-3 mt-1">
                        <div class="form-element col-6">
                            <label for="stdId" class="form-label">
                                Student ID:
                            </label>
                            <input
                                type="text"
                                name="stdId"
                                id="stdId"
                                class="form-control"
                                placeholder="Std ID"
                                readonly
                            />
                            <small class="text-danger m-0 p-0 error-id"></small>
                        </div>
                        <div class="form-element col-6 mx-1">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{old('name')}}"
                                class="form-control"
                                placeholder="Student Name"
                                readonly
                            />
                            <small class="text-danger m-0 p-0 error">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-element mt-1 col-12">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{old('email')}}"
                            class="form-control"
                            placeholder="Enter Your Email"
                            readonly
                        />
                        <small class="text-danger m-0 p-0 error">
                                @error('email')
                                    {{$message}}
                                @enderror
                        </small>
                    </div>
                    <div class="col-12 d-flex mt-1">
                        <div class="form-element @if (old('class1')!="other")
                            {{"col-12"}}
                            @else
                            {{"col-6"}}
                        @endif">
                            <label for="class1" class="form-label">Class</label>
                            <select
                                name="class1"
                                id="class1"
                                class="form-control select-box"
                                disabled
                            >
                                <option value="" disabled selected>Select Your Class</option>
                                <option value="F.Y.B.B.A.(C.A.)"
                                @if (old('class1')=="F.Y.B.B.A.(C.A.)")
                                    {{"selected"}}
                                @endif>
                                    F.Y.B.B.A.(C.A.)
                                </option>
                                <option value="S.Y.B.B.A.(C.A.)"
                                @if (old('class1')=="S.Y.B.B.A.(C.A.)")
                                    {{"selected"}}
                                @endif>
                                    S.Y.B.B.A.(C.A.)
                                </option>
                                <option value="T.Y.B.B.A.(C.A.)"
                                @if (old('class1')=="T.Y.B.B.A.(C.A.)")
                                    {{"selected"}}
                                @endif>
                                    T.Y.B.B.A.(C.A.)
                                </option>
                                <option value="F.Y.B.Com"
                                @if (old('class1')=="F.Y.B.Com")
                                    {{"selected"}}
                                @endif>
                                F.Y.B.Com
                                </option>
                                <option value="S.Y.B.Com"
                                @if (old('class1')=="S.Y.B.Com")
                                    {{"selected"}}
                                @endif>
                                S.Y.B.Com
                                </option>
                                <option value="T.Y.B.Com"
                                @if (old('class1')=="T.Y.B.Com")
                                    {{"selected"}}
                                @endif>
                                T.Y.B.Com
                                </option>
                                <option value="other"
                                @if (old('class1')=="other")
                                    {{"selected"}}
                                @endif>
                                Other
                                </option>
                            </select>
                        </div>
                        <div class="form-element mx-1 col-6 @if (old('class1')!="other"){{"d-none"}}@endif">
                            <label for="class2" class="form-label">Class</label>
                            <input
                                type="text"
                                name="class2"
                                id="class2"
                                value="@empty(!old('class2')){{ old('class2') }}@endempty"
                                class="form-control"
                                placeholder="Enter Class Name.."
                                readonly
                            />
                        </div>
                    </div>
                    <div class="form-element mt-1">
                        <label for="age" class="form-label">Age</label>
                        <input
                            type="number"
                            name="age"
                            id="age"
                            value="{{old('age')}}"
                            class="form-control"
                            placeholder="Enter your age"
                            readonly
                        />
                        <small class="text-danger error">
                                @error('age')
                                    {{$message}}
                                @enderror
                        </small>
                    </div>
                    <div class="form-element mt-4 col-12">
                        <input
                            type="submit"
                            value="Submit"
                            class="btn btn-primary col-2 mx-3"
                            id="submit-btn"
                            itemid="submit"
                            disabled
                        />
                        <input
                            type="reset"
                            value="Cancel"
                            class="btn btn-danger col-2 mx-3"
                            id="cancel-btn"
                        />
                        <button class="btn btn-success col-2 mx-3" id="newEntry">
                            New
                        </button>
                        <button class="btn btn-warning text-light col-2 mx-3" id="delete-btn">
                            Delete
                        </button>
                        <button class="btn btn-info text-light col-2 mx-2" id="edit-btn">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="container bg-light position-fixed top-0 rounded shadow-lg user-select-none w-100 d-none" id="table-container" style="height: 97%;margin-inline:8.3%;">
            <div class="d-flex">
                <h2 class="heading mx-3 w-50 mt-4 text-primary">Student's Information</h2>
                <div class="w-75 mx-2 mt-4">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search by student name..">
                </div>
                <div class="mx-2 mt-4 d-flex h-25">
                   <span class="btn btn-success">Setting</span>
                    <span class="btn btn-info mx-1">Help</span>
                </div>
                <div>
                    <img src="{{asset('icons/close.png')}}" id="close-img" style="height: .7rem;width:.7rem;cursor: pointer;">
                </div>
            </div>
            <div class="my-3 px-3 mx-auto overflow-scroll w-100 h-75" style="scrollbar-width:none;">
                <table class="table table-bordered table-striped w-100" id="tableData">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Age</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td class="searchKey">{{$student->std_name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->std_class}}</td>
                            <td>{{$student->age}}</td>
                        </tr>
                    @endforeach
                    <tr class="text-center">
                        <td colspan="5">...</td>
                    </tr>
                </table>
            </div>
            <div class="container my-2 text-center">
                <button class="btn btn-danger w-25" id="select-button" disabled>Select</button>
            </div>
        </div>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
