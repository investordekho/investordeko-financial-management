@extends('layouts.app')

@section('content')
   <!-- //excel upload of customer information and employee managerment admin dashboard  -->
  
      <div class="row">
         <div class="col-md-12">
            <div class="card col-md-6">
                  
                     
                     <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="excel-upload-tab" data-toggle="tab" href="#excel-upload" role="tab" aria-controls="excel-upload" aria-selected="true">Excel Upload</a>
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
                              <div class="card-header">Employee Management</div>
                              <!-- Add your employee management content here -->
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
                  // location.reload();
                 
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
@endsection