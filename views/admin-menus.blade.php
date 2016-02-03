@extends('menu-builder::layouts-master')


@section('head_bottom')
    <!-- JSTree 3.2.1 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container menu-builder-showcase" role="main">

        <div class="jumbotron">
            <h1>{!! trans('menu-builder::menu-builder.menu-builder-admin-title') !!}</h1>
            <p>{!! trans('menu-builder::menu-builder.menu-builder-admin-description') !!}</p>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{!! trans('menu-builder::menu-builder.hierarchy') !!}</h3>
                    </div>
                    <div class="panel-body">
                        <div id="jstree_menu_div"></div>
                    </div>
                </div>
            </div><!-- /.col-sm-6 -->
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">{!! trans('menu-builder::menu-builder.details') !!}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                        <form action="/admin/menus" method="POST" id="form_save_menu", class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id" class="form-control">

                            <div class="form-group">
                                <label for="name" class="control-label">{!! trans('menu-builder::menu-builder.name') !!}</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="label" class="control-label">{!! trans('menu-builder::menu-builder.label') !!}</label>
                                <input type="text" name="label" id="label" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="parent_id" class="control-label">{!! trans('menu-builder::menu-builder.parent') !!}</label>
                                <select name="parent_id" id="parent_id" class="js-parents form-control">
                                    @foreach($parents as $parent)
                                        @if( 'Root' == $parent['label'] )
                                            <option value="{{ $parent['id'] }}" selected>{{ $parent['label'] }}</option>
                                        @else
                                            <option value="{{ $parent['id'] }}" >{{ $parent['label'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="position" class="control-label">{!! trans('menu-builder::menu-builder.position') !!}</label>
                                <input type="text" name="position" id="position" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="icon" class="control-label">{!! trans('menu-builder::menu-builder.icon') !!}</label>
                                <input type="text" name="icon" id="icon" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="hidden" name="separator" value="0">
                                    <input type="checkbox" name="separator" id="separator" value="1">
                                    <label for="separator" class="control-label">{!! trans('menu-builder::menu-builder.separator') !!}</label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="url" class="control-label">{!! trans('menu-builder::menu-builder.url') !!}</label>
                                <input type="text" name="url" id="url" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="hidden" name="enabled" value="0">
                                    <input type="checkbox" name="enabled" id="enabled" value="1">
                                    <label for="enabled" class="control-label">{!! trans('menu-builder::menu-builder.enabled') !!}</label>
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" id="btn-submit-save" class="btn btn-primary">{!! trans('menu-builder::menu-builder.save') !!}</button>
                                <a id="deleteAnchor" disabled  data-toggle="modal" data-target="#modal_dialog" title="Delete" class='btn btn-default'>{!! trans('menu-builder::menu-builder.delete') !!}</a>
                                <a id="resetFormAnchor" disabled onclick="resetForm($('#form_save_menu'))"  title="Clear" class='btn btn-default'>{!! trans('menu-builder::menu-builder.clear') !!}</a>
                            </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-sm-6 -->
        </div>

    </div> <!-- /container -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')

    <!-- JSTree 3.2.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <!-- Build and configure JSTree -->
    <script language="JavaScript">
        $('#jstree_menu_div').jstree({
            'core' : {
                'themes' : {
                    'name': 'default',
                    'responsive': true
                },
                'data' : {!! $menusJson !!}
            }
        }).bind("loaded.jstree", function (event, data) {
            // Once jsTree is loaded, send command to expend all nodes.
            $(this).jstree("open_all");
        });
    </script>

    <!-- Load menu details into edit form when user clicks on tree node. -->
    <script language="JavaScript">
        $('#jstree_menu_div').on("select_node.jstree", function (e, nodeSelected) {

            // Capture CSRF token from meta header.
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Build URLs based on selected menu and replace "{menuId}" with ID.
            var urlShowRoute = '{!! route("admin.menus.get-data") !!}'.replace('%7BmenuId%7D', nodeSelected.selected);
            var urlDeleteRoute = '{!! route("admin.menus.confirm-delete") !!}'.replace('%7BmenuId%7D', nodeSelected.selected);



            $.ajax({
                url: urlShowRoute,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: nodeSelected.selected
                },
                dataType: 'JSON',
                success: function (returnData) {

                    menuObject = returnData[0];
                    menuID              = menuObject.id;
                    menuName            = menuObject.name;
                    menuLabel           = menuObject.label;
                    menuPosition        = menuObject.position;
                    menuIcon            = menuObject.icon;
                    menuURL             = menuObject.url;
                    menuSeparator       = (1 == menuObject.separator);
                    menuEnabled         = (1 == menuObject.enabled);
                    menuParentID        = menuObject.parent_id;
                    menuRouteID         = menuObject.route_id;
                    menuPermissionID    = menuObject.permission_id;
                    menuParentName      = ( menuObject.parent )     ? menuObject.parent.name     : '';
                    menuRouteName       = ( menuObject.route )      ? menuObject.route.name      : '';
                    menuPermissionName  = ( menuObject.permission ) ? menuObject.permission.name : '';

                    $('#id').val(menuID);
                    $('#name').val(menuName);
                    $('#label').val(menuLabel);
                    $('#position').val(menuPosition);
                    $('#icon').val(menuIcon);
                    $('#separator').prop('checked', menuSeparator);
                    $('#url').val(menuURL);
                    $('#enabled').prop('checked', menuEnabled);

                    $(".js-parents").val(menuParentID).trigger("change");
                    $(".js-routes").val(menuRouteID).trigger("change");
                    $(".js-permissions").val(menuPermissionID).trigger("change");

                    enableAnchor($("#deleteAnchor"), urlDeleteRoute);
                    enableAnchor($("#resetFormAnchor"), null, "resetForm($('#form_save_menu'))");
                }
            });

        });
    </script>

    <script language="JavaScript">
        // Reset the form.
        function resetForm($form)
        {
            $form.trigger("reset");
            $('#id').val('');
            $(".js-parents").val('1').trigger("change"); // Reset to root
            disableAnchor($("#deleteAnchor"));
            disableAnchor($("#resetFormAnchor"));
            return false;
        }

        // Disable anchor tag
        function disableAnchor($anchor)
        {
            // Disable and remove href.
            $anchor.removeAttr("href").attr('disabled', 'disabled');
        }

        function enableAnchor($anchor, $href, $onclick) {
            $anchor.removeAttr("disabled");
            if ($href) {
                $anchor.attr("href", $href);
            }
            if ($onclick) {
                $anchor.attr("onclick", $onclick);
            }
        }


        // Set elements to startup state and value on page load.
        $(document).ready(function(){
//                disableAnchor($("#deleteAnchor"));
//                disableAnchor($("#resetFormAnchor"));
        });
    </script>
@endsection
