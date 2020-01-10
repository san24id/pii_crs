
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Information of the Board of Directors
    </h3>
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="fa fa-home"></i>
          <a target="_self" href="<?=$site_url?>/main/mainrac">Home</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li class="bread_tab">
          <a id="bread_tab_title" target="_self" href="javascript:;">Information of the Board of Directors</a>
        </li>
      </ul>
      <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    Export <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a id = "risk_list_export">Export</a>
                        </li>                    
                    </ul>
                </div>
            </div>  
        </div>
        <!--export-->
        <input type = "hidden" id = "tabactive" name ="tabactive" value = "0">
        <!-- Modal -->
        <div class="modal fade" data-width="650" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document" >
            <div class="modal-content" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Risk List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_risklist">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status"></th>
                        <th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code" > </th>
                        <th>Risk Event <input type = "checkbox" checked="true"  name = "risk_event" > </th>
                        <th>Impact Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
                        <th>Likelihood <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
                        <th>Risk Level <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
                        <th>Risk Owner <input type = "checkbox" checked="true"  name = "risk_owner_v" > </th> 
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "risk_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "risk_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" data-width="650" id="#modal-export-risk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Risk Register List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_riskregisterlist">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
                        <th>User <input type = "checkbox" checked="true"  name = "display_name"  > </th>
                        <th>Divisi<input type = "checkbox" checked="true"  name = "division_name"  > </th>
                        <th>Submission Date<input type = "checkbox" checked="true"  name = "tanggal_submit"  > </th> 
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "risk_register_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "risk_register_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" data-width="650" id="modal-export-treatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Treatment List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_risktreatment">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
                        <th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code"  > </th>
                        <th>Risk Event<input type = "checkbox" checked="true"  name = "risk_event"  > </th> 
                        <th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner_v"  > </th> 
                        <th>Risk Treatment<input type = "checkbox" checked="true"  name = "suggested_risk_treatment_v"  > </th>  
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "treatment_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "treatment_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>
        
        
        <!-- Modal -->
        <div class="modal fade" data-width="650" id="modal-actionplanlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Action Plan List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_actionplan">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
                        <th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
                        <th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
                        <th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
                        <th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
                        <th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "actionplan_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "actionplan_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" data-width="650" id="modal-executionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Action Plan Execution List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_execution">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
                        <th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
                        <th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
                        <th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
                        <th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
                        <th>Execution<input type = "checkbox" checked="true"  name = "execution_status"  > </th> 
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "execution_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "execution_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" data-width="650" id="modal-kri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">KRI List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_kri">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "kri_status" ></th>
                        <th>KRI ID <input type = "checkbox" checked="true"  name = "kri_code"  > </th>
                        <th>KRI<input type = "checkbox" checked="true"  name = "key_risk_indicator"  > </th> 
                        <th>KRI Owner<input type = "checkbox" checked="true"  name = "treshold"  > </th> 
                        <th>Timing Pelaporan<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>  
                        <th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
                        <th>KRI Warning<input type = "checkbox" checked="true"  name = "kri_warning"  > </th> 
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "kri_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "kri_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>
        
    <!-- Modal -->
        <div class="modal fade" data-width="650" id="modal-changereq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="#modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Request List Export - choose field to export</h4>
              </div>
              <div class="modal-body">
                <form id = "get_check_changereq">
                    <tr role="row" class="heading">
                        <th width="30px">Status <input type = "checkbox" checked="true"  name = "GenRowNum" ></th>
                        <th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
                        <th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th> 
                        <th>Requestor<input type = "checkbox" checked="true"  name = "created_by_v"  > </th> 
                        <th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status"  > </th>                        
                    </tr>
                </form>                          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class = "btn btn-success" id = "changereq_list_excel">Export to Excel</button>
                <button class = "btn btn-success" id = "changereq_list_pdf" >Export to PDF</button>
              </div>
            </div>
          </div>
        </div>

    <div class="tabbable-custom ">
      <ul class="nav nav-tabs ">
        <li class="active">
          <a href="#tab_dashboard" data-toggle="tab">
          Main Dashboard </a>
        </li>
        <li>
          <a href="#tab_risk_list" data-toggle="tab">
          Risk List </a>
        </li>
        <li>
          <a href="#tab_action_plan_exec" data-toggle="tab">
          Action Plan Execution
          </a>
        </li>
        <li>
          <a href="#tab_kri_list" data-toggle="tab">
          KRI List 
          </a>
        </li>
        <li>
          <a href="#tab_risk_map" data-toggle="tab">
          Risk Map 
          </a>
        </li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tab_dashboard">
  <section class="content">
   <div class="row" style="padding-top: 0">
        <div class="col-md-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%;">
          <div class="info-box" style="border: 3px solid #fff;">
            <span class="info-box-icon bg-red" style="padding-left: 17px; padding-top:10px; min-height: 120px;"><center><img src="assets/images/Pariwisata.png" width="80" height="80"/></center></span>

            <div class="info-box-content bg-red">
              <table width="100%">
                  <tr>
                    
                    <td align="right" width="70%"> <img src="assets/images/up-xxl-w.png" width="40" height="50"/></td>
                        <td align="right" width="35%"><span style="font-weight: bold; font-size: 42px;"><?php echo $sumAllRisk; ?></span></td>
                    
                  </tr>
                  <tr><td align="right" colspan="2"><span style="font-weight: bold; font-size: 16px; color: black;"><?php echo "TOTAL RISK"; ?></span></td></tr>
                  <tr>
                    <td align="right" colspan="2"> <span style="font-weight: bold; font-size: 16px;"><?php echo "Prior: "; ?></span>
                        <span style="font-weight: bold; font-size: 21px;"><?php echo $sumAllRisk_prior; ?></span></td>
                  </tr>
              </table>
            
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%;">
           <div class="info-box" style="border: 3px solid #fff;">
             <span class="info-box-icon bg-yellow"  style="padding-left: 15px; padding-top:10px; min-height: 120px;"><center><img src="assets/images/Sarana & Prasarana.png" width="80" height="80"/></center></span>

            <div class="info-box-content bg-yellow">
              <table width="100%">
                <tr>
                    <td></td>
                    <td></td>
                    <td align="center">Current</td>
                    <td></td>
                    <td align="center">Prior</td>
                  </tr>
                  <tr>
                    <td width="5%"><img src="assets/images/legend/kri_red.png" width="15" /></td>
                    <td width="30%">High</td>
                    <td align="center"><font size="+1"><?php echo $sumHighRisk;?></font></td>
                    <td align="center"><font size="+1">|</font></td>
                    <td align="center"><font size="+1"><?php echo $sumHighRisk_prior;?></font></td>
                  </tr>
                  <tr>
                    <td width="5%"><img src="assets/images/legend/treatment.png" width="15" /></td>
                    <td width="30%">Moderate</td>
                    <td align="center"><font size="+1"><?php echo $sumModerateRisk; ?></font></td>
                    <td align="center"><font size="+1">|</font></td>
                    <td align="center"><font size="+1"><?php echo $sumModerateRisk_prior;?></font></td>
                  </tr>
                  <tr>
                    <td width="5%"><img src="assets/images/legend/kri_green.png" width="15" /></td><td width="30%">Low</td>
                    <td align="center"><font size="+1"><?php echo $sumLowRisk; ?></font></td>
                    <td align="center"><font size="+1">|</font></td>
                    <td align="center"><font size="+1"><?php echo $sumLowRisk_prior;?></font></td>
                  </tr>
                   <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" align="center"><center><b>Risk Level</b></center></td>
                  </tr>
              </table>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%;">
           <div class="info-box" style="border: 3px solid #fff;">
            <span class="info-box-icon bg-purple" style="padding-left: 11px; padding-top: 10px; min-height: 120px;"><center><img src="assets/images/Sistem Air Limbah.png" width="80" height="80"/></center></span>

            <div class="info-box-content bg-purple">
           
              <table width="100%">
                  <tr>
                    
                    <td align="right" width="70%"> <img src="assets/images/up-xxl-w.png" width="40" height="50"/></td>
                        <td align="right" width="35%"><span style="font-weight: bold; font-size: 42px;"><?php echo $AP_total_cur;?></span></td>
                    
                  </tr>
                  <tr><td align="right" colspan="2"><span style="font-weight: bold; font-size: 16px; color: black;"><?php echo "TOTAL ACTION PLAN"; ?></span></td></tr>
                  <tr>
                    <td align="right" colspan="2"> <span style="font-weight: bold; font-size: 16px;"><?php echo "Prior: "; ?></span>
                        <span style="font-weight: bold; font-size: 21px;"><?php echo $AP_total_prior; ?></span></td>
                  </tr>
              </table>
            </div>
          </div>
        </div>
 
       <div class="col-md-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%;">
          <div class="info-box" style="border: 3px solid #fff;">
            <span class="info-box-icon bg-green" style="padding-left: 11px; padding-top: 10px; min-height: 120px;"><center><img src="assets/images/Transportasi.png" width="80" height="80"/></center></span>

            <div class="info-box-content bg-green">
            <table width="100%">
                  <tr>
                    <td></td>
                    <td align="center">Current</td>
                    <td></td>
                    <td align="center">Prior</td>
                  </tr>
                  <tr>
                    <td width="30%">Complete</td>
                    <td align="center"><font size="+1"><?php echo $AP_complete_cur;?></font></td>
                    <td align="center"><font size="+1">|</font></td>
                    <td align="center"><font size="+1"><?php echo $AP_complete_prior; ?></font></td>
                  </tr>
                  <tr>
                    <td width="30%">On Going</td>
                    <td align="center"><font size="+1"><?php echo $AP_ongoing_cur; ?></font></td>
                    <td align="center"><font size="+1">|</font></td>
                    <td align="center"><font size="+1"><?php echo $AP_ongoing_prior; ?></font></td>
                  </tr>
                  <tr>
                    <td width="30%">Extend</td>
                    <td align="center"><font size="+1"><?php echo $AP_extend_cur; ?></font></td>
                    <td align="center"><font size="+1">|</font></td>
                    <td align="center"><font size="+1"><?php echo $AP_extend_prior; ?></font></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="3"><center><b>Execution</b></center></td>
                  </tr>
       
              </table></div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      <div class="col-md-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%;">
          <div class="info-box" style="border: 3px solid #fff;">
            <span class="info-box-icon bg-aqua" style="padding-left: 11px; padding-top: 10px; min-height: 120px;"><center><img src="assets/images/Fasilitas Perkotaan.png" width="80" height="80"/></center></span>

            <div class="info-box-content bg-aqua">
              <table width="100%">
                  <tr><td>&nbsp;</td></tr>
                <tr>
                  <td rowspan="5" width="40%"><center><span style="font-weight: bold; font-size: 46px;"><?php echo $AP_kri_prior;?></span><br />TOTAL KRI</center></td>
                  <tr>
                    <td width="5%"><img src="assets/images/legend/kri_red.png" width="15" /></td><td width="10%">Red</td><td width="20%" align="center"><font size="+1"><?php echo $AP_kri_red_prior;?></font></td>
                  </tr>
                  <tr>
                    <td width="5%"><img src="assets/images/legend/treatment.png" width="15" /></td><td width="10%">Yellow</td><td width="20%" align="center"><font size="+1"><?php echo $AP_kri_yellow_prior;?></font></td>
                  </tr>
                  <tr>
                    <td width="5%"><img src="assets/images/legend/kri_green.png" width="15" /></td><td width="10%">Green</td><td width="20%" align="center"><font size="+1"><?php echo $AP_kri_green_prior;?></font></td>
                  </tr>
                  <tr>
                    <td colspan="3"><center><b>KRI Warning</b></center></td>
                  </tr>
                </tr>
              </table>       
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
   </div>
                
                  <div class="col-xs-12" style="background-color: #a5cb39; margin-bottom: 20px;">
                   <br/>
                  </div>
                  <div class="col-xs-12" style="background-color: #a5cb39; margin-bottom: 20px;">
                    <center><span style="font-size: 25px; font-weight: bold;">IIGF RISK</span></center>
                  </div>

  <div class="center-container">
    <div class="row">
    <div class="col-xs-6" style="padding:0px 10px 10px 10px">
      <div style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 18px; margin: 5px 5px 5px 15px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
          <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
            <object width="100%" height="520" scrolling="no" frameborder="no" data="<?=$site_url?>1/Chart_PII_beforebuildin/index_risk_dasboard.php"></object>
          </div>
      </div>
    </div>

    <div class="col-xs-6" style="padding:0px 10px 10px 10px">
      <div style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 18px; margin: 5px 15px 5px 5px;" align="right"><b>IIGF RISK - Managed by Divison</b></div>
        <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
           <object width="100%" height="520" scrolling="no" frameborder="no" data="<?=$site_url?>1/pii_pie2/dasboard_risk.php" ></object>
      </div>
      </div>
    </div>
     
    </div>

    <div class="row">

    <div class="col-xs-6" style="padding:0px 10px 10px 10px">
      <div style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 18px; margin: 5px 5px 5px 15px;" align="left"><b>Action Plan Execution - by Execution</b></div>
             <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
           <object width="100%" height="520" scrolling="no" frameborder="no" data="<?=$site_url?>1/Chart_PII_beforebuildin/index_apex_dashboard.php"></object>
           </div>
      </div>
    </div>

    <div class="col-xs-6" style="padding:0px 10px 10px 10px">
      <div style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 18px; margin: 5px 15px 5px 5px;" align="right"><b>Key Risk Indicator (KRI) - by KRI Warning </b></div>
             <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
                <object width="100%" height="520" scrolling="no" frameborder="no" data="<?=$site_url?>1/Chart_PII_beforebuildin/index_kri_dashboard.php"></object>
           </div>
      </div>
    </div>

    </div>
  </div>


   <div class="row" style="padding-top: 0">
         
  </div>
  </section>
