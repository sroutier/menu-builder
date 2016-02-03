@extends('menu-builder::layouts-master')


@section('content')
    <div class="container menu-builder-showcase" role="main">

        <div class="jumbotron">
            <h1>Menu-Buidler demo</h1>
            <p>This page demos the menu and bread crumb trail rendered in a few different ways.</p>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bread crumb trail demo default</h3>
                    </div>
                    <div class="panel-body">
                        <pre>MenuBuilder::renderBreadcrumbTrail(null, 'root', false);</pre>
                        <pre>MenuBuilder::renderBreadcrumbTrail();</pre>
                        <ul>
                            <li>Leaf node automatically detected based on URL (Default).</li>
                            <li>Top node set to 'root' (Default).</li>
                            <li>Include top node set to false, to prevent rendering (Default).</li>
                            <li>Menu handler unset, reverts to configured option.</li>
                        </ul>
                        {!! MenuBuilder::renderBreadcrumbTrail()  !!}
                    </div>
                </div>
            </div><!-- /.col-sm-12 -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bread crumb trail demo rendering root node</h3>
                    </div>
                    <div class="panel-body">
                        <pre>MenuBuilder::renderBreadcrumbTrail(null, 'root', true)</pre>
                        <ul>
                            <li>Leaf node automatically detected based on URL.</li>
                            <li>Top node set to 'root'.</li>
                            <li>Include top node set to true.</li>
                            <li>Menu handler unset, reverts to configured option.</li>
                        </ul>
                        {!! MenuBuilder::renderBreadcrumbTrail(null, 'root', true)  !!}
                    </div>
                </div>
            </div><!-- /.col-sm-12 -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Menu demo default</h3>
                    </div>
                    <div class="panel-body">
                        <pre>MenuBuilder::renderMenu('root', false)</pre>
                        <pre>MenuBuilder::renderMenu()</pre>
                        <ul>
                            <li>Top node set to 'root' (Default).</li>
                            <li>Include top node set to false (Default).</li>
                            <li>Menu handler unset, reverts to configured option.</li>
                        </ul>
                        {!! MenuBuilder::renderMenu()  !!}
                    </div>
                </div>
            </div><!-- /.col-sm-12 -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Menu demo dark</h3>
                    </div>
                    <div class="panel-body">
                        <pre>MenuBuilder::renderMenu('root', false, 'BootstrapDarkMenuHandler')</pre>
                        <ul>
                            <li>Top node set to 'root' (Default).</li>
                            <li>Include top node set to false (Default).</li>
                            <li>Menu handler set to dark.</li>
                        </ul>
                        {!! MenuBuilder::renderMenu('root', false, 'Sroutier\MenuBuilder\Handlers\BootstrapDarkMenuHandler')  !!}
                    </div>
                </div>
            </div><!-- /.col-sm-12 -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Menu demo light admin only</h3>
                    </div>
                    <div class="panel-body">
                        <pre>MenuBuilder::renderMenu('admin', false)</pre>
                        <ul>
                            <li>Top node set to 'admin'.</li>
                            <li>Include top node set to false (Default).</li>
                            <li>Menu handler set to light.</li>
                        </ul>
                        {!! MenuBuilder::renderMenu('admin', false, 'Sroutier\MenuBuilder\Handlers\BootstrapLightMenuHandler')  !!}
                    </div>
                </div>
            </div><!-- /.col-sm-12 -->
        </div>


    </div> <!-- /container -->
@endsection

