@extends('layouts.backend')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}
@endsection
@section('content')
    @can('tb_access')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('categories.create') }}">
                    Add Merchandise Category
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Merchandise Categories
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-category"
                        id="CategoryTable">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Merchandise Category Name
                                </th>
                                <th>Products Count</th>
                                @can('tb_access')
                                    <th>
                                        Actions
                                    </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr data-entry-id="{{ $category->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $category->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $category->title ?? '' }}
                                    </td>
                                    <td>
                                        {{ count(\DB::table('products')->where('category_id', $category->id)->get()) }}
                                    </td>

                                    @can('tb_access')
                                        <td>
                                            <a href="{{ route('categories.edit', [$category->id]) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('categories.destroyCategory', [$category->id]) }}"
                                                class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')">Delete</a>
                                        </td>
                                    @endcan

                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">No Merchandise Categories</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan
    @can('client_access')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('categories.create') }}">
                    Add Merchandise Category
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Merchandise Categories
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-category"
                        id="CategoryTable">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Merchandise Category Name
                                </th>
                                <th>
                                    Products Count
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categoriesClient as $key => $category)
                                <tr data-entry-id="{{ $category->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $category->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $category->title ?? '' }}
                                    </td>
                                    <td>
                                        {{ count(\DB::table('products')->where('category_id', $category->id)->get()) }}
                                    </td>


                                    <td>
                                        @can('client_access')
                                            <a href="{{ route('categories.edit', [$category->id]) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        @can('admin_access')
                                            <a href="{{ route('categories.destroyCategory', [$category->id]) }}"
                                                class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')">Delete</a>
                                        @endcan
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">No Merchandise Categories</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan
    @can('admin_access')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('categories.create') }}">
                    Add Merchandise Category
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Merchandise Categories
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-category"
                        id="CategoryTable">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Merchandise Category Name
                                </th>
                                <th>Products Count</th>
                                @can('tb_access')
                                    <th>
                                        Actions
                                    </th>
                                @endcan
                                @can('admin_access')
                                    <th>
                                        Actions
                                    </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr data-entry-id="{{ $category->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $category->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $category->title ?? '' }}
                                    </td>
                                    <td>
                                        {{ count(\DB::table('products')->where('category_id', $category->id)->cursor()) }}
                                    </td>

                                    @can('tb_access')
                                        <td>
                                            <a href="{{ route('categories.edit', [$category->id]) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    @endcan
                                    @can('admin_access')
                                        <td>
                                            <a href="{{ route('categories.edit', [$category->id]) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('categories.destroyCategory', [$category->id]) }}"
                                                class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')">Delete</a>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">No Merchandise Categories</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#CategoryTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excelHtml5',
                        title: 'MerchandiseTypes_list',
                        exportOptions: {
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, ':visible']
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'MerchandiseTypes_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