</div>
  <div class="tab-pane" id="tab_risk_list">

  <div class="row">
      <div class="col-md-12" style="margin-top: 20px; margin-bottom: 40px;">
          <div class="col-md-8" style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959; padding: 0px;">
              <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 16px; margin: 5px;" align="center"><b>IIGF RISK - by Risk Status</b></p></div>
               <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
              <object width="100%" height="250" scrolling="no" frameborder="no" data="<?=$site_url?>1/Chart_PII_beforebuildin/index_risk_tab2.php"></object>
              </div>
          </div>
          <div class="col-md-4">
              <div class="col-md-12 bg-aqua" style="height: 305px; padding: 0px;">
                  <div class="col-md-3">
                  <center><img src="assets/images/2.png" width="120" height="180" style="margin-top: 90px;" /></center>
                  </div>
                  <div class="col-md-9" style="padding-top: 15px;">

                      <table style="font-size: 15px;">
                         <tr>
                          <td colspan="2" align="right"><p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="center"><b>TOP FIVE RISK CATEGORY<hr></b></td>
                        </tr>
                        <tr>
                        <?php foreach ($tabTopFiveRisk as $row): ?>
                           <td valign="TOP"><b><?php echo $row->cat_code;?></b></td>
                           <td valign="TOP"><b><?php echo ":"."$row->cat_name"?></b></td>
                          
                          
                          </tr>
                           <?php endforeach;?>
                      </table>
                  </div>
             </div>
          </div>
      </div>
  </div>

      <div class="row">
        <div class="col-md-7">
            <div class="row">
              <div class="col-md-12"> 
                  <form class="form-inline" method="post" id="risk_divisi-form" autocomplete="off">
                      <div class="form-group">
                          <label for="filterFormBy" class="smaller"><font color="#000">Show by : </font> </label>
                          <select class="form-control" id="division_list" name="divisi_risk">
                            <option value="-">ALL Division</option>
                              <option disabled style="color: #000;  background-color: #99ff33;"><b>DIRECTORATE</b></option>
                              <?php foreach ($listDivision_directorat as $key): ?>
                              <option value="<?php echo $key['ref_key']; ?>" data-prefix="<?php echo $key['ref_key']; ?>"><?php echo $key['ref_value']; ?></option>
                              <?php endforeach; ?> 
                             <option disabled style="color: #000;  background-color: #99ff33;"><b>DIVISION</b></option>
                              <?php foreach ($listDivision as $key): ?>
                              <option value="<?php echo $key['ref_key']; ?>" data-prefix="<?php echo $key['ref_key']; ?>"><?php echo $key['ref_value']; ?></option>
                              <?php endforeach; ?>  
                          </select>
                
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-sm" id="select_divisi">Submit</button>
                      </div>
                      <div class="form-group" style="display: none;">
                          <input type="text"  class="form-control" name="divisi_show" id="tab_divisi_list-filterValue" />
                      </div>
                  </form>
                <br />
        <form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
            <div class="form-group">
              <label for="filterFormBy" class="smaller">Filter By : </label>
              <select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
                <option value="risk_event">Risk Event</option>
                <option value="risk_level">Risk Level</option>
                <option value="risk_impact_level">Impact Level</option>
                <option value="risk_likelihood_key">Likelihood</option>
              </select>
            </div>
            <div class="form-group" id="choose_r_level">
              <select class="form-control input-medium input-sm" id="r_level">
                <option value="-">All</option>
                <option value="LOW">Low</option>
                <option value="MODERATE">Moderate</option>
                <option value="HIGH">High</option>
              </select>
            </div>
            <div class="form-group" id="choose_l_hood">
              <select class="form-control input-medium input-sm" id="l_hood">
                <option value="-">All</option>
                <?php foreach ($likelihood as $key) {?>
                  <option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group" id="choose_impact_l">
              <select class="form-control input-medium input-sm" id="impact_l">
                <option value="-">All</option>
                <?php foreach ($impact_list as $key) {?>
                  <option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_risk_list-filterValue">
            </div>
            <button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>
          </form>
                </div>
            </div>

          <div class="row">
              <div class="col-md-12">
                  <div style="color: #000"><!--class="table-scrollable"-->
                  <table class="table table-condensed table-bordered table-hover" style="color: #000" id="datatable_ajax">
                    <thead>
                      <tr role="row" class="heading">
                        <th><center>Status</center></th>
                        <th width="10%"><center>Risk ID</center></th>
                        <th><center>Risk Event</center></th>
                        <th><center>Risk Level</center></th>
                        <th><center>Impact Level</center></th>
                        <th><center>Likelihood</center></th>
                        <th><center>Risk Owner</center></th>
                      </tr>
                    </thead>
                    <tbody style="background-color: #fff">
                    </tbody>
                  </table>
                </div>
              </div>  
          </div>

          <div class="row" style="margin-top: 15px;">
              <div class="col-md-12">
                 <font color="#000"><h4>Legend</h4></font>
                  <table style="color: #000; font-size: 16px;">
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp;</td>
                        <td>Draft</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp;</td>
                        <td>submitted to rac</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp;</td>
                        <td>Verified By RAC</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp;</td>
                        <td>on Risk Treatment Process</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp;</td>
                        <td>on Action Plan Process</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp;</td>
                        <td>On Action Plan Execution Process</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; </td>
                        <td>Action Plan Has Been Executed and Verified</td>
                    </tr>
                  </table>
              </div>  
          </div>
        </div>

      <div class="col-md-5">    
                        
          <div id="form-content-risk">
          <div class="row">
              <div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
                <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
                <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
                <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b>ALL Division</b></center></span></div>
                <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
                <object frameborder="no" name="frame1" scrolling="no" data="<?=$site_url?>1/pii_pie2/direksirac_risk.php" width="100%" height="290"></object>
                </div>
                </div>
              </div>
          </div>

            <div class="row">
              <div class="col-xs-12" style="padding-right:15px; padding-left: 0px; padding-top: 10px;">
                <div style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959;">
                <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Status</b></div>
                 <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b>ALL Division</b></center></span></div>
                  <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
                <object align="center" frameborder="no" name="frame1" scrolling="no" data="<?=$site_url?>1/pii_pie2/indexstrac.php" style="border: 0px solid;" width="100%" height="290"></object>
                </div>
                </div>
              </div>
            </div>
          </div>

      </div>

    </div>
  </div>

  <div class="tab-pane" id="tab_kri_list">
    <div class="row">
      <div class="col-md-12" style="margin-top: 20px; margin-bottom: 40px;">
          <div class="col-md-12" style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959; padding: 0px">
              <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 16px; margin: 5px;" align="center"><b>Key Risk Indicator (KRI) - by KRI Status</b></p></div>
               <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
              <object width="100%" height="250" scrolling="no" frameborder="no" data="<?=$site_url?>1/Chart_PII_beforebuildin/index_kri_tab4.php"></object>
              </div>
          </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-7">
            <div class="row">
              <div class="col-md-12"> 
                  <form class="form-inline" method="post" id="kri_divisi-form" autocomplete="off">
                      <div class="form-group">
                          <label for="filterFormBy" class="smaller"><font color="#000">Show by : </font> </label>
                          <select class="form-control" id="division_kri" name="divisi_kri">
                            <option value="-">ALL Division</option>
                            <option disabled style="color: #000;  background-color: #99ff33;"><b>DIRECTORATE</b></option>
                              <?php foreach ($listDivision_directorat as $key): ?>
                              <option value="<?php echo $key['ref_key']; ?>" data-prefix="<?php echo $key['ref_key']; ?>"><?php echo $key['ref_value']; ?></option>
                              <?php endforeach; ?> 
                             <option disabled style="color: #000;  background-color: #99ff33;"><b>DIVISION</b></option>
                              <?php foreach ($listDivision as $key): ?>
                              <option value="<?php echo $key['ref_key']; ?>" data-prefix="<?php echo $key['ref_key']; ?>"><?php echo $key['ref_value']; ?></option>
                              <?php endforeach; ?>  
                          </select>
                
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-sm" id="select_divisi_kri">Submit</button>
                      </div>
                      <div class="form-group" style="display: none;">
                          <input type="text"  class="form-control" name="divisi_kri_show" id="tab_divisi_kri-filterValue" />
                      </div>
                  </form>
                  <br />
          <form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
            <div class="form-group">
              <label for="filterFormBy" class="smaller">Filter By : </label>
              <select class="form-control input-medium input-sm" id="tab_kri-filterBy">
                <option value="key_risk_indicator">KRI</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_kri-filterValue">
            </div>
            <button type="button" class="btn blue btn-sm" id="tab_kri-filterButton">Search</button>
          </form>
                </div>
            </div>

          <div class="row">
              <div class="col-md-12">
                  <div style="color: #000"><!--class="table-scrollable"-->
                    <table class="table table-condensed table-bordered table-hover " id="datatable_kri">
                      <thead>
                        <tr role="row" class="heading">
                          <th width="30px">Status</th>
                          <th>KRI ID</th>
                          <th>KRI</th>
                          <th>KRI Owner</th>
                          <th>Timing Pelaporan</th>
                          <th>Risk ID</th>
                          <th>KRI Warning</th>
                      </tr>
                    </thead>
                      <tbody>
                      </tbody>
                   </table>
                  </div>
              </div>  
          </div>

          <div class="row" style="margin-top: 15px;">
              <div class="col-md-12">
                 <font color="#000"><h4>Legend</h4></font>
                  <table style="color: #000; font-size: 16px;">
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp;</td>
                        <td>Draft</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp;</td>
                        <td>To Be Verified by Head Division</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp;</td>
                        <td>Submitted to RAC</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp;</td>
                        <td>Verified by RAC</td>
                    </tr>
                  </table>
              </div>  
          </div>
        </div>

      <div class="col-md-5">    
                        
          <div id="form-content-kri">
          <div class="row">
              <div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
                <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
                <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>KRI - by KRI Warning</b></div>
                <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b>ALL Division</b></center></span></div>
                 <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
                <object frameborder="no" name="frame1" scrolling="no" data="<?=$site_url?>1/pii_pie2/indexkri.php" width="100%" height="290"></object>
                </div>
                </div>
              </div>
          </div>
          
         
          </div>

      </div>

    </div>
       
  </div>

  
<div class="tab-pane" id="tab_risk_map"> 
  <div style="height: 940px;">
   <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
  <object frameborder="no" name="frame1" scrolling="no" data="<?=$site_url?>/main/maindireksirac/risk_map" width="100%" height="950px"></object>
  </div>
  </div>

</div>

<div class="tab-pane" id="tab_risk_map2"> 
  <div style="height: 940px;">
   <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
  <object frameborder="no" name="frame1" scrolling="no" data="https://dashboard.tawk.to/#/chat" width="100%" height="950px"></object>
  </div>
  </div>

</div>

<div class="tab-pane" id="tab_action_plan_exec">
    <div class="row">
      <div class="col-md-12" style="margin-top: 20px; margin-bottom: 40px;">
          <div class="col-md-12" style="background-color:#f2f2f2; box-shadow: 0px 5px 15px 10px #595959; padding: 0px">
              <div style="background-color:#A9A9A9; border: 7px #999999 solid;"> <p style="color:white;  font-size: 16px; margin: 5px;" align="center"><b>Action Plan Execution - by Status</b></p></div>
              <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
              <object width="100%" height="250" scrolling="no" frameborder="no" data="<?=$site_url?>1/Chart_PII_beforebuildin/index_apex_tab3.php"></object>
              </div>
          </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-7">
            <div class="row">
              <div class="col-md-12"> 
                  <form class="form-inline" method="post" id="plan_divisi-form" autocomplete="off">
                      <div class="form-group">
                          <label for="filterFormBy" class="smaller"><font color="#000">Show by : </font> </label>
                          <select class="form-control" id="division_apexe_list" name="divisi_ap">
                            <option value="-">ALL Division</option>
                              <option disabled style="color: #000;  background-color: #99ff33;"><b>DIRECTORATE</b></option>
                              <?php foreach ($listDivision_directorat as $key): ?>
                              <option value="<?php echo $key['ref_key']; ?>" data-prefix="<?php echo $key['ref_key']; ?>"><?php echo $key['ref_value']; ?></option>
                              <?php endforeach; ?> 
                             <option disabled style="color: #000;  background-color: #99ff33;"><b>DIVISION</b></option>
                              <?php foreach ($listDivision as $key): ?>
                              <option value="<?php echo $key['ref_key']; ?>" data-prefix="<?php echo $key['ref_key']; ?>"><?php echo $key['ref_value']; ?></option>
                              <?php endforeach; ?>  
                          </select>
                
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-sm" id="select_divisi_apexe">Submit</button>
                      </div>
                      <div class="form-group" style="display: none;">
                          <input type="text"  class="form-control" name="divisi_show_apex" id="tab_divisi_apexe-filterValue" />
                      </div>
                  </form>
                  <br />
           <form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
            <div class="form-group">
              <label for="filterFormBy" class="smaller">Filter By : </label>
              <select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
                <option value="action_plan">Action Plan</option>
                <option value="due_date">Due Date</option>
                <option value="execution_status">Execution</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_action_plan_exec-filterValue">
            </div>
            <button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
          </form>
                </div>
            </div>

          <div class="row">
              <div class="col-md-12">
                  <div style="color: #000"><!--class="table-scrollable"-->
                  <table class="table table-condensed table-bordered table-hover" style="color: #000" id="datatable_action_plan_exec">
                    <thead>
                      <tr role="row" class="heading">
                        <th>Status</th>
                        <th width="10%">AP ID</th>
                        <th>Action Plan</th>
                        <th>Due Date</th>
                        <th>Action Plan Owner</th>
                        <th>Execution</th>
                        <th>Risk ID</th>
                      </tr>
                    </thead>
                    <tbody style="background-color: #fff">
                    </tbody>
                  </table>
                </div>
              </div>  
          </div>

          <div class="row" style="margin-top: 15px;">
              <div class="col-md-12">
                 <font color="#000"><h4>Legend</h4></font>
                  <table style="color: #000; font-size: 16px;">
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp;</td>
                        <td>Draft</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp;</td>
                        <td>To Be Verified by Head Division</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp;</td>
                        <td>Submitted to RAC</td>
                    </tr>
                    <tr>
                        <td><img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp;</td>
                        <td>Verified by RAC</td>
                    </tr>
                  </table>
              </div>  
          </div>
        </div>

      <div class="col-md-5">    
                        
          <div id="form-content-plan">
          <div class="row">
              <div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
                <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
                <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>Action Plan Execution - by Execution</b></div>
                <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b>ALL Division</b></center></span></div>
                 <div style="background:url('https://68.media.tumblr.com/695ce9a82c8974ccbbfc7cad40020c62/tumblr_o9c9rnRZNY1qbmm1co1_500.gif') no-repeat center; background-size: 55px;">
                    <object frameborder="no" name="frame1" scrolling="no" data="<?=$site_url?>1/pii_pie2/direksiapex_rac.php" width="100%" height="290"></object>
                </div>
                </div>
              </div>
          </div>
          
        
          </div>

      </div>

    </div>
</div>


<!-- ******************************************************************************************* -->
    <!-- END CONTENT-->
  </div>
</div>

<!-- PIC -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Note</h4>
  </div>
  <div class="modal-body">
    <form id="noteform" role="form" class="form-horizontal" action ="<?=base_url('index.php/main/mainrac/submit_note');?>" method="POST">      
      <textarea name = "note" id = "modal_pic_note" class="form-control"></textarea>
      <input type = "hidden" id = "modal_pic_risk_input_by" name = "risk_input_by">
      <button type="button" class="btn blue btn-sm" onclick = "submit_note()">Save</button>      
    </form> 
  </div>
</div>

<!-- Execution Form -->
<div id="modal-exec" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false" role="dialog" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Action Plan Execution</h4>
  </div>
  <div class="modal-body form">
    <form id="exec-form" role="form" class="form-horizontal">
    <input type="hidden" id="form-action-id" name="action_id" value="" />
      <div class="form-body">
        <div class="form-group">
          <label class="col-md-3 smaller control-label">Status </label>
          <div class="col-md-9">
          <select class="form-control input-sm" name="execution_status" id="exec-select-status">
            <option value="COMPLETE" selected>Complete</option>
            <option value="EXTEND">Extend</option>
            <option value="ONGOING">On Going</option>
          </select>
          </div>
        </div>
        <div class="form-group" id="fgroup-explain">
          <label class="col-md-3 control-label smaller cl-compact">Explanation<span class="required">* </span></label>
          <div class="col-md-9">
          <textarea class="form-control" rows="3" name="execution_explain" placeholder=""></textarea>
          </div>
        </div>
        <div class="form-group" id="fgroup-evidence">
          <label class="col-md-3 control-label smaller cl-compact">Evidence</label>
          <div class="col-md-9">
          <textarea class="form-control" rows="3" name="execution_evidence" placeholder=""></textarea>
          </div>
        </div>         
        <div class="form-group" id="fgroup-reason">
          <label class="col-md-3 control-label smaller cl-compact">Reason<span class="required">* </span></label>
          <div class="col-md-9">
          <textarea class="form-control" rows="3" name="execution_reason" placeholder=""></textarea>
          </div>
        </div>
        <div class="form-group" id="fgroup-date">
          <label class="col-md-3 smaller control-label">Revised Date<span class="required">* </span></label>
          <div class="col-md-9">
          <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
            <input type="text" class="form-control input-sm" name="revised_date" readonly value="<?=date('d-m-Y')?>">
            <span class="input-group-btn">
            <button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
            </span>
          </div>
          </div>
        </div>
      </div>
      
      <div class="form-actions right">
        <button id="exec-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save </button>
        <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
      </div>
    </form>
  </div>
</div>



<script type="text/javascript">
$(document).ready(function() {  
  
  // submit form using $.ajax() method
  
  $('#risk_divisi-form').submit(function(e){
    
    e.preventDefault(); // Prevent Default Submission
    
    $.ajax({
      url: '<?php echo site_url() ?>/main/maindireksirac/getRiskDivisi',
      type: 'POST',
      data: $(this).serialize() // it will serialize the form data
    })
    .done(function(data){
      
    $('#form-content-risk').html(data);
      
    })
    .fail(function(){
      alert('Submit Failed ...');  
    });
  });

    $('#plan_divisi-form').submit(function(e){
    
    e.preventDefault(); // Prevent Default Submission
    
    $.ajax({
      url: '<?php echo site_url() ?>/main/maindireksirac/getPlanDivisi',
      type: 'POST',
      data: $(this).serialize() // it will serialize the form data
    })
    .done(function(data){
      
    $('#form-content-plan').html(data);
      
    })
    .fail(function(){
      alert('Submit Failed ...');  
    });
  });

    $('#kri_divisi-form').submit(function(e){
    
    e.preventDefault(); // Prevent Default Submission
    
    $.ajax({
      url: '<?php echo site_url() ?>/main/maindireksirac/getKriDivisi',
      type: 'POST',
      data: $(this).serialize() // it will serialize the form data
    })
    .done(function(data){
      
    $('#form-content-kri').html(data);
      
    })
    .fail(function(){
      alert('Submit Failed ...');  
    });
  });
  
  
});
</script>