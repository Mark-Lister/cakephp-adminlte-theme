<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder'). DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';
if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="<?php echo $this->Url->build('/'); ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    
    <li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-file-pdf-o"></i> <span>Jobs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/Invoices'); ?>"><i class="fa fa-dollar"></i>Jobs</a></li>
            <li><a href="<?php echo $this->Url->build('/Quotes'); ?>"><i class="fa fa-question"></i>Quotes</a></li>
            <li><a href="<?php echo $this->Url->build('/EquipmentCollections'); ?>"><i class="fa fa-hand-lizard-o"></i>Collections</a></li>
            
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dropbox"></i> <span>Stores</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="/Stocks"><i class="fa  fa-tag"></i>Stock</a></li>
            <li><a href="<?php echo $this->Url->build('/Orders'); ?>"><i class="fa fa-pencil-square-o"></i>Puchase Orders</a></li>
            <li><a href="/InwardShipments"><i class="fa fa-cart-arrow-down"></i>Inwards Shipments</a></li>
            <li><a href="<?php echo $this->Url->build('/StoresRequests'); ?>"><i class="fa fa-exchange"></i>Stores Requests</a></li>
        </ul>
    </li>
    <!--li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Customers</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/Customers/add'); ?>"><i class="fa fa-circle-o"></i> New Customer</a></li>
            <li><a href="<?php echo $this->Url->build('/Customers'); ?>"><i class="fa fa-circle-o"></i> View Customers</a></li>
			
        </ul>
    </li-->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Contacts</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/Customers'); ?>"><i class="fa fa-shopping-cart"></i>Customers</a></li>
            <li><a href="<?php echo $this->Url->build('/Suppliers'); ?>"><i class="fa fa-truck"></i>Suppliers</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/AircraftRegs'); ?>">
            <i class="fa fa-plane"></i> <span>Aircraft</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-edit "></i> <span>Certification</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/LogEntries'); ?>"><i class="fa fa-book"></i> Log Entries</a></li>
            <li><a href="<?php echo $this->Url->build('/Facilities'); ?>"><i class="fa fa-building-o"></i> Facilities</a></li>
            <li><a href="<?php echo $this->Url->build('/OutwardReleases'); ?>"><i class="fa fa-arrow-up"></i> Outwards Release</a></li>
            <li><a href="<?php echo $this->Url->build('/FormOnes'); ?>"><i class="fa fa-file-pdf-o"></i> Form Ones</a></li>
            <li><a href="<?php echo $this->Url->build('/CalibrationCertificates'); ?>"><i class="fa fa-balance-scale"></i> Calibration Certificates</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cubes "></i> <span>Workshop</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/TestEquipments'); ?>"><i class="fa fa-calculator"></i> Test Equipment</a></li>
            <li><a href="<?php echo $this->Url->build('/PublicationIndexs'); ?>"><i class="fa fa-newspaper-o"></i> Publication Index</a></li>
            <li>
                <a href="<?php echo $this->Url->build('/EquipmentCapabilities'); ?>">
                    <i class="fa fa-wrench"></i> <span>Form One Capability List</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i> <span>Worksheets</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/TestWorksheets'); ?>"><i class="fa fa-circle-o"></i> Component Worksheets </a></li>
                    <li><a href="<?php echo $this->Url->build('/StaticSystemTestTypes'); ?>"><i class="fa fa-circle-o"></i> Static System Inspection </a></li>
                    <li><a href="<?php echo $this->Url->build('/AvionicsInspectionTypes'); ?>"><i class="fa fa-circle-o"></i> Aircraft Inspection </a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i> <span>Team</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/Users'); ?>"><i class="fa fa-users"></i> People</a></li>
            <!--li><a href="<?php echo $this->Url->build('/Timesheets/add'); ?>"><i class="fa fa-plus"></i> New Timesheet</a></li-->
            <li><a href="<?php echo $this->Url->build('/Timesheets'); ?>"><i class="fa fa-clock-o"></i>Timesheets</a></li>
        </ul>
    </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-list"></i> <span>Reports</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="#">
                    <i class="fa fa-tag"></i> <span>Stores</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/1'); ?>"><i class="fa fa-circle-o"></i> Quarantined </a></li>
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/2'); ?>"><i class="fa fa-circle-o"></i> Time Expired </a></li>
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/3'); ?>"><i class="fa fa-circle-o"></i> Checks Due </a></li>
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/4'); ?>"><i class="fa fa-circle-o"></i> Run Due </a></li>
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/7'); ?>"><i class="fa fa-circle-o"></i> Stocktake </a></li>
                    <li><a href="/StockLocations"><i class="fa fa-location-arrow"></i>Stock Locations</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cubes"></i> <span>Workshop</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/5'); ?>"><i class="fa fa-circle-o"></i> Expired Publications </a></li>
                    <li><a href="<?php echo $this->Url->build('/Reports/Index/6'); ?>"><i class="fa fa-circle-o"></i> Expired Calibrations </a></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar-check-o "></i> <span>Xero</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/XeroBatches'); ?>"><i class="fa fa-bank"></i> Batches</a></li>
                    <li><a href="<?php echo $this->Url->build('/Statements'); ?>"><i class="fa fa-file-word-o"></i> Statements </a></li>
                </ul>
            </li>
            <li><a href="/Bugs"><i class="fa fa-bug"></i>Bugs</a></li>
            <li><a href="/StockDetails"><i class="fa fa-compass"></i>Component Tracker</a></li>
        </ul>
    </li>
    
    <?php $group = $this->request->session()->read('Auth.User.group_id');
		//echo $uid;
		if($group  == 1){
			?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-star"></i> <span>Admin</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="/AclManager"><i class="fa  fa-unlock"></i>Access Control</a></li>
            
            <li><a href="" onclick="javascript:openNewWindow(`/Documentation/add/<?php echo str_replace( '/', '.', substr($_SERVER['REQUEST_URI'], 1)); ?>`, 'add')"><i class="fa fa-question-circle"></i>Create Help</a></li>
            <!--li><a href="/Documentation/add/<?php echo str_replace( '/', '.', substr($_SERVER['REQUEST_URI'], 1)); ?>"><i class="fa fa-question-circle"></i>Create Help</a></li-->
            <li>
                <a href="<?php echo $this->Url->build('/Authorizations'); ?>">
                    <i class="fa fa-check-circle-o"></i> <span>Authorizations</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Options</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/Options'); ?>"><i class="fa fa-circle-o"></i> General </a></li>
                    <li><a href="<?php echo $this->Url->build('/Phrases'); ?>"><i class="fa fa-circle-o"></i> Phrases</a></li>
                    <!--li><a href="<?php echo $this->Url->build('/TestEquipments/relevantEquipment'); ?>"><i class="fa fa-circle-o"></i> Relevant Equipment</a></li-->
                    <li><a href="<?php echo $this->Url->build('/AtaChapters'); ?>"><i class="fa fa-book"></i> ATA Chapters</a></li>
                    <li><a href="<?php echo $this->Url->build('/Units/hide'); ?>"><i class="fa fa-book"></i> Units</a></li>
                    <li><a href="<?php echo $this->Url->build('/StockCodes'); ?>"><i class="fa fa-circle-o"></i> Stock Codes </a></li>
                    <li><a href="<?php echo $this->Url->build('/CertificationTypes'); ?>"><i class="fa fa-circle-o"></i> Certification Types </a></li>
                    <li><a href="<?php echo $this->Url->build('/MyobGlCodes'); ?>"><i class="fa fa-circle-o"></i> Myob GL Codes </a></li>
                    <li><a href="<?php echo $this->Url->build('/CommonDefects'); ?>"><i class="fa fa-circle-o"></i> Common Defects </a></li>
                    <li><a href="<?php echo $this->Url->build('/JobTypes'); ?>"><i class="fa fa-circle-o"></i> Job Types </a></li>
                    <li><a href="<?php echo $this->Url->build('/StoresClasses'); ?>"><i class="fa fa-circle-o"></i> Stores Classes </a></li>
                    <li><a href="<?php echo $this->Url->build('/StoresClassesCertificationTypes'); ?>"><i class="fa fa-circle-o"></i> Stores Classes Certs </a></li>
                    <li><a href="<?php echo $this->Url->build('/Codes'); ?>"><i class="fa fa-circle-o"></i> Timesheet Codes </a></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-list-alt"></i> <span>Facilities</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Url->build('/Facilities'); ?>"><i class="fa fa-circle-o"></i> Facilities </a></li>
                            <li><a href="<?php echo $this->Url->build('/Locations'); ?>"><i class="fa fa-circle-o"></i> Facility Locations</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo $this->Url->build('/HotSerials'); ?>">
                    <i class="fa fa-fire"></i> <span>Hot Serials</span>
                </a>

            </li>

            


            <?php } ?>
        </ul>
    </li>
    <!--li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
                <span class="label label-primary pull-right">4</span>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/layout/top-nav'); ?>"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/boxed'); ?>"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/fixed'); ?>"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/collapsed-sidebar'); ?>"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->Url->build('/pages/widgets'); ?>">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/charts/chartjs'); ?>"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/morris'); ?>"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/flot'); ?>"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/inline'); ?>"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/ui/general'); ?>"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/icons'); ?>"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/buttons'); ?>"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/sliders'); ?>"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/timeline'); ?>"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/modals'); ?>"><i class="fa fa-circle-o"></i> Modals</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/forms/general'); ?>"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/forms/advanced'); ?>"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/forms/editors'); ?>"><i class="fa fa-circle-o"></i> Editors</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Data tables</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->Url->build('/pages/calendar'); ?>">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-red">3</small>
                <small class="label pull-right bg-blue">17</small>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-yellow">12</small>
                <small class="label pull-right bg-green">16</small>
                <small class="label pull-right bg-red">5</small>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/mailbox'); ?>">Inbox <span class="label label-primary pull-right">13</span></a></li>
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/compose'); ?>">Compose</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/read-mail'); ?>">Read</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/starter'); ?>"><i class="fa fa-circle-o"></i> Starter</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/invoice'); ?>"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/profile'); ?>"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/login'); ?>"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/register'); ?>"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/lockscreen'); ?>"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/404'); ?>"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/500'); ?>"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/blank'); ?>"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/pace'); ?>"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
                <a href="#">
                <i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Level Two
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        </ul>
    </li>
    <li><a href="<?php echo $this->Url->build('/pages/documentation'); ?>"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
    <li class="header">LABELS</li>
    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    <li><a href="<?php echo $this->Url->build('/pages/debug'); ?>"><i class="fa fa-bug"></i> Debug</a></li-->
</ul>
<?php } ?>