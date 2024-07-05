@extends('admin.dashboard')
@section('adminTemplate')

<?php 
// dd($positions);
?>

<section id="manageCategory" class="mind">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Manage Position (1)</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addPositionModal">Add Position</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($positions as $position)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $position->member_position }}</td>
                                    <td>
                                        <button
                                            class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editPositionModal-{{ $position->id }}">Edit</button>
                                        <button
                                                class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletePositionModal-{{ $position->slug }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="manageCategory">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Manage Member (1)</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal">Add Members</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th class="pic">Photo</th>
                                <th>What's App</th>
                                <th>Facebook</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $member->member_name }}</td>
                                    <td>{{ $member->member_position_title }}</td>
                                    <td class="pic">
                                        <img height="65px" width="65px" src="{{ asset('uploads/members/'. $member->member_image) }}" alt="{{ asset('uploads/members/'. $member->member_image) }}">
                                    </td>
                                    <td>{{ $member->member_number }}</td>
                                    <td>{{ Str::limit($member->member_facebook ?? 'No Facebook Link', 15)}}..</td>

                                    <td><button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editMemberModal-{{ $member->slug }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMemberModal-{{ $member->slug }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

?>

<!-- Add Position Modal -->
<div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPositionModalLabel"><b>Add Member Position</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postAddPosition') }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Position:-*</label>
                                <input type="text" name="member_position"
                                    class="form-control @error('member_position') is-invalid @enderror"
                                    value="{{ old('member_position') }}" id="member_position"
                                    placeholder="Enter Position" required />
                                @error('member_position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn" id="save_product" onclick="product_added()">
                                <input type="submit" class="btn btn-primary" value="Add Member Position" />
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Position Modal -->
@foreach ($positions as $position)
<div class="modal fade" id="editPositionModal-{{ $position->id }}" tabindex="-1" aria-labelledby="editPositionModalLabel-{{ $position->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPositionModalLabel-{{ $position->id }}"><b>Edit Member Position</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postEditMemberPosition',$position->id) }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Position:-*</label>
                                <input type="text" name="member_position" class="form-control @error('member_position') is-invalid @enderror" value="{{ $position->member_position }}" id="member_position_{{ $position->id }}" placeholder="Enter Position" required />
                                @error('member_position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Position</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Delete Position Modal --}}
@foreach ($positions as $position)
<div class="modal fade" id="deletePositionModal-{{ $position->slug }}" tabindex="-1" aria-labelledby="deletePositionModal-{{ $position->slug }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg afaeaetgarsg">
        <div class="modal-content afaeaetgarsg">
            <section id="confirmation">
                <div class="container">
                    <div class="allCenter">
                    <div class="box">
                        <div class="cross end">
                        <button class="fa-solid fa-xmark closeCross" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="upper center">
                        <div class="mainCross">X</div>
                        <h2>Are You Sure?</h2>
                        </div>
                        <div class="text center">
                        <h6>
                            Do you really want to delete <b>{{ $position->member_position }}</b>? This process cannot
                            be undone.
                        </h6>
                        </div>
                        <div class="buttons center">
                        <button class="btn cancel" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a href="{{ route('getDeleteMemberPosition', $position->slug) }}">
                            <button class="btn delete">Delete</button>
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endforeach



<!-- Add Members Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addMemberModalLabel"><b>Add Member Position</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postAddMember') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Name:-*</label>
                                <input type="text" name="member_name"
                                    class="form-control @error('member_name') is-invalid @enderror"
                                    value="{{ old('member_name') }}" id="member_name"
                                    placeholder="Enter Member Name" required />
                                @error('member_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="member_position">Position*</label>
                                <select name="member_position_id" id="member_position" class="form-control" required>
                                    <option value="">-----------Choose Position-----------</option>
                                    @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->member_position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">Member Image* (Image Cannot be replaced)</label>
                                <input type="file" class="form-control @error('member_image') is-invalid @enderror"
                                    value="{{ old('member_image') }}" id="member_image" name="member_image"
                                    required />
                                @error('member_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">What's App*</label>
                                <input type="number" class="form-control @error('member_number') is-invalid @enderror"
                                    value="{{ old('member_number') }}" id="member_number" name="member_number" 
                                    required />
                                @error('member_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Facebook Link*</label>
                                <input type="text" class="form-control @error('member_facebook') is-invalid @enderror"
                                    value="{{ old('member_facebook') }}" id="member_facebook" name="member_facebook"
                                    required />
                                @error('member_facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">E-mail*</label>
                                <input type="text" class="form-control @error('member_email') is-invalid @enderror"
                                    value="{{ old('member_email') }}" id="member_email" name="member_email"
                                    required />
                                @error('member_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>







                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn" id="save_product" onclick="product_added()">
                                <input type="submit" class="btn btn-primary" value="Add Member Position" />
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Position Modal -->
@foreach ($members as $member)
<div class="modal fade" id="editMemberModal-{{ $member->slug }}" tabindex="-1" aria-labelledby="editMemberModalLabel-{{ $member->slug }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPositionModalLabel-{{ $position->id }}"><b>Edit Member Position</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postEditMember',$member->slug) }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Member Name:-</label>
                                <input type="text" name="member_name" class="form-control @error('member_name') is-invalid @enderror" value="{{ $member->member_name }}" id="member_name{{ $member->id }}" placeholder="Enter Member Name" />
                                @error('member_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="member_position">Position</label>
                                <select name="member_position_id" id="member_position" class="form-control">
                                    <option value="">-----------Choose Position-----------</option>
                                    @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" <?php if($member->member_position_id == $position->id){echo 'selected'; } ?>>
                                        {{ $position->member_position }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="">What's App:-</label>
                                <input type="text" name="member_number" class="form-control @error('member_number') is-invalid @enderror" value="{{ $member->member_number }}" id="member_number{{ $member->id }}" placeholder="Enter Member what's app Number" />
                                @error('member_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="">Facebook Link:-</label>
                                <input type="text" name="member_facebook" class="form-control @error('member_facebook') is-invalid @enderror" value="{{ $member->member_facebook }}" id="member_facebook{{ $member->id }}" placeholder="Enter Member Facebook Link" />
                                @error('member_facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">E-mail*</label>
                                <input type="text" class="form-control @error('member_email') is-invalid @enderror"
                                    value="{{ $member->member_email }}" id="member_email" name="member_email"
                                    required />
                                @error('member_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Position</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


{{-- Delete Member Modal --}}
@foreach ($members as $member)
<div class="modal fade" id="deleteMemberModal-{{ $member->slug }}" tabindex="-1" aria-labelledby="deleteMemberModal-{{ $member->slug }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg afaeaetgarsg">
        <div class="modal-content afaeaetgarsg">
            <section id="confirmation">
                <div class="container">
                    <div class="allCenter">
                    <div class="box">
                        <div class="cross end">
                        <button class="fa-solid fa-xmark closeCross" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="upper center">
                        <div class="mainCross">X</div>
                        <h2>Are You Sure?</h2>
                        </div>
                        <div class="text center">
                        <h6>
                            Do you really want to delete <b>{{ $member->member_name }}</b>? This process cannot
                            be undone.
                        </h6>
                        </div>
                        <div class="buttons center">
                        <button class="btn cancel" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a href="{{ route('getDeleteMember', $member->slug) }}">
                            <button class="btn delete">Delete</button>
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endforeach



@endsection