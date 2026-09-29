@extends('layouts.cadviewer')

@section('body-style', 'margin:0; padding:0; background-color: #f8f9fa; overflow: hidden;')

@section('body')

	<!-- Simulated Fixed Admin Header -->
	<div id="customer-header" style="position: fixed; top: 0; left: 0; width: 100%; height: 120px; background-color: #343a40; color: white; padding: 20px; box-sizing: border-box; z-index: 1000;">
		<h2 style="margin-top:0;">Fixed Admin Header (Height: 120px)</h2>
		<p>This header is locked at the top. The content below scrolls independently. Test for CADViewer canvas Redline and Space Object Interaction.</p>
	</div>

	<!-- Simulated Scrolling Content Area (typical in dashboards) -->
	<div id="content-scroll-area" style="margin-top: 120px; height: calc(100vh - 120px); overflow-y: auto; position: relative; padding: 20px;">
		<div class="container-fluid">
			
			<div style="height: 300px; border: 2px dashed #aaa; margin-bottom: 20px; text-align: center; padding-top: 130px; background: white;">
				<h3>Scroll Down to see CADViewer...</h3>
				<p>This space simulates other dashboard widgets pushing the canvas down into a scrolling container.</p>
			</div>

			<div class="row">
				<div class="col-sm-12 col-lg-12 mb-4">
					<div class="position-relative cadviewer-wrapper" style="background-color: white; border: 1px solid #ccc; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
						
						<!-- CADViewer floorplan div declaration -->
						<div id="floorPlan" class="cadviewer-bootstrap cadviewer-core-styles" style="border:2px none; width: 100%; height: 800px;">
						</div>
						<!-- End of CADViewer declaration -->

					</div>
				</div>
			</div>
			
			<div style="height: 500px;"></div> <!-- Bottom scroll padding -->
		</div>
	</div>

@endsection
