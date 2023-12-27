@include('Admin.header')
        <!-- partial -->


        
        <div class="card-body">
                    <h4 class="card-title">Policy</h4>
                   
                    <a href="/add-policy" class="btn btn-primary my-1">Add New</a>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Policy</th>
                            <th>Created</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($policy as $all)
                          <tr>
                            <td>{{$all->policy_text}}</td>
                            <td>{{$all->created_at}}</td>
                            <td><a href="" class="btn btn-success m-0 ">Off On</a></td>
                            <!-- <td><a href="{{url('Delete-Catagory',$all->id)}}" class="btn btn-danger m-0">Delete</a></td> -->
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>

 @include('Admin.footer')
   