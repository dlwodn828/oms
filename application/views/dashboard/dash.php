
	<div id="content" class="content">
		<h1 class="page-header"> Dashboard</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						실시간 재고량
						<ul class="pull-right panel-settings panel-button-tab-right">
							<ul class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
							</a>
							</ul>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<div class="row">	
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-teal" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-blue" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-orange" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-red" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-teal" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-blue" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-orange" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3">
									<div class="panel panel-default">
										<div class="panel-body easypiechart-panel">
											<div class="easypiechart easypiechart-red" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		

		<div class="row" id="dsp">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						품목별 사용량
						<ul class="pull-right panel-settings panel-button-tab-right">
							<ul class="dropdown">
							</a>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button class="btn btn-secondary active" type="button"><a href="#tab1" data-toggle="tab">Tab 1</a></button>
								<button class="btn btn-secondary" type="button"><a href="#tab2" data-toggle="tab">Tab 2</a></button>
								<button class="btn btn-secondary" type="button"><a href="#tab3" data-toggle="tab">Tab 3</a></button>
							</div>
							</ul>
						</ul>
					</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab1">
									<canvas class="main-chart" id="bar-chart1" height="200" width="600"></canvas>
								</div>
								<div class="tab-pane fade in" id="tab2">
									<canvas class="main-chart" id="bar-chart2" height="200" width="600"></canvas>
								</div>
								<div class="tab-pane fade in" id="tab3">
									<canvas class="main-chart" id="bar-chart3" height="200" width="600"></canvas>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						품목별 단가 시세
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart2" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
			
		<div class="row">
			<div class="col-md-12">
				<!-- DataTables Example -->
				<div class="panel panel-default">
					<div class="panel-heading"><!--원래는 card-heading-->
						<i class="fas fa-table"></i>
						주문 내역</div>
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
							<tr>
								<th>번호</th>
								<th>주문 일자</th>
								<th>품명</th>
								<th>재질</th>
								<th>도금</th>
								<th>굵기</th>
								<th>길이</th>
								<th>피치</th>
								<th>주문 수량</th>
								<th>진행 상태</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-primary">진행중</button></td>
							</tr>
							<tr>
								<td>2</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-primary">진행중</button></td>
							</tr>
							<tr>
								<td>3</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-primary">진행중</button></td>
							</tr>
							<tr>
								<td>4</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-primary">진행중</button></td>
							</tr>
							<tr>
								<td>5</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>6</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>7</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>8</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>9</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>10</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>11</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>
							<tr>
								<td>12</td>
								<td>2019.01.05</td>
								<td>육각볼트</td>
								<td>철</td>
								<td>천연색 전기아연도금</td>
								<td>M24</td>
								<td>250</td>
								<td>-</td>
								<td>200</td>
								<td><button type="button" class="btn btn-sm btn-success">완료</button></td>
							</tr>													
							</tbody>
						</table>
						</div>
					</div>
					<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
				</div><!--/.row-->
			</div>
		</div>
	</div>

	<script>
	$(document).ready(function() {
		App.init();
	});
	
	</script> 	 
	<script src="/assets/lumino/js/jquery-1.11.1.min.js"></script>
	<script src="/assets/lumino/js/bootstrap.min.js"></script>
	<script src="/assets/lumino/js/chart.min.js"></script>
	<script src="/assets/lumino/js/chart-data.js"></script>	
	<script src="/assets/lumino/js/easypiechart.js"></script>
	<script src="/assets/lumino/js/easypiechart-data.js"></script>
	<script src="/assets/lumino/js/bootstrap-datepicker.js"></script>
	<script src="/assets/lumino/js/custom.js"></script>
	
	<script>
		//실시간 재고량 파이그래프 -> 여기에 색깔 지정. 조건문 써서 %에 따라서 색 다르게 하기 코드.

	window.onload = function () {
		
		var usageChart_day = document.getElementById("bar-chart1").getContext("2d");
		window.myBar = new Chart(usageChart_day).Bar(barChartData, {
			responsive: true,
			scaleLineColor: "rgba(0,0,0,.2)",
			scaleGridLineColor: "rgba(0,0,0,.05)",
			scaleFontColor: "#c5c7cc"
		});


		var chart3 = document.getElementById("line-chart2").getContext("2d");
		window.myLine = new Chart(chart3).Line(lineChartData2, {
		responsive: true,
		scaleLineColor: "rgba(0,0,0,.2)",
		scaleGridLineColor: "rgba(0,0,0,.05)",
		scaleFontColor: "#c5c7cc"
		});


	$(function() {
		$('.easypiechart-teal').easyPieChart({
			scaleColor: false,
			barColor: '#1ebfae'
		});
	});
	$(function() {
		$('.easypiechart-blue').easyPieChart({
			scaleColor: false,
			barColor: '#30a5ff'
		});
	});
	$(function() {
		$('.easypiechart-red').easyPieChart({
			scaleColor: false,
			barColor: '#ef4040'
		});
	});
	$(function() {
		$('.easypiechart-orange').easyPieChart({
			scaleColor: false,
			barColor: '#ffb53e'
		});
	});


		/**!
		 * easyPieChart
		 * Lightweight plugin to render simple, animated and retina optimized pie charts
		 *
		 * @license 
		 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
		 * @version 2.1.5
		 **/

		(function(root, factory) {
			if(typeof exports === 'object') {
				module.exports = factory(require('jquery'));
			}
			else if(typeof define === 'function' && define.amd) {
				define(['jquery'], factory);
			}
			else {
				factory(root.jQuery);
			}
		}(this, function($) {

		/**
		 * Renderer to render the chart on a canvas object
		 * @param {DOMElement} el      DOM element to host the canvas (root of the plugin)
		 * @param {object}     options options object of the plugin
		 */
		var CanvasRenderer = function(el, options) {
			var cachedBackground;
			var canvas = document.createElement('canvas');

			el.appendChild(canvas);

			if (typeof(G_vmlCanvasManager) !== 'undefined') {
				G_vmlCanvasManager.initElement(canvas);
			}

			var ctx = canvas.getContext('2d');

			canvas.width = canvas.height = options.size;

			// canvas on retina devices
			var scaleBy = 1;
			if (window.devicePixelRatio > 1) {
				scaleBy = window.devicePixelRatio;
				canvas.style.width = canvas.style.height = [options.size, 'px'].join('');
				canvas.width = canvas.height = options.size * scaleBy;
				ctx.scale(scaleBy, scaleBy);
			}

			// move 0,0 coordinates to the center
			ctx.translate(options.size / 2, options.size / 2);

			// rotate canvas -90deg
			ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI);

			var radius = (options.size - options.lineWidth) / 2;
			if (options.scaleColor && options.scaleLength) {
				radius -= options.scaleLength + 2; // 2 is the distance between scale and bar
			}

			// IE polyfill for Date
			Date.now = Date.now || function() {
				return +(new Date());
			};

			/**
			 * Draw a circle around the center of the canvas
			 * @param {strong} color     Valid CSS color string
			 * @param {number} lineWidth Width of the line in px
			 * @param {number} percent   Percentage to draw (float between -1 and 1)
			 */

			var drawCircle = function(color, lineWidth, percent) {
				percent = Math.min(Math.max(-1, percent || 0), 1);
				var isNegative = percent <= 0 ? true : false;

				ctx.beginPath();
				ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, isNegative);

				ctx.strokeStyle = color;
				ctx.lineWidth = lineWidth;

				ctx.stroke();
			};
			/**
			 * Draw the scale of the chart
			 */
			var drawScale = function() {
				var offset;
				var length;

				ctx.lineWidth = 1;
				ctx.fillStyle = options.scaleColor;

				ctx.save();
				for (var i = 24; i > 0; --i) {
					if (i % 6 === 0) {
						length = options.scaleLength;
						offset = 0;
					} else {
						length = options.scaleLength * 0.6;
						offset = options.scaleLength - length;
					}
					ctx.fillRect(-options.size/2 + offset, 0, length, 1);
					ctx.rotate(Math.PI / 12);
				}
				ctx.restore();
			};

			/**
			 * Request animation frame wrapper with polyfill
			 * @return {function} Request animation frame method or timeout fallback
			 */
			var reqAnimationFrame = (function() {
				return  window.requestAnimationFrame ||
						window.webkitRequestAnimationFrame ||
						window.mozRequestAnimationFrame ||
						function(callback) {
							window.setTimeout(callback, 1000 / 60);
						};
			}());

			/**
			 * Draw the background of the plugin including the scale and the track
			 */
			var drawBackground = function() {
				if(options.scaleColor) drawScale();
				if(options.trackColor) drawCircle(options.trackColor, options.lineWidth, 1);
			};

		/**
			* Canvas accessor
		*/
		this.getCanvas = function() {
			return canvas;
		};
		
		/**
			* Canvas 2D context 'ctx' accessor
		*/
		this.getCtx = function() {
			return ctx;
		};

			/**
			 * Clear the complete canvas
			 */
			this.clear = function() {
				ctx.clearRect(options.size / -2, options.size / -2, options.size, options.size);
			};

			/**
			 * Draw the complete chart
			 * @param {number} percent Percent shown by the chart between -100 and 100
			 */
			this.draw = function(percent) {
				// do we need to render a background
				if (!!options.scaleColor || !!options.trackColor) {
					// getImageData and putImageData are supported
					if (ctx.getImageData && ctx.putImageData) {
						if (!cachedBackground) {
							drawBackground();
							cachedBackground = ctx.getImageData(0, 0, options.size * scaleBy, options.size * scaleBy);
						} else {
							ctx.putImageData(cachedBackground, 0, 0);
						}
					} else {
						this.clear();
						drawBackground();
					}
				} else {
					this.clear();
				}

				ctx.lineCap = options.lineCap;

				// if barcolor is a function execute it and pass the percent as a value
				var color;
				if (typeof(options.barColor) === 'function') {
					color = options.barColor(percent);
				} else {
					color = options.barColor;
				}

				// draw bar
				drawCircle(color, options.lineWidth, percent / 100);
				
			}.bind(this);

			/**
			 * Animate from some percent to some other percentage
			 * @param {number} from Starting percentage
			 * @param {number} to   Final percentage
			 */
			this.animate = function(from, to) {
				var startTime = Date.now();
				options.onStart(from, to);
				var animation = function() {
					var process = Math.min(Date.now() - startTime, options.animate.duration);
					var currentValue = options.easing(this, process, from, to - from, options.animate.duration);
					this.draw(currentValue);
					options.onStep(from, to, currentValue);
					if (process >= options.animate.duration) {
						options.onStop(from, to);
					} else {
						reqAnimationFrame(animation);
					}
				}.bind(this);

				reqAnimationFrame(animation);
			}.bind(this);
		};

		var EasyPieChart = function(el, opts) {
			var defaultOptions = {
				barColor: '#ef1e25',
				trackColor: '#f9f9f9',
				scaleColor: '#dfe0e0',
				scaleLength: 5,
				lineCap: 'round',
				lineWidth: 3,
				size: 110,
				rotate: 0,
				animate: {
					duration: 1000,
					enabled: true
				},
				easing: function (x, t, b, c, d) { // more can be found here: http://gsgd.co.uk/sandbox/jquery/easing/
					t = t / (d/2);
					if (t < 1) {
						return c / 2 * t * t + b;
					}
					return -c/2 * ((--t)*(t-2) - 1) + b;
				},
				onStart: function(from, to) {
					return;
				},
				onStep: function(from, to, currentValue) {
					return;
				},
				onStop: function(from, to) {
					return;
				}
			};

			// detect present renderer
			if (typeof(CanvasRenderer) !== 'undefined') {
				defaultOptions.renderer = CanvasRenderer;
			} else if (typeof(SVGRenderer) !== 'undefined') {
				defaultOptions.renderer = SVGRenderer;
			} else {
				throw new Error('Please load either the SVG- or the CanvasRenderer');
			}

			var options = {};
			var currentValue = 0;

			/**
			 * Initialize the plugin by creating the options object and initialize rendering
			 */
			var init = function() {
				this.el = el;
				this.options = options;

				// merge user options into default options
				for (var i in defaultOptions) {
					if (defaultOptions.hasOwnProperty(i)) {
						options[i] = opts && typeof(opts[i]) !== 'undefined' ? opts[i] : defaultOptions[i];
						if (typeof(options[i]) === 'function') {
							options[i] = options[i].bind(this);
						}
					}
				}

				// check for jQuery easing
				if (typeof(options.easing) === 'string' && typeof(jQuery) !== 'undefined' && jQuery.isFunction(jQuery.easing[options.easing])) {
					options.easing = jQuery.easing[options.easing];
				} else {
					options.easing = defaultOptions.easing;
				}

				// process earlier animate option to avoid bc breaks
				if (typeof(options.animate) === 'number') {
					options.animate = {
						duration: options.animate,
						enabled: true
					};
				}

				if (typeof(options.animate) === 'boolean' && !options.animate) {
					options.animate = {
						duration: 1000,
						enabled: options.animate
					};
				}

				// create renderer
				this.renderer = new options.renderer(el, options);

				// initial draw
				this.renderer.draw(currentValue);

				// initial update
				if (el.dataset && el.dataset.percent) {
					this.update(parseFloat(el.dataset.percent));
				} else if (el.getAttribute && el.getAttribute('data-percent')) {
					this.update(parseFloat(el.getAttribute('data-percent')));
				}
			}.bind(this);

			/**
			 * Update the value of the chart
			 * @param  {number} newValue Number between 0 and 100
			 * @return {object}          Instance of the plugin for method chaining
			 */
			this.update = function(newValue) {
				newValue = parseFloat(newValue);
				if (options.animate.enabled) {
					this.renderer.animate(currentValue, newValue);
				} else {
					this.renderer.draw(newValue);
				}
				currentValue = newValue;
				return this;
			}.bind(this);

			/**
			 * Disable animation
			 * @return {object} Instance of the plugin for method chaining
			 */
			this.disableAnimation = function() {
				options.animate.enabled = false;
				return this;
			};

			/**
			 * Enable animation
			 * @return {object} Instance of the plugin for method chaining
			 */
			this.enableAnimation = function() {
				options.animate.enabled = true;
				return this;
			};

			init();
		};

		$.fn.easyPieChart = function(options) {
			return this.each(function() {
				var instanceOptions;

				if (!$.data(this, 'easyPieChart')) {
					instanceOptions = $.extend({}, options, $(this).data());
					$.data(this, 'easyPieChart', new EasyPieChart(this, instanceOptions));
				}
			});
		};


		}));

	};
	
	</script>


	<!-- Bootstrap core JavaScript-->
	<!--script src="vendor/jquery/jquery.min.js"></script-->
	<script src="/assets/lumino/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="/assets/lumino/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Page level plugin JavaScript-->
	<script src="/assets/lumino/vendor/datatables/jquery.dataTables.js"></script>
	<script src="/assets/lumino/vendor/datatables/dataTables.bootstrap4.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="/assets/lumino/js/sb-admin.min.js"></script>

	<!-- Demo scripts for this page-->
	<script src="/assets/lumino/js/demo/datatables-demo.js"></script>
	<!-- CoreUI and necessary plugins-->
	<script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/pace-progress/pace.min.js"></script>
    <script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>

