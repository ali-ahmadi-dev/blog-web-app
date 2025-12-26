<main>
    <!-- =======================
  Main contain START -->
    <section class="py-4">
        <div class="container">
            <h1 class="mb-4 h3">افزودن دسته بندی </h1>
            <div class="row pb-4 bg-light p-3 mb-4 rounded">
                <form action="#" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label class="form-label">نام  </label>
                            <input name="name" type="text" class="form-control" placeholder="نام دست بندی ..." value="">
                            @error('name')
                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="form-label">نامک</label>
                            <input name="slug" type="text" class="form-control" placeholder="  نامک ..." value="">
                            @error('slug')
                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 ">
                            <label class="form-label">توضیحات</label>
                            <textarea class="form-control" name="description" ></textarea>
                        </div>
                        <div class="col-sm-12 col-md-4 mt-3">
                            <label class="form-label">آیکون</label>
                            <select class="form-control" name="icon" >
                                <option value="⚽️">⚽️ اخبار ورزشی</option>
                                <option value="🏀"> 🏀</option>
                                <option value="🏈">🏈 </option>
                                <option value="🏆">🏆 </option>
                                <option value="🎾">🎾 </option>
                                <option value="🏛️">🏛️ اخبار سیاسی</option>
                                <option value="🗳️">🗳️ </option>
                                <option value="🌍">🌍 </option>
                                <option value="📊">📊 </option>
                                <option value="📈">📈 اخبار اقتصادی </option>
                                <option value="💰">💰</option>
                                <option value="📉">📉</option>
                                <option value="🏦">🏦</option>
                                <option value="💵">💵</option>
                                <option value="🎨">🎨 اخبار هنری </option>
                                <option value="🖼️">🖼️</option>
                                <option value="🖌️">🖌️</option>
                                <option value="🎭">🎭</option>
                                <option value="🎬">🎬</option>
                                <option value="🎭">🎭 اخبار فرهنگی</option>
                                <option value="🎨">🎨</option>
                                <option value="📚">📚</option>
                                <option value="🎶">🎶</option>
                                <option value="🕌">🕌</option>
                                <option value="✈️">✈️ اخبار گردشگری</option>
                                <option value="🌍">🌍 </option>
                                <option value="🏖️">🏖️ </option>
                                <option value="🗺️">🗺️ </option>
                                <option value="🏕️">🏕️ </option>
                                <option value="💻">💻 اخبار فناوری و تکنولوژی</option>
                                <option value="📱">📱 </option>
                                <option value="🔧">🔧 </option>
                                <option value="🖥️">🖥️ </option>
                                <option value="🚀">🚀 </option>
                            </select>
                            @error('icon')
                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 d-flex align-items-center mt-5">
                            <input class="btn btn-success w-100 m-0" type="submit" value="ثبت">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row pb-4">
                <div class="col-12">
                    <!-- Title -->
                    <div class="d-sm-flex justify-content-sm-between align-items-center">
                        <h1 class="mb-2 mb-sm-0 h3">دسته بندی ها <span class="badge bg-primary bg-opacity-10 text-primary">{{$categoryCount}}</span></h1>
                    </div>
                </div>
            </div>
            <div class="row g-4">


                        <div class="col-md-6 col-xl-4">
                            <!-- Category item START -->
                            <div class="card border h-100">
                                <!-- Card header -->
                                <div class="card-header border-bottom p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="icon-lg shadow bg-body rounded-circle"></div>
                                        <h4 class="mb-0 ms-3 flex-grow-1"></h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="#" class="text-success mb-0 me-2"><i class="fas fa-edit"></i></a>
                                            <form action="#" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-transparent"><i class="fas fa-times-circle text-danger"></i></button>
                                            </form>
                                            {{--                                    <a href="#" class="text-danger mb-0 "><i class="fas fa-times-circle"></i></a>--}}
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body START -->
                                <div class="card-body p-3">
                                    <p></p>
                                    <!-- Followers and Post -->
                                    <!-- Total post -->
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-light">کل اخبار</h6>
                                        <h5 class=" px-2 py-1 bg-success rounded text-white"></h5>
                                    </div>
                                </div>
                                <!-- Card body END -->

                                <!-- Card footer -->
                                <div class="card-footer border-top text-center p-3">
                                    <a href="#" class="btn btn-primary-soft w-100 mb-0">مشاهده اخبار</a>
                                </div>
                            </div>
                            <!-- Category item END -->
                        </div>


                    <div class="alert alert-info">تا این لحظه دسته بندی ثبت نشده است!</div>

            </div>
            <div class="pagination d-flex justify-content-center align-items-center mt-4">
{{--                {{$categories->links('pagination::bootstrap-5')}}--}}
            </div>
        </div>

    </section>
    <!-- =======================
    Main contain END -->
</main>
