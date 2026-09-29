@extends('layouts.cadviewer')

@section('body')


	<table width="100%" height="100%" border="0" cellspacing="0" border-spacing="0" id="mainTable">
		<tr style="background-color:rgb(255,255,255)" height="100px">
			<td height="10">
				<canvas id="dummy" width="10" height="10"></canvas>
			</td>
			<td>
				<a href="https://cadviewer.com/cadviewertechdocs"><img src="/app/images/cadviewer-primary-logo.svg" height="60" alt="CADViewer Logo" /></a>

			</td>
			<td>
				<canvas id="dummy" width="10" height="10"></canvas>
			</td>
			<td>
				<h4><span style="font-size: 16px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif; font-weight: bold; margin-left: 15px; float: right;">
  <a href="https://github.com/CADViewer/cadviewer-testapp-blade-01" target="_blank" style="text-decoration: none; color: #0366d6; background-color: #f6f8fa; padding: 4px 10px; border-radius: 6px; border: 1px solid #d1d5da; display: inline-block;">
    <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" width="20" height="20" alt="GitHub Logo" style="vertical-align: middle;"/>
    <span style="vertical-align: middle; margin-left: 5px;">Pull or clone from GitHub</span>
  </a>
</span>
<b style="font-size: 24px;">CADViewer: <img src="/app/images/xampp-logo.svg" height="32" alt="XAMPP" style="vertical-align: middle; margin: 0 6px;" /><img src="/app/images/php-logo.svg" height="32" alt="PHP" style="vertical-align: middle; margin: 0 6px;" /><img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" height="32" alt="Laravel" style="vertical-align: middle; margin: 0 6px;" /> Laravel Blade Sample Fileloading and Redlining</b></h4>
				<p>Check out the <strong><a href="http://cadviewer.com/cadviewertechdocs/">Documentation</a></strong> at
					our <strong><a href="http://cadviewer.com/cadviewertechdocs/samples/">TechDocs</a></strong>. Contact
					us at: <a href="mailto:developer@cadviewer.com">developer@cadviewer.com</a> or <a
						href="mailto:internationalsales@cadviewer.com">internationalsales@cadviewer.com</a>.
				</p>
			</td>
		</tr>
	</table>



	<table id="none">
		<tr>
			<td>

				<!--This is the CADViewer floorplan div declaration -->

				<div id="floorPlan" class="cadviewer-bootstrap cadviewer-core-styles"
					style="border:2px none; width:1800;height:1400;">
				</div>

				<!--End of CADViewer declaration -->

			</td>
		</tr>
	</table>

@endsection
