@extends('layouts.app')

@section('content')
   <!-- //excel upload of customer information and employee managerment admin dashboard  -->
  
      <div class="row">
         <div class="col-md-12">
            <div class="card col-md-6">
                  
                     
                     <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="excel-upload-tab" data-toggle="tab" href="#excel-upload" role="tab" aria-controls="excel-upload" aria-selected="true">Investor Excel Upload</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="investor-exceldownload-tab" data-toggle="tab" href="#investor-excel-download" role="tab" aria-controls="investor-excel-download" aria-selected="false">Investor Excel Download</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="employee-management-tab" data-toggle="tab" href="#employee-management" role="tab" aria-controls="employee-management" aria-selected="false">Employee Management</a>
                           </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade show active" id="excel-upload" role="tabpanel" aria-labelledby="excel-upload-tab">
                              @if (session('success_message'))
                                 <div class="alert alert-success">
                                    {{ session('success_message') }}
                                 </div>
                              @endif

                              @if (session('error_message'))
                                 <div class="alert alert-danger">
                                    {{ session('error_message') }}
                                 </div>
                              @endif 
                                 <!-- <form action="{{ route('investor.excelupload') }}" method="POST" enctype="multipart/form-data" class="form-horizontal"> -->
                                 <form id="excel-upload-form" action="{{ route('investor.excelupload') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
      
                                 @csrf
                                    <div class="form-group">
                                       <label for="file" class="col-sm-3 control-label" style="margin-top: 20px;">Upload Investor File</label>
                                       <div class="col-sm-9">
                                             <input type="file" id="file" name="file" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem; padding: 0.375rem 0.75rem; font-size: 1rem; margin-top: 20px; margin-bottom: 20px;" required>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="col-sm-offset-3 col-sm-9">
                                          <button type="submit" class="btn btn-success">Import Investor Data</button>
                                       </div>
                                    </div>
                                 </form>
                           </div>




















                           <div class="tab-pane fade" id="employee-management" role="tabpanel" aria-labelledby="employee-management-tab">
                              <!-- <div class="card-header">Employee Management</div> -->
                               <div style="display:flex;justify-content:flex-end;">
                                 <button style="background-color:#007bff; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer; transition:0.3s;"
                                 onmouseover="this.style.backgroundColor='#0056b3'"
                                 onmouseout="this.style.backgroundColor='#077bff'">Create</button>
                               </div>
                              
                              <div class="card shadow-lg">
                                 <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Employee Management</h5>
                                 </div>
                                 <div class="card-body">
                                    @if (session('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                       {{ session('success_message') }}
                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    
                                    @if (session('error_message'))
                                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          {{ session('error_message') }}
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                       </div>
                                    @endif
                                 </div>         
                             
                                 <!-- Add your employee management content here -->

                                 <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle shadow-sm">
                                       <thead class="table-dark">
                                          <tr class="table-primary">
                                             <th>Employee ID</th>
                                             <th>Employee Name</th>
                                             <th>Employee Email</th>
                                             <th>Action</th>                                      
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach($employeedata as $employee)                                             
                                          <tr>
                                             <td>{{$employee->id}}</td>
                                             <td>{{$employee->name}}</td>
                                             <td>{{$employee->email}}</td>
                                             <td><i class="bi bi-eye"></i>
                                             <i class="bi bi-pencil-square"></i>
                                             <i class="bi bi-trash"></i></td>
                                          </tr>
                                          @endforeach                                          
                                       </tbody>
                                    </table>
                                    <!-- <?php phpinfo()?> -->
                                 </div>
                              </div>
                           </div>


                           

                           



                           <!-- <div class="tab-pane fade" id="investor-excel-download" role="tabpanel" aria-labelledby="investor-exceldownload-tab"> -->
                              <!-- <div> 
                                 <h5>download investor excel</h5>
                                 <button id="download-investor-excel-data">Download Investor Excel Data</button>
                              </div> -->
                              <!-- <form action="{{ route('investor.exceldownload') }}" method="GET">
                              <label for="format">Select Export Format:</label>
                              <select name="format" id="format">
                                 <option value="xlsx">XLSX</option>
                                 <option value="xls">XLS</option>
                                 <option value="csv">CSV</option>
                                 <option value="pdf">PDF</option>
                              </select>
                              <button type="submit">Download</button>
                               </form>
                           </div> -->

                           
                           <div class="tab-pane fade" id="investor-excel-download" role="tabpanel" aria-labelledby="investor-exceldownload-tab">
                                <form action="{{ route('investor.exceldownload') }}" method="GET" style="margin-top: 20px;">
                                  <div class="form-group">
                                    <label for="format" style="margin-right: 10px;">Select Export Format:</label>
                                    <select name="format" id="format" class="form-control" style="display: inline-block; width: auto; margin-right: 10px;">
                                       <option value="xlsx">XLSX</option>
                                       <option value="xls">XLS</option>
                                       <option value="csv">CSV</option>
                                       <!-- <option value="pdf">PDF</option> -->
                                    </select>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                  </div>
                                </form>
                           </div>

























































                        </div>
                     </div>

            
            </div>
           
         </div>
      </div>

      <script>
         document.addEventListener('DOMContentLoaded', function(){

            console.log("script started");
            let button = document.querySelector('button[type="submit"]');
            let form =document.querySelector('#excel-upload-form');
            console.log("button",button);
            console.log("form",form);
            form.addEventListener('submit', function(event){
               console.log("form submitted");
               event.preventDefault();
               button.innerHTML = 'Uploading...';
               button.disabled = true;

               let formData =  new FormData(this);
                console.log("formdata",formData);
               
   
            fetch("{{route('investor.excelupload')}}", {
               method: 'POST',
               body: formData,
               headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  // Do not set 'Content-Type': 'application/json' here, as FormData will handle it
               }
            })
            .then(response => response.json())
            .then(data => {
               if (data.success) {
                  console.log("data that have uploaded are -------------------",data);
                  alert(data.message);
                   location.reload();
                 
               } else {
                  alert(data.message || 'An error occurred while uploading the file');
                  console.error(data.errors); // Log detailed errors for debugging
               }
            })
            .catch(error => {
               console.error("Error:", error);
               alert('An error occurred while uploading the file');
            });
            
            });
         });

      
      
      </script>

    







            <!-- <script>
                document.addEventListener('DOMContentLoaded',function(){
                  console.log("script has stated here");
                  let downloadbutton = document.getElementById('download-investor-excel-data');
                  downloadbutton.addEventListener('click',function(){
                     fetch("{{route('investor.exceldownload')}}", {
                        method:'GET',
                        headers: {
                           'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                     })
                     .then(response => response.blob())
                     .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display='none';
                        a.href=url;
                        a.download = 'investor_data.xlsx';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        alert('Excel Downloaded successfully');
                     })
                     .catch(error => {
                        console.error("Error:",error);
                        alert('An error occurred while downloading the file')
                     });
                  });
                });
            </script> -->
      </script>
      <script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      </script>
@endsection