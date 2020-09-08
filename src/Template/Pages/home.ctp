
<?php use Cake\Routing\Router; ?>
<?php echo $this->Html->script('AdminLTE./plugins/jQuery/jquery-2.2.3.min'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/chartjs/Chart.min'); ?>

<head>
<title>SPA Dashboard</title>
</head>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->



        <div style="padding:15px;min-height: 950px">

          

  <div>
    <div class="col-md-6">
      <div class="box">
      	<div class="box-header with-border">
          <h3 class="box-title">Authorised Functions</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" id='box'>
          <div class="col-xs-12 table-responsive">
              <table class="display compact table-striped" id="authTable" width=100%>
                  <thead>
                      <tr style="height:50px">
                          <th>Function</th>
                          <th>Description</th>
                          <th>Enabled</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                      
                      $totalAuths = [];




                      foreach ($user->user_sub_authorizations as $auth):                                                            
                              $subAuths = [];
                              if(!in_array($auth->sub_authorization->authorization->id, $totalAuths)):
                                  $totalAuths[] = $auth->sub_authorization->authorization->id;
                                  foreach ($user->user_sub_authorizations as $tempAuth){
                                      if($tempAuth->sub_authorization->authorization->id == $auth->sub_authorization->authorization->id){
                                          $subAuths[] = (object)['description' => $tempAuth->sub_authorization->description, 'justification' => $tempAuth->justification, 'date' => date_format($tempAuth->date, "d/m/Y")];

                                      }
                                  }


                              
                              ?>
                          <tr subAuths='<?php echo json_encode($subAuths); ?>' authId='<?php echo $auth->id; ?>' data-container="body" data-toggle="tooltip" data-html="true" title="
                            <strong><?= $auth->sub_authorization->authorization->description ?></strong>
                            <div style='left:0px;text-align:left'>
                              <ul>
                                <?php foreach($subAuths as $subAuth): ?>
                                <li style='text-align:left'><?php echo $subAuth->description ?></li>
                                <?php endforeach; ?>
                            </ul
                          </div>">
                              <td><?= $auth->sub_authorization->authorization->function_number ?></td>
                              <td> <?= $auth->sub_authorization->authorization->description ?></td>
                              <td><span class='fa fa-check'></span></td>
                          </tr>
                          <?php endif; 
                      endforeach;
                      foreach($auths as $listAuth):
                          if(!in_array($listAuth->id, $totalAuths)): ?>
                          <tr subAuths=''>
                              <td><?= $listAuth->function_number ?></td>
                              <td> <?= $listAuth->description ?></td>
                              <td></td>
                          </tr>
                          <?php endif; ?>
                      <?php endforeach; ?>
                           
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div>
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Your Unclosed Jobs Value</h3>
        </div>
        <div class="box-body" id='box'>
          <div class="col-xs-12 table-responsive">
              <table class="display compact table-striped" id="unclosedValue" width=100%>
                  <thead>
                      <tr style="height:50px">
                          <th>Job</th>
                          <th>Customer</th>
                          <th><span class='pull-right'>Labour</span></th>
                          <th><span class='pull-right'>Parts</span></th>
                          <th><span class='pull-right'>Est Total</span></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach($unclosedValues as $value): ?>
                          <tr>

                              <td><?= $this->Html->link(__($value['Job']), ['controller'=>'invoices', 'action' => 'view/', $value['Job']]) ?> </td>
                              <td> <?= $value['Customer'] ?></td>
                              <td><span class='pull-right'>$<?php echo number_format((float)$value['labour'], 2, '.', '')?></span></td>
                              <td><span class='pull-right'>$<?php echo number_format((float)$value['parts'], 2, '.', '')?></span></td>
                              <td><span class='pull-right'>$<?php echo number_format((float)$value['total'], 2, '.', '')?></span></td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
                            
          
            <!--table>
              <tr>
                <th>Authrorization</th>
                <th>Enabled</th>
              </tr>
              <?php foreach($auths as $auth): ?>
              <tr>
                <td><?php echo $auth->description; ?></td>
                <td><span class='fa fa-check'></span></td>
              </tr>
              <?php endforeach; ?>
          </table-->

   <div>
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Unclosed Jobs</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center">
                <strong id="period"></strong>
              </p>

              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="unclosedChart" style="height: 300px;"></canvas>
              </div>
              <!-- /.chart-responsive -->
            </div>
          </div>
          <!-- /.row -->
        </div>

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>




<script>

/*$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})*/

$(document).ready(function() {
  var dataTable = $('#unclosedValue').DataTable({
        "order": [[ 4, 'desc' ]],
        "columnDefs": [
        { "orderable": false, "targets": [1, 2] }
        ],
        "autoWidth": true,
        "bInfo": false
    });

  var dataTable = $('#authTable').DataTable({
        "order": [[ 0, 'asc' ]],
        "columnDefs": [
        { "orderable": false, "targets": [0, 1, 2] }
        ],
        "autoWidth": true,
        "searching": false,
        "paging": false,
        "bInfo": false
    });

  

  $('#authTable tbody>tr').hover(function(){
    //alert('hovered over row');

    var tr = $(this).closest('tr');
    var row = dataTable.row(tr);
    if($(tr).attr('subAuths')!=''){

      $(tr).tooltip();

    }


    //var popup = $('<div></div>');
    
    //$(popup).css('color', 'red', 'width', '100px', 'height', '100px');
    //$('#box').append(popup);

  })

} );

var csrfToken = $('[name=_csrfToken]').val();

  //-----------------------
  //- INVOICES UNCLOSED CHART -
  //-----------------------
 $.ajax({
    type:'GET',
    url: '<?php echo Router::url(array("controller" => "Invoices", "action" => "getLastSixMonths")); ?>',
    headers: {
      accept: 'application/json'
    },
    beforeSend: function(xhr){
      xhr.setRequestHeader('X-CSRF-Token', csrfToken);
   },
    success: function(data){
      data = JSON.parse(data);
      //console.log(data);
      dates = [];
      globalUnclosed = [];
      personalUnclosed = [];
      $.each(data, function(index, value){
        dates.push(value.Month+'/'+value.Year);
        globalUnclosed.push(value.Global);
        personalUnclosed.push(value.Personal);
      });
      $('#period').text('Period: '+dates[0]+' - '+dates[dates.length - 1])
      console.log(dates);
      console.log(globalUnclosed);
      console.log(personalUnclosed);

  // Get context with jQuery - using jQuery's .get() method.
  var invoiceChartCanvas = $("#unclosedChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var invoiceChart = new Chart(invoiceChartCanvas);

  var invoiceChartData = {
    labels: dates,
    datasets: [
      {
        label: "Total Unclosed",
        fillColor: "rgb(210, 214, 222)",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: globalUnclosed
      },
      {
        label: "Your Unclosed",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: personalUnclosed
      }
    ]
  };

  var invoiceChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: true,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 2,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  invoiceChart.Line(invoiceChartData, invoiceChartOptions);

    }
 });
  //---------------------------
  //- INVOICES UNCLOSED CHART 
  //---------------------------
  
</script>

<?php
$this->Html->css([
    'AdminLTE./plugins/datepicker/datepicker3',
    'AdminLTE./plugins/select2/select2.min',
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/select2/select2.full.min',
  'AdminLTE./plugins/input-mask/jquery.inputmask',
  'AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions',
  'AdminLTE./plugins/datepicker/bootstrap-datepicker',
  'AdminLTE./plugins/datatables/jquery.dataTables.min',
  'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>

<?php $this->end(); ?>