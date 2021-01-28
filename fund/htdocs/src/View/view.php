<div id="sub-visual">
        <div class="sub-visual-image">
            <img class="background-image" src="./images/sample10.jpg" alt="image">
            <div class="pos-center text-center text-white lighter">
                <div class="fs-9">펀드보기</div>
                <div class="fs-1 my-2">
                    킥스타터
                    <i class="fa fa-angle-right mx-1"></i>
                    메인페이지
                    <i class="fa fa-angle-right mx-1"></i>
                    펀드보기
                </div>
            </div>
        </div>
    </div>

    <div id="view-fund" class="py-5">
        <div class="container">
            <div class="header flex-col-center">
                <i class="fa fa-bar-chart"></i>
                <h2>best <span>Fund</span></h2>
                <p>어떤 펀드가 가장 좋을까요?</p>
            </div>
            <div class="row">
            <?php foreach($funds->data as $i=>$fund): ?>    
                <div class="col-lg-4 col-md-6 px-3 my-3">
                        <div class="card">
                            <div class="card-header flex-col">
                                <div class="flex-end"><span><?=$fund->fund_num?></span></div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <small class="text-bold">펀드이름</small>
                                    <p class="ml-2 mb-0"><?=$fund->fund_name?></p>
                                    <small class="text-bold">~ <?=$fund->fund_endDate?></small>
                                </div>
                                <div class="mt-2">
                                    <small class="text-bold">현재금액</small>
                                    <p class="ml-2 mb-0"><?=$fund->fund_current?>원</p>
                                </div>
                                <div class="mt-2">
                                    <div class="progress" style="height: 15px;">
                                        <div class="progress-bar fs-n1" style="width: <?=$fund->fund_success?>%;" aria-valuenow="<?=$fund->fund_success?>"><?=$fund->fund_success?>%</div>
                                    </div>
                                </div>
                            </div>
                            <?php if(user()): ?>
                            <div class="card-footer flex-center">
                                <?php if($fund->fund_success >= 100) { ?>
                                <form action="/insert/business" class="w-50 mx-1" method="post">
                                    <button class="blue-btn w-50 mx-1">완료</button>
                                    <input type="hidden" name="fund_num" value=<?=$fund->fund_num?>>
                                </form>
                                <?php } else { ?>
                                    <button class="blue-btn w-50 mx-1 invest-btn" data-toggle="modal" data-target="#invest-modal" data-num=<?=$fund->fund_num?> data-name=<?=$fund->fund_name?>>투자하기</button>
                                <?php } ?>
                            </div>
                            <?php endif; ?>
                        </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="mt-4 flex-center">
                <a class="py-2 px-3 blue-btn" href="/view?page=<?=$funds->startPage - 1?>" <?=!$funds->prev ? "disabled" : ""?>>
                    <i class="fa fa-angle-left"></i>
                </a>
                <?php for($i = $funds->startPage; $i <= $funds->endPage; $i++): ?>
                <a class="py-2 px-3 btn-filled" href="/view?page=<?=$i?>">
                    <?=$i?>
                </a>
                <?php endfor; ?>
                <a class="py-2 px-3 blue-btn" href="/view?page<?=$funds->endPage + 1?>" <?=!$funds->next ? "disabled" : ""?>>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div id="investor-view-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 py-5">
                    <div class="title">상세보기</div>
                    <div class="mt-2">
                        <small class="text-gray">번호</small>
                        <p class="ml-2 mb-0"></p>
                    </div>
                    <div class="mt-2">
                        <small class="text-gray">펀드명</small>
                        <p class="ml-2 mb-0"></p>
                    </div>
                    <div class="mt-2">
                        <small class="text-gray">창업자명</small>
                        <p class="ml-2 mb-0"></p>
                    </div>
                    <div class="mt-2">
                        <small class="text-gray">모집마감일</small>
                        <p class="ml-2 mb-0"></p>
                    </div>
                    <div class="mt-2">
                        <small class="text-gray">투자자 리스트</small>
                        <div class="investor pt-1 pl-4" style="max-height: 450px; height: auto; overflow-y: scroll;">
                            <div>
                                <small class="text-gray">이메일</small>
                                <p class="ml-2 mb-0"></p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">투자금액</small>
                                <p class="ml-2 mb-0"></p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">투자시간</small>
                                <p class="ml-2 mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="invest-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 py-5">
                    <form action="/insert/investor" method="post">
                        <div class="title">투자하기</div>
                        <div class="form-group">
                            <label for="invest_num">펀드번호</label>
                            <input type="text" name="fund_num" id="invest_num" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="invest_name">펀드이름</label>
                            <input type="text" name="fund_name" id="invest_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="invest_investor">투자자명</label>
                            <input type="text" name="user_name" id="invest_investor" class="form-control" value="<?=user()->user_name?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="invest_price">투자금액</label>
                            <input type="number" name="fund_price" id="invest_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="invest-sign">서명란</label>
                                <select id="thick" class="form-control mb-2" aria-placeholder="두께를 선택하세요">
                                    <option value="1">1pt</option>
                                    <option value="2">2pt</option>
                                    <option value="3">3pt</option>
                                    <option value="4">4pt</option>
                                </select>
                            </div>
                            <canvas width="450" height="150"></canvas>
                            <input type="hidden" name="fund_sign" id="invest_sign">
                        </div>
                        <div class="form-group">
                            <button id="insert-submit" class="blue-btn w-100">투자</button>
                        </div>
                    </form>
                    <div class="form-group">
                        <button class="blue-btn close-btn w-100">취소</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/View.js"></script>

    <div id="toast-container">
    </div>

    <script>
    </script>