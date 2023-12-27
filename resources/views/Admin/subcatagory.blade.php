@include('Admin.header')
        <!-- partial -->


        
        <div class="card-body">
                    <h4 class="card-title">Sub Catagories</h4>
                   
                    <a href="{{url('add-subcata',$subcata->id)}}" class="btn btn-primary my-1">Add New</a>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Sub Catagory</th>
                            <th>Catagory</th>
                            <!-- <th>Status</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($subcata->subcatagory as $all)
                          <tr>
                            <td>{{$all->subcata}}</td>
                            <td>{{$all->catagory->catagory}}</td>
                            <!-- <td><a href="{{url('Delete-Sub-Catagory',$all->id)}}" class="btn btn-danger m-0">Delete</a></td> -->
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>

 @include('Admin.footer')
   