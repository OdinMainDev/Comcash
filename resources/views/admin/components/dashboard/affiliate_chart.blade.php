<div class="row">
	<div class="col-7 col-xl-8 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">{{__("common.dashboard_affiliate_latest")}}</h6>
				</div>
				<div id="admAffiliateChart" ></div>
			</div>
		</div>
	</div>
	<div class="col-lg-5 col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline">
					<h6 class="card-title mb-0">{{__("common.dashboard_affiliate_total")}}</h6>
				</div>
				<div id="admAffiliateChart2"></div>
				<div class="row mb-3">
					<div class="col-12 text-center mb-4">
						<div>
							<label class="">
								{{__("common.dashboard_total_exhanges")}}
							</label>
							<h5 class="fw-bolder mb-0" id="admAffiliateChart2Total"></h5>
						</div>
					</div>
					<div class="col-6 d-flex justify-content-end">
						<div>
							<label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">
							{{__("common.dashboard_affiliate_total_fromweb")}} <span class="p-1 ms-1 rounded-circle bg-primary"></span>
							</label>
							<h5 class="fw-bolder mb-0 text-end" id="admAffiliateChart2FromWeb"></h5>
						</div>
					</div>
					<div class="col-6">
						<div>
							<label class="d-flex align-items-center tx-10 text-uppercase fw-bolder">
								<span class="p-1 me-1 rounded-circle bg-info"></span> 
								{{__("common.dashboard_affiliate_total_fromaff")}}
							</label>
							<h5 class="fw-bolder mb-0" id="admAffiliateChart2FromAff"></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>