@extends('admin.layout.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <x-admin.pageheader page_heading="Role Management" record_create_heading="Create Role" />
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <x-admin.datatable :head="['id', 'name', 'permissions']" />
                    </div>
                </div>
            </div>
        </div>
        @include($path . '.edit')
        @include($path . '.create')
        @include('admin.layout.partials.footer')
    </div>
@endsection

@section('js')
    <script>
        var table;
        var customAjax;
        $(document).ready(function() {
            customAjax = new CustomAjax();
            $('#submitForm').click(function() {
                var formData = $('#createForm').serialize();
                customAjax.post('{{ route('admin.roles.create') }}', formData, response => {
                    customAjax.Alert(response.msg, 'success');
                    $('#create').find('button[data-bs-dismiss="offcanvas"]').click();
                    redrawDataTable();
                }, xhr => customAjax.fieldsValidator("#createForm", xhr));

            });
            $('#EditForm').click(function() {
                var formData = $('#editForm').serialize();
                const edit_id = localStorage.getItem('edit_id');
                customAjax.put(`/admin/roles/${edit_id}`, formData, response => {
                    customAjax.Alert(response.msg, 'success');
                    $('#create').find('button[data-bs-dismiss="offcanvas"]').click();
                    redrawDataTable();
                }, xhr => customAjax.fieldsValidator("#editForm", xhr));

            });

            table = new customDataTable('#datatable', '/admin/roles/datatable');
            table.column([{
                    data: 'id',
                    orderable: true
                },
                {
                    data: 'name',
                    orderable: true
                },
                {
                    data: 'permissions',
                    orderable: false,
                    render: function(data, type, row) {
                        // Display the count of permissions
                        return Array.isArray(data) ? data.length : 0;
                    }
                }, {
                    "data": null,
                    orderable: false,
                    render: function(data, type, row) {

                        return `<td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" aria-controls="offcanvasEnd" onclick='editform(${JSON.stringify(row)})'>
                          Edit
                        </a>
                        <a class="dropdown-item" href="#" onclick="deleteRecord('/admin/roles/${row.id}', null)">Delete</a>
                      </div>
                    </span>
                  </td>`;
                    }
                },

            ]);
            table.draw();
        });
        function redrawDataTable() {
            table.draw();
        }
        function deleteRecord(route, contextref = null) {
            customAjax.delete_confirm_modal(route, redrawDataTable)
        }
        function editform(row) {
            customAjax.showeditform(row)

        }
    </script>
@endsection
