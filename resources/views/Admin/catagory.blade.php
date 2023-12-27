@include('Admin.header')
        <!-- partial -->


        
        <div class="card-body">
                    <h4 class="card-title">Catagories</h4>
                   
                    <a href="/add-catagory" class="btn btn-primary my-1">Add New</a>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Catagory</th>
                            <th>Created</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($cata as $all)
                          <tr>
                            <td>{{$all->catagory}}</td>
                            <td>{{$all->created_at}}</td>
                            <td><a href="{{url('Sub-Catagory',$all->id)}}" class="btn btn-success m-0 ">Sub Catagory</a></td>
                            <!-- <td><a href="{{url('Delete-Catagory',$all->id)}}" class="btn btn-danger m-0">Delete</a></td> -->
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>

 @include('Admin.footer')
   