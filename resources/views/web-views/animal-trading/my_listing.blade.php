@extends('web-views.animal-trading.app')

@section('title', 'My Listing | Silo Fortune')


@section('content')

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">View My Listing(For Animal Trading)</h2>
                    
            </div>
        </div>
    </div>
</div>

<div class="dashboard-content">
   <div class="container">
      <div class="">
         <ul class="dashborad-menus">
            <li>
               <a href="{{route('user-account')}}">
               <i class="feather-grid"></i> <span>Dashboard</span>
               </a>
            </li>
            <li>
               <a href="{{route('add-product')}}">
               <i class="fa-solid fa-user"></i> <span>Add Listing</span>
               </a>
            </li>
            <li  class="active">
               <a href="{{route('my-listing')}}">
               <i class="feather-list"></i> <span>My Listing</span>
               </a>
            </li>
            
            <li>
               <a href="{{route('customer.auth.logout')}}">
               <i class="fas fa-light fa-circle-arrow-left"></i> <span>Logout</span>
               </a>
            </li>
         </ul>
      </div>
      <div class="dash-listingcontent dashboard-info">
         <div class="dash-cards card">
            <div class="card-header">
               <h4>My Listings</h4>
               <a class="nav-link header-login add-listing" href="add-listing.html"><i class="fa-solid fa-plus"></i> Add Listing</a>
            </div>
            <div class="card-body">
               <div class="listing-search">
                  <div class="filter-content form-group">
                     <div class="group-img">
                        <input type="text" class="form-control" placeholder="Search...">
                        <i class="feather-search"></i>
                     </div>
                  </div>
                  <div class="sorting-div">
                     <div class="sortbyset">
                        <span class="sortbytitle">Sort by</span>
                        <div class="sorting-select">
                           <select class="form-control select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="3">Newest</option>
                              <option>Newest</option>
                              <option>Oldest</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-oohr-container"><span class="select2-selection__rendered" id="select2-oohr-container" role="textbox" aria-readonly="true" title="Newest">Newest</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="table-responsive">
                  <div id="listdata-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                     <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                     </div>
                     <div class="row dt-row">
                        <div class="col-sm-12">
                           <table class="listing-table datatable dataTable no-footer" id="listdata-table">
                              <thead>
                                 <tr>
                                    <th class="no-sort sorting sorting_asc" tabindex="0" aria-controls="listdata-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Image: activate to sort column descending" style="width: 135px;">Image</th>
                                    <th class="no-sort sorting" tabindex="0" aria-controls="listdata-table" rowspan="1" colspan="1" aria-label="Details: activate to sort column ascending">Details</th>
                                    <th class="sorting" tabindex="0" aria-controls="listdata-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="no-sort sorting" tabindex="0" aria-controls="listdata-table" rowspan="1" colspan="1" aria-label="Views: activate to sort column ascending">Views</th>
                                    <th class="no-sort sorting" tabindex="0" aria-controls="listdata-table" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="odd">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"><a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-2.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">CDL A OTR Compnay Driver Job-N</a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="even">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"><a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-3.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">HP Gaming 15.6 Touchscren 12G</a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="odd">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"> <a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-1.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">Villa 457 sq.m. In Benidorm Fully Qquipped House</a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="even">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"> <a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-4.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">2012 AudiR8 GT Spider Convrtibile</a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="odd">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"> <a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-5.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">2017 Gulfsteam Ameri-Lite</a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="even">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"> <a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-6.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">Fashion Luxury Men Date</a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="odd">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"> <a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-7.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">Apple iPhone 6 16GB 4G LTE </a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text">Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="even">
                                    <td class="sorting_1">
                                       <div class="listingtable-img"> <a href="service-details.html"><img class="img-fluid avatar-img" src="assets/img/list/tablelist-8.jpg" alt=""></a></div>
                                    </td>
                                    <td>
                                       <h6><a href="service-details.html">Customized Apple iMac 21.5″ All-In </a></h6>
                                       <div class="listingtable-rate"><a href="javascript:void(0)" class="cat-icon"><i class="fa-regular fa-circle-stop"></i> Electronics</a> <span class="discount-amt">$350000.00</span><span class="fixed-amt">$40000</span></div>
                                       <p>Mauris vestibulum lorem a condimentum vulputate.</p>
                                    </td>
                                    <td><span class="status-text unpublish">Un Published</span></td>
                                    <td><span class="views-count">1523</span></td>
                                    <td>
                                       <div class="action">
                                          <a href="javascript:void(0)" class="action-btn btn-view"><i class="feather-eye"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                          <a href="javascript:void(0)" class="action-btn btn-trash"><i class="feather-trash-2"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-5"></div>
                        <div class="col-sm-12 col-md-7"></div>
                     </div>
                  </div>
               </div>
               <div class="blog-pagination">
                  <nav>
                     <ul class="pagination">
                        <li class="page-item previtem">
                           <a class="page-link" href="#"><i class="fas fa-regular fa-arrow-left"></i> Prev</a>
                        </li>
                        <li class="justify-content-center pagination-center">
                           <div class="pagelink">
                              <ul>
                                 <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                 </li>
                                 <li class="page-item active">
                                    <a class="page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
                                 </li>
                                 <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                        <li class="page-item nextlink">
                           <a class="page-link" href="#">Next <i class="fas fa-regular fa-arrow-right"></i></a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection