@include('Admin.header')
        <!-- partial -->

        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Sub Catagories</h4>
                    <form class="forms-sample" action="{{url('add-sub-catagory',$id)}}" method="post">
        @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Sub Catagory</label>
                        <input type="text" class="form-control text-white" name="subcata" required id="exampleInputUsername1" placeholder="Enter A sub catagory.">
                      </div>
                   
                      <button type="submit" class="btn btn-primary mr-2">Add</button>
                    </form>
                  </div>
                </div>
              </div>

 @include('Admin.footer')
   