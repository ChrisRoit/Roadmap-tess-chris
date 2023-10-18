@if(session("error"))
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card danger-card notification-card">
            <div class="card-body">
                {{session("error")}}
            </div>
        </div>
    </div>
</div>
@elseif(session("warning"))
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card bg-warning warning-card notification-card">
            <div class="card-body">
                {{session("warning")}}
            </div>
        </div>
    </div>
</div>

@elseif(session("success"))
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card bg-success success-card notification-card">
            <div class="card-body">
                {{session("success")}}
            </div>
        </div>
    </div>
</div>

@endif



