                @php
                    $start_datetime = new DateTime(date('Y-m-d H:i:s'));
                    $end_datetime = new DateTime(Auth::user()->company->companyPackage->package_end);
                    $diff = $start_datetime->diff($end_datetime);
                    $days = $diff->days;
                    $p_end = strtotime(Auth::user()->company->companyPackage->package_end);
                    
                @endphp

                @if ($days <= 7 && time() <= $p_end)
                    <div class="row">
                        <div class="col-md-12">

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                แพ็คเกจของคุณกำลังจะหมดอายุในวันที่ {{ date('d-m-Y H:i', $p_end) }}
                                กรุณาสมัครแพ็คเกจใหม่เพื่อใช้งานอย่างต่อเนื่อง <a
                                    href="{{ route('select-package.index') }}"> คลิกเพื่อดูแพ็คเกจ</a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                        </div>
                    </div>
                @endif

                @if (time() >= $p_end)
                    <div class="row">
                        <div class="col-md-12">

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                แพ็คเกจของคุณหมดอายุแล้ว คุณจะไม่มาสามารถใช้งานระบบได้
                                กรุณาสมัครแพ็คเกจใหม่เพื่อใช้งานอย่างต่อเนื่อง <a
                                    href="{{ route('select-package.index') }}"> คลิกเพื่อดูแพ็คเกจ</a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                        </div>
                    </div>
                @endif

                {{-- limit work --}}
                @if (Route::is('work.get-work.*'))
                    @php
                        // $year_month = date('Y-m');
                        // $start_day = Carbon\Carbon::parse(@Auth::user()->company->companyPackage->package_start)->format('d');
                        // $start = $year_month . '-' . $start_day;
                        // $start = Carbon\Carbon::parse($start);
                        // $end = $start->addDays(31);
                        
                        $limit = @Auth::user()->company->companyPackage->package->limit_work;
                        $count = @Auth::user()->company->countWork->count();
                        
                    @endphp
                    @if ($limit != null && $limit != 0 && $count >= $limit)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'รับงานซ่อม-บริการ' ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @elseif ($limit != null && $limit != 0 && $count != $limit && $limit - $count < 10 && $count != 0)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'รับงานซ่อม-บริการ' ใกล้
                                    ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @endif
                @endif


                {{-- limit customer --}}
                @if (Route::is('customer.*'))
                    @php
                        $limit = @Auth::user()->company->companyPackage->package->limit_customer;
                        $count = @Auth::user()->company->countCustomer->count();
                    @endphp
                    @if ($limit != null && $limit != 0 && $count >= $limit)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'ลูกค้า' ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @elseif ($limit != null && $limit != 0 && $count != $limit && $limit - $count < 10 && $count != 0)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'ลูกค้า' ใกล้ ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @endif
                @endif


                {{-- limit product --}}
                @if (Route::is('set-product.*'))
                    @php
                        $limit = @Auth::user()->company->companyPackage->package->limit_product;
                        $count = @Auth::user()->company->countProduct->count();
                    @endphp
                    @if ($limit != null && $limit != 0 && $count >= $limit)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'สินค้า-บริการ' ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @elseif ($limit != null && $limit != 0 && $count != $limit && $limit - $count < 10 && $count != 0)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'สินค้า-บริการ' ใกล้
                                    ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @endif

                @endif


                {{-- limit user --}}
                @if (Route::is('set-user.*'))
                    @php
                        $limit = @Auth::user()->company->companyPackage->package->limit_user;
                        $count = @Auth::user()->company->countUser->count();
                    @endphp
                    @if ($limit != null && $limit != 0 && $count >= $limit)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'ผู้ใช้งาน' ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @elseif($limit != null && $limit != 0 && $count != $limit && $limit - $count < 10 && $count != 0)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline me-2"></i>

                                    แจ้งเตือน คุณได้สร้าง 'ผู้ใช้งาน' ใกล้ ครบตามจำนวนสูงสุดของแพ็คเกจที่คุณเลือกแล้ว
                                    หากต้องการใช้งานอย่างต่อเนื่อง <a href="{{ route('select-package.index') }}">
                                        คลิกเพื่อดูแพ็คเกจ</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                            </div>
                        </div>
                    @endif

                @endif
