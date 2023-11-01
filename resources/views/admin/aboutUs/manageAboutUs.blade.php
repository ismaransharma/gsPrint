@extends('admin.dashboard')
@section('adminTemplate')

<section id="manageAboutUs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Manage About Us</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Orginal Cost</th>
                                    <th>Discounted Cost</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection