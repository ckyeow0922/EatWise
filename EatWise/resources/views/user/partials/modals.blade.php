<!-- Modal Success -->
<div class="modal fade" tabindex="-1" id="modalSuccess" style="z-index: 1070;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross" style="color: var(--black-1);"></em>
            </a> --}}
            <div class="modal-body text-center pt-4 mt-3" style="background: var(--white);">
                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
                <h2 class="text-uppercase pt-4 pb-1 m-0 font-bold" style="color: black; font-weight:1000;">
                    SUCCESS!
                </h2>
                <h5 id="modalSuccessMessage" class="m-0 pb-2 font-light" style="color: black">
                    배송지 주소가
                    성공적으로
                    변경되었습니다.</h5>
                <button id="modalSuccessButton" data-bs-dismiss="modal" aria-label="Close"
                    class="w-100 btn btn-lg btn-primary btn-block">
                    <h6 class="font-light text-center w-100" style="color:white">OK</h6>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Fail -->
<div class="modal fade" tabindex="-1" id="modalFail" style="z-index: 1070;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 2px solid var(--black-1);">
            {{-- <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross" style="color: var(--black-1);"></em>
            </a> --}}
            <div class="modal-body text-center pt-4 mt-3" style="background: var(--white);">
                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                <h2 class="text-uppercase pt-4 pb-1 m-0 font-bold" style="color: black">
                    FAILED!
                </h2>
                <h5 id="modalFailMessage" class="m-0 pb-2 font-medium" style="color: black">
                    오류가 발생했습니다.</h5>
                <div class="d-flex justify-content-center align-items-center">
                    <button id="modalFailButton" data-bs-dismiss="modal" aria-label="Close"
                        class="w-100 btn btn-lg btn-primary btn-block">
                        <p class="font-medium text-center w-100">취소</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add BMI Form -->
<div class="modal fade" id="modalBMIForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Your BMI</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form onsubmit="calculateBMI()" class="form-validate is-alter">
                    <div class="form-group">
                        <label class="form-label" for="height">Height</label>
                        <div class="form-control-wrap">
                            <div class="form-control-wrap number-spinner-wrap">
                                <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-minus"
                                    data-number="minus"><em class="icon ni ni-minus"></em></button>
                                <input type="number" class="form-control number-spinner" id="height" value="0">
                                <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-plus"
                                    data-number="plus"><em class="icon ni ni-plus"></em></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="height">Weight</label>
                        <div class="form-control-wrap">
                            <div class="form-control-wrap number-spinner-wrap">
                                <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-minus"
                                    data-number="minus"><em class="icon ni ni-minus"></em></button>
                                <input type="number" class="form-control number-spinner" id="weight" value="0">
                                <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-plus"
                                    data-number="plus"><em class="icon ni ni-plus"></em></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg btn-primary">Calculate BMI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal BMI Display -->
<div class="modal fade" tabindex="-1" id="modalBMIDisplay" style="z-index: 1070;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross" style="color: var(--black-1);"></em>
            </a> --}}
            <input type="hidden" id="token" name="token" value="{{ $user->token }}">
            <input type="hidden" id="BMIValue" name="BMIValue" value="">
            <div class="modal-body text-center pt-4 mt-3" style="background: var(--white);">
                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"
                    style="background-color: #9FC131"></em>
                <h2 class="text-uppercase pt-4 pb-1 m-0" style="color: black; font-weight:1000;">
                    BMI
                </h2>
                <span id="modalBMIMessage" class="m-0 pb-3" style="color: black; font-weight:bold">
                    배송지 주소가
                    성공적으로
                    변경되었습니다.</span>
                <button id="storeBMIBtn" onclick="storeBMI()" data-bs-dismiss="modal" aria-label="Close"
                    class="w-100 btn btn-lg btn-primary btn-block mt-2">
                    <h6 class="font-light text-center w-100" style="color:white">Save</h6>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generate Diet Recommendation Form -->
<div class="modal fade" id="modalDietRecommenderForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Get Healthy Diet Recommendation</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form onsubmit="calculateBMI()" class="form-validate is-alter">
                    <div class="form-group">
                        <label class="form-label">BMI Category</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2">
                                <option value="underweight">Underweight</option>
                                <option value="normal_weight">Normal Weight</option>
                                <option value="overweight">Overweight</option>
                                <option value="obese">Obese</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Preferences</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" multiple="multiple"
                                data-placeholder="Select Multiple options">
                                <option value="high_protein">High-Protein</option>
                                <option value="vegetarian">Vegetarian</option>
                                <option value="low_carb">Low-Carb</option>
                                <option value="low_sugar">Low-Sugar</option>
                                <option value="high_fiber">High-Fiber</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="height">Budget</label>
                        <div class="form-control-wrap">
                            <div class="form-control-wrap number-spinner-wrap">
                                <button type="button"
                                    class="btn btn-icon btn-primary number-spinner-btn number-minus"
                                    data-number="minus"><em class="icon ni ni-minus"></em></button>
                                <input type="number" class="form-control number-spinner" id="budget"
                                    value="0">
                                <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-plus"
                                    data-number="plus"><em class="icon ni ni-plus"></em></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg btn-primary">Get Diet Recommendation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
