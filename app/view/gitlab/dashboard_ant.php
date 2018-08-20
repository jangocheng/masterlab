<!DOCTYPE html>
<html class="" lang="en">
<head  >

    <? require_once VIEW_PATH.'gitlab/common/header/include.php';?>
    <!--<link href="//fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet" type="text/css"/>-->
    <link href="<?=ROOT_URL?>dev/lib/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?=ROOT_URL?>dev/css/dashboard.css" rel="stylesheet" type="text/css"/>
</head>

<body class="dashboard" data-group="" data-page="projects:issues:index" data-project="xphp">
<? require_once VIEW_PATH.'gitlab/common/body/script.php';?>
<header class="navbar navbar-gitlab with-horizontal-nav">
    <a class="sr-only gl-accessibility" href="#content-body" tabindex="1">Skip to content</a>
    <div class="container-fluid">
        <? require_once VIEW_PATH.'gitlab/common/body/header-content.php';?>
    </div>
</header>
<script>
    var findFileURL = "/ismond/xphp/find_file/master";
</script>
<div class="page-with-sidebar">
    <div class="content-wrapper page-with-layout-nav page-with-sub-nav">
        <div class="alert-wrapper">
            <div class="flash-container flash-container-page">
            </div>
        </div>

        <div class="content-header">
            <!--            <div class="breadcrumb">-->
            <!--                首页-->
            <!--            </div>-->

            <div class="user-profile">
                <div class="user-profile-content">
                    <div class="user-avatar">
                        <img src="<?= $user['avatar'] ?>" alt="">
                    </div>

                    <div class="user-profile-text">
                        <div class="text-title"><span id="current_time"></span><?= $user['display_name'] ?>，祝你开心每一天！</div>
                        <div class="text-content">技术总监 | 某某公司－某某某事业群－某某平台部－某某技术部－UED</div>
                    </div>
                </div>

                <ul class="user-profile-extra">
                    <li class="extra-item">
                        <p class="extra-item-title">项目数</p>
                        <p class="extra-item-num">12</p>
                    </li>

                    <li class="extra-item">
                        <p class="extra-item-title">事项数</p>
                        <p class="extra-item-num"> 80<span>/ 240</span></p>
                    </li>

                    <li class="extra-item">
                        <p class="extra-item-title">用户数</p>
                        <p class="extra-item-num">223</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content container-fluid" id="content-body">
            <div id="multi" class="container row">
                <div class="col-md-8 group_panel">
                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading tile__name" data-force="25" draggable="false" >
                            <h3 class="panel-heading-title">我参与的项目</h3>
                            <div class="panel-heading-extra"><a href="<?=ROOT_URL?>/projects">全部项目</a></div>
                        </div>
                        <div class="panel-body padding-0">
                            <ul class="panel-project" id="panel_join_projects">

                            </ul>

                            <script id="join_project_tpl" type="text/html" >
                                {{#projects}}
                                <li class="event-block project-item col-md-4">
                                    <div class="project-item-title">
                                        {{#if avatar_exist}}
                                        <span class="g-avatar g-avatar-md project-item-pic">
                                            <img src="{{avatar}}">
                                        </span>
                                        {{^}}
                                        <span class="g-avatar g-avatar-md project-item-pic pic-bg">
                                            {{first_word}}
                                        </span>
                                        {{/if}}

                                        <span class="project-item-name">
                                            <a href="<?=ROOT_URL?>/{{path}}/{{key}}">{{name}}</a>
                                        </span>
                                    </div>

                                    <div class="project-item-body">
                                        {{user_html default_assignee }}
                                    </div>

                                    <div class="project-item-footer">
                                        <span class="footer-text">{{type_name}}</span>

                                        <time class="footer-time js-timeago js-timeago-render" title=""
                                              datetime="{{create_time}}"
                                              data-toggle="tooltip"
                                              data-placement="top"
                                              data-container="body"
                                              data-original-title="{{create_time}}"
                                              data-tid="449">{{create_time}}</time>
                                    </div>
                                </li>
                                {{/projects}}
                            </script>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading tile__name " data-force="25" draggable="false" >
                            <h3 class="panel-heading-title">活动动态</h3>
                            <div class="panel-heading-extra hide" id="panel_activity_more"><a href="#">全部动态</a></div>
                        </div>

                        <div class="panel-body">
                            <ul class="event-list" id="panel_activity">
                            </ul>

                            <script id="activity_tpl" type="text/html" >
                                {{#activity}}
                                <li class="event-list-item">
                                    <div class="g-avatar g-avatar-lg event-list-item-avatar">
                                         {{user_html user_id}}
                                    </div>

                                    <div class="event-list-item-content">
                                        <h4 class="event-list-item-title">
                                            <a class="username">{{user.display_name}}</a>
                                            <span class="event">在
                                                <a href="/user/profile/{{user_id}}">{{title}}</a> {{action}}
                                                <a href="/user/profile/{{user_id}}">{{type}}</a>
											</span>
                                        </h4>

                                        <time class="event-time js-timeago js-timeago-render" title=""
                                              datetime="{{time_full}}"
                                              data-toggle="tooltip"
                                              data-placement="top"
                                              data-container="body"
                                              data-original-title="{{time_full}}"
                                              data-tid="449">{{time_text}}</time>
                                    </div>
                                </li>
                                {{/activity}}
                            </script>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading tile__name " data-force="25" draggable="false" >
                            <h3 class="panel-heading-title">分配给我问题</h3>
                            <div class="panel-heading-extra hide" id="panel_issue_more"><a href="#">全部问题</a></div>
                        </div>

                        <div class="panel-body">
                            <ul class="event-list" id="panel_assignee_issues">
                            </ul>

                            <script id="assignee_issue_tpl" type="text/html" >
                                {{#issues}}
                                <li class="event-list-item">
                                    <div class="event-list-item-content">
                                        {{#if summary}}
                                        <h4 class="event-list-item-title">
                                            <a class="item-title">{{summary}}</a>
                                        </h4>
                                        {{/if}}

                                        <div class="event-item-info">
                                            <span class="info-item gray">#{{id}}</span>
                                            <span class="info-item">{{issue_type_html issue_type}}</span>
                                            <span>{{priority_html priority }}</span>
                                        </div>
                                    </div>
                                </li>
                                {{/issues}}
                            </script>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 group_panel">
                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading tile__name " data-force="25" draggable="false" >
                            <h3 class="panel-heading-title">快速开始 / 便捷导航</h3>
                        </div>

                        <div class="panel-body">
                            <div class="link-group">
                                <a href="#/">操作一</a>
                                <a href="#/">操作二</a>
                                <a href="#/">操作三</a>
                                <a href="#/">操作四</a>
                                <a href="#/">操作五</a>
                                <a href="#/">操作六</a>
                                <button type="button" class="btn btn-primary btn-sm btn-background-ghost">
                                    <i class="fa fa-plus"></i><span>添加</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading tile__name " data-force="25" draggable="false" >
                            <h3 class="panel-heading-title">XX指数</h3>
                        </div>

                        <div class="panel-body">
                            <div class="radar">
                                <div class="radar-chart">
                                    <canvas id="canvas"></canvas>
                                </div>

                                <div class="radar-num clearfix">
                                    <div class="col-md-4 radar-num-item">
                                        <p>
                                            <span class="item-dot" style="background-color: rgb(255, 61, 103);"></span>
                                            <span class="item-title">个人</span>
                                        </p>

                                        <p class="item-num">34</p>
                                    </div>

                                    <div class="col-md-4 radar-num-item">
                                        <p>
                                            <span class="item-dot" style="background-color: rgb(54, 162, 235);"></span>
                                            <span class="item-title">团队</span>
                                        </p>

                                        <p class="item-num">22</p>
                                    </div>

                                    <div class="col-md-4 radar-num-item">
                                        <p>
                                            <span class="item-dot" style="background-color: rgb(255, 194, 51);"></span>
                                            <span class="item-title">部门</span>
                                        </p>

                                        <p class="item-num">23</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading tile__name " data-force="25" draggable="false" >
                            <h3 class="panel-heading-title">团队</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="member-list clearfix">
                                <li class="col-md-6 member-list-item">
                                    <a href="#/">
											<span class="g-avatar g-avatar-sm member-avatar">
												<img src="https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png">
											</span>
                                        <span class="member-name">科学搬砖组</span>
                                    </a>
                                </li>

                                <li class="col-md-6 member-list-item">
                                    <a href="#/">
											<span class="g-avatar g-avatar-sm member-avatar">
												<img src="https://gw.alipayobjects.com/zos/rmsportal/cnrhVkzwxjPwAaCfPbdc.png">
											</span>
                                        <span class="member-name">程序员日常</span>
                                    </a>
                                </li>

                                <li class="col-md-6 member-list-item">
                                    <a href="#/">
											<span class="g-avatar g-avatar-sm member-avatar">
												<img src="https://gw.alipayobjects.com/zos/rmsportal/gaOngJwsRYRaVAuXXcmB.png">
											</span>
                                        <span class="member-name">设计天团</span>
                                    </a>
                                </li>

                                <li class="col-md-6 member-list-item">
                                    <a href="#/">
											<span class="g-avatar g-avatar-sm member-avatar">
												<img src="https://gw.alipayobjects.com/zos/rmsportal/ubnKSIfAJTxIgXOKlciN.png">
											</span>
                                        <span class="member-name">中二少女团</span>
                                    </a>
                                </li>

                                <li class="col-md-6 member-list-item">
                                    <a href="#/">
											<span class="g-avatar g-avatar-sm member-avatar">
												<img src="https://gw.alipayobjects.com/zos/rmsportal/WhxKECPNujWoWEFNdnJE.png">
											</span>
                                        <span class="member-name">骗你学计算机</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=ROOT_URL?>dev/lib/handlebars-v4.0.10.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=ROOT_URL?>dev/js/handlebars.helper.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=ROOT_URL?>dev/js/panel.js" type="text/javascript" charset="utf-8"></script>
<script src="<?= ROOT_URL ?>dev/lib/sortable/Sortable.js"></script>
<script src="<?= ROOT_URL ?>dev/lib/chart.js/Chart.bundle.js"></script>
<script src="<?= ROOT_URL ?>dev/lib/chart.js/samples/utils.js"></script>

<script type="text/javascript">

    var _issueConfig = {
        priority:<?=json_encode($priority)?>,
        issue_types:<?=json_encode($issue_types)?>,
        issue_status:<?=json_encode($issue_status)?>,
        issue_resolve:<?=json_encode($issue_resolve)?>,
        issue_module:<?=json_encode($project_modules)?>,
        issue_version:<?=json_encode($project_versions)?>,
        issue_labels:<?=json_encode($project_labels)?>,
        users:<?=json_encode($users)?>,
        projects:<?=json_encode($projects)?>
    };

    var $panel = null;
    var _cur_page = 1;
    $(function() {
        var options = {
        }
        window.$panel = new Panel( options );
        window.$panel.fetchPanelAssigneeIssues( 1 );
        window.$panel.fetchPanelActivity( _cur_page );
        window.$panel.fetchPanelJoinProjects();
    });

    (function () {
        'use strict';
        getCurrentTime();

        var byId = function (id) { return document.getElementById(id); },
            loadScripts = function (desc, callback) {
                var deps = [], key, idx = 0;

                for (key in desc) {
                    deps.push(key);
                }

                (function _next() {
                    var pid,
                        name = deps[idx],
                        script = document.createElement('script');

                    script.type = 'text/javascript';
                    script.src = desc[deps[idx]];

                    pid = setInterval(function () {
                        if (window[name]) {
                            clearTimeout(pid);

                            deps[idx++] = window[name];

                            if (deps[idx]) {
                                _next();
                            } else {
                                callback.apply(null, deps);
                            }
                        }
                    }, 30);

                    document.getElementsByTagName('head')[0].appendChild(script);
                })()
            },
            console = window.console;

        if (!console.log) {
            console.log = function () {
                alert([].join.apply(arguments, ' '));
            };
        }
        // Multi groups
        [].forEach.call(byId('multi').getElementsByClassName('group_panel'), function (el){
            Sortable.create(el, {
                group: 'photo',
                animation: 150
            });
        });

        //判断当前时间
        function getCurrentTime() {
            var now = new Date(),
                hour = now.getHours(),
                dom = $("#current_time");

            if(hour < 6){dom.text("凌晨好！")}
            else if (hour < 9){dom.text("早上好！")}
            else if (hour < 12){dom.text("上午好！")}
            else if (hour < 14){dom.text("中午好！")}
            else if (hour < 17){dom.text("下午好！")}
            else if (hour < 19){dom.text("傍晚好！")}
            else if (hour < 22){dom.text("晚上好！")}
            else {dom.text("夜里好！")}
        }

        var color = Chart.helpers.color;
        var radar = document.getElementById('canvas').getContext('2d');
        var config = {
            type: 'radar',
            data: {
                labels: ['引用', '口碑', '产量', '贡献', '热度'],
                datasets: [{
                    label: '个人',
                    borderWidth: '1px',
                    backgroundColor: color(window.chartColors.red).alpha(0).rgbString(),
                    borderColor: window.chartColors.red,
                    pointBackgroundColor: color(window.chartColors.red).alpha(1).rgbString(),
                    data: [7, 1, 7, 7, 1]
                }, {
                    label: '团队',
                    borderWidth: '1px',
                    backgroundColor: color(window.chartColors.blue).alpha(0).rgbString(),
                    borderColor: window.chartColors.blue,
                    pointBackgroundColor: color(window.chartColors.blue).alpha(1).rgbString(),
                    data: [1, 7, 7, 2, 1]
                }, {
                    label: '部门',
                    borderWidth: '1px',
                    backgroundColor: color(window.chartColors.yellow).alpha(0).rgbString(),
                    borderColor: window.chartColors.yellow,
                    pointBackgroundColor: color(window.chartColors.yellow).alpha(1).rgbString(),
                    data: [10, 7, 1, 10, 7]
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                title: {
                    display: false
                },
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                },
                tooltips: {
                    mode: 'index',
                    titleMarginBottom: 12,
                    backgroundColor: 'rgba(255, 255, 255, 1)',
                    titleFontColor: '#333',
                    bodyFontColor: "#666",
                    bodySpacing: 10,
                    borderWidth: 1,
                    borderColor: '#e8e8e8',
                    xPadding: 15,
                    yPadding: 10
                }
            }
        };

        var myRadar = new Chart(radar, config);

    })();


</script>
</body>
</html>