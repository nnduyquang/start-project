<div id="be-menu">
    <div class="dd" id="nestable">
        <ol class="dd-list">
            <li class="dd-item" data-id="1">
                <div class="float-right item_actions">
                    <div class="btn btn-sm btn-danger float-right delete" data-id="1">
                        <i class="voyager-trash"></i> Delete
                    </div>
                    <div class="btn btn-sm btn-primary float-right edit" data-id="1" data-title="Dashboard" data-url="" data-target="_self" data-icon_class="voyager-boat" data-color="" data-route="voyager.dashboard" data-parameters="null">
                        <i class="voyager-edit"></i> Edit
                    </div>
                </div>
                <div class="dd-handle">
                    <span>Dashboard</span> <small class="url">/admin</small>
                </div>
            </li>
            <li class="dd-item" data-id="2">
                <div class="dd-handle">Item 2</div>
                <ol class="dd-list">
                    <li class="dd-item" data-id="3">
                        <div class="dd-handle">Item 3</div>
                    </li>
                    <li class="dd-item" data-id="4">
                        <div class="dd-handle">Item 4</div>
                    </li>
                    <li class="dd-item" data-id="5">
                        <div class="dd-handle">Item 5</div>
                        <ol class="dd-list">
                            <li class="dd-item" data-id="6">
                                <div class="dd-handle">Item 6</div>
                            </li>
                            <li class="dd-item" data-id="7">
                                <div class="dd-handle">Item 7</div>
                            </li>
                            <li class="dd-item" data-id="8">
                                <div class="dd-handle">Item 8</div>
                            </li>
                        </ol>
                    </li>
                    <li class="dd-item" data-id="9">
                        <div class="dd-handle">Item 9</div>
                    </li>
                    <li class="dd-item" data-id="10">
                        <div class="dd-handle">Item 10</div>
                    </li>
                </ol>
            </li>
            <li class="dd-item" data-id="11">
                <div class="dd-handle">Item 11</div>
            </li>
            <li class="dd-item" data-id="12">
                <div class="dd-handle">Item 12</div>
            </li>
        </ol>
    </div>
</div>
@include('backend.admin.menu.modal.delete-menu')
@include('backend.admin.menu.modal.edit-add-menu')

