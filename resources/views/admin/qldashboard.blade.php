<x-admin-layout>
    <style>
        @import url("https://code.highcharts.com/css/highcharts.css");
        @import url("https://code.highcharts.com/dashboards/css/datagrid.css");
        @import url("https://code.highcharts.com/dashboards/css/dashboards.css");

        h2,
        h3 {
            text-align: center;
        }

        #csv {
            display: none;
        }

        /* LARGE */
        @media (max-width: 1200px) {
            #top-left,
            #top-right {
                flex: 1 1 50%;
            }
        }

        /* MEDIUM */
        @media (max-width: 992px) {
            #top-left,
            #top-right {
                flex: 1 1 50%;
            }
        }

        /* SMALL */
        @media (max-width: 576px) {
            #top-left,
            #top-right {
                flex: 1 1 100%;
            }
        }

        .info-box {
            display: block;
            min-height: 90px;
            border:1px solid #F0F0F0;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
            margin-bottom: 15px;
        }



        .info-box-icon {
            border-top-left-radius: 2px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 2px;
            display: block;
            float: left;
            height: 90px;
            width: 90px;
            text-align: center;
            font-size: 45px;
            line-height: 90px;
            background: rgba(0, 0, 0, 0.1);
        }
        .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
            background-color: #00c0ef !important;
        }
        div {
            display: block;
            unicode-bidi: isolate;
        }
        .info-box-content {
            padding: 5px 10px;
            margin-left: 90px;
        }

        .progress-description, .info-box-text {
            display: block;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .info-box-number {
            display: block;
            font-weight: bold;
            font-size: 18px;
        }
        .bg-red, .callout.callout-danger, .alert-danger, .alert-error, .label-danger, .modal-danger .modal-body {
            background-color: #dd4b39 !important;
        
        }
        .bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
            background-color: #00a65a !important;
        }

        .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
            background-color: #f39c12 !important;
        }
        #csv-pie
        {
            display:none;
        }
        .a{
            text-decoration: none;
            color:black;
        }
        .a :hover{
            color:black;
            text-decoration: none;
            }
    </style>
        
    <div class="row" style="">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                
                <span class="info-box-icon bg-red"><i class="	fa fa-shopping-bag"></i></span>
                <div class="info-box-content">
                    
                        <span class="info-box-text"><h6><b>Đơn hàng</b></h6></span>
                        <span class="info-box-number">{{ $order_count}}</span>
                    
                </div>
            </div>
        </div>

        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                
                <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><h6><b>Khách hàng</b></h6></span>
                    <span class="info-box-number">{{ $user_count}}</span>
                </div>
               
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><h6><b>Sản phẩm</b></h6></span>
                    <span class="info-box-number">{{ $product_count}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                
                    <span class="info-box-icon bg-yellow"><i class="fa fa-list"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><h6><b>Tổng doanh thu</b></h6></span>
                        <span class="info-box-number">{{ number_format($revenue, 0, ',', '.') }}.000đ</span>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/dashboards/dashboards.js"></script>
    <script src="https://code.highcharts.com/dashboards/modules/layout.js"></script>

  
    

    <div id="container"></div>

    <pre id="csv">Sản phẩm, Số lượng
    @foreach($static as $row)
        {{$row->name}},{{$row->total_quantity}}
    @endforeach
   
    </pre>

    <div id="container-pie"></div>
    <pre id="csv-pie">Khách hàng, Số lượng đơn hàng
    @foreach($static_1 as $row)
        {{$row->name}},{{$row->order_count}}
    @endforeach
    </pre>

        <script>
    Dashboards.board('container', {
        dataPool: {
            connectors: [{
                id: 'Product',
                type: 'CSV',
                options: {
                    csv: document.querySelector('#csv').innerHTML
                }
            }, {
                id: 'CustomerOrders',
                type: 'CSV',
                options: {
                    csv: document.querySelector('#csv-pie').innerHTML
                }
            }]
        },
        gui: {
            layouts: [{
                rows: [{
                    cells: [{
                        id: 'top-left'
                    }, {
                        id: 'top-right'
                    }]
                }]
            }]
        },
        components: [{
            renderTo: 'top-left',
            type: 'Highcharts',
            sync: {
                highlight: true
            },
            connector: {
                id: 'Product'
            },
            chartOptions: {
                chart: {
                    type: 'bar'
                },
                credits: {
                    enabled: false
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        colorByPoint: true
                    }
                },
                title: {
                    text: 'Thống kê sản phẩm đã bán'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        enabled: false
                    }
                }
            }
        }, {
            renderTo: 'top-right',
            type: 'Highcharts',
            sync: {
                highlight: true
            },
            connector: {
                id: 'CustomerOrders'
            },
            chartOptions: {
                chart: {
                    type: 'pie'
                },
                credits: {
                    enabled: false
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                title: {
                    text: 'Thống kê khách hàng đã đặt hàng'
                },
                series: [{
                    name: 'Số lượng đơn hàng',
                    colorByPoint: true,
                    data: [] // dữ liệu sẽ được điền tự động từ CSV
                }]
            }
        }]
    });
</script>

 

</x-admin-layout>

